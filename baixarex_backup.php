<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit;
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;
    
    // Definindo os headers para download de arquivo .xls
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=rel_geral.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";

    if (isset($_GET['codigo_prova'])) {
        $codigo_prova = $_GET['codigo_prova'];
        
        // Cabeçalho da planilha
        echo "<tr>
                <th style='width: 100px; background-color: #B20000; color: white;'>Codigo do Aluno</th>
                <th style='width: 150px; background-color: #B20000; color: white;'>RA</th>
                <th style='width: 200px; background-color: #B20000; color: white;'>Nome do Aluno</th>";
        
        // Adiciona as questões ao cabeçalho e armazena a ordem das questões em um array

        $numeroQuestao = 1; // Inicializa a variável
        $queryQuestoes = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova' ORDER BY Questao";
$resultadoQuestoes = mysqli_query($con, $queryQuestoes);

if (!$resultadoQuestoes) {
    die("Erro na consulta de questões: " . mysqli_error($con));
}

while ($questao = mysqli_fetch_array($resultadoQuestoes)) {
    $questoesOrdem[] = $questao['Questao'];
    echo "<th style='width: 100px; background-color: #B20000; color: white;'>" . utf8_decode("Questão $numeroQuestao") . "</th>";
    $numeroQuestao++;
}
        
        echo "<th style='width: 100px; background-color: #B20000; color: white; text-align: center;'>Numero de Acertos</th>";
        echo "<th style='width: 100px; background-color: #B20000; color: white; text-align: center;'>Nota</th>";
        echo "<th style='width: 100px; background-color: #B20000; color: white; text-align: center;'>% de Acertos</th>";
        echo "</tr>";

        // Adiciona a linha do gabarito
        echo "<tr><td colspan='3' style='text-align: center; width: 100px; background-color: #B20000; color: white;'>Gabarito</td>";
        foreach ($questoesOrdem as $questaoId) {
            $queryCorreta = "SELECT * FROM cadastro_questoes WHERE Codigo='$questaoId'";
            $resultadoCorreta = mysqli_query($con, $queryCorreta);
            $corretaData = mysqli_fetch_assoc($resultadoCorreta);
            $correta = isset($corretaData['Correta']) ? $corretaData['Correta'] : '';
            echo "<td style='background-color: #3ACF1F; text-align: center;'>$correta</td>";
        }
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";

        // Adiciona os dados dos alunos
        $queryAlunos = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova='$codigo_prova'";
        $resultadoAlunos = mysqli_query($con, $queryAlunos);
        while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
            $codigo_aluno = $aluno['Aluno'];
            $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
            $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
            $alunoData = mysqli_fetch_assoc($resultadoAlunoData);
            
            $nome_aluno = isset($alunoData['Nome']) ? $alunoData['Nome'] : '';
            $ra_aluno = isset($alunoData['RA']) ? $alunoData['RA'] : '';

            echo "<tr style='text-align: center';><td style='background-color: #DADADA;'>$codigo_aluno</td>";
            echo "<td style='text-align: center; background-color: #DADADA'>$ra_aluno</td>";
            echo "<td style='text-align: center; background-color: #DADADA'>$nome_aluno</td>";

            $total_questoes = 0;
            $pontos = 0;

            // Organiza as respostas do aluno na ordem correta
            $respostasAluno = array();
            $queryRespostas = "SELECT * FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova'";
            $resultadoRespostas = mysqli_query($con, $queryRespostas);
            while ($resposta = mysqli_fetch_array($resultadoRespostas)) {
                $respostasAluno[$resposta['Questao']] = $resposta['Resposta_Aluno'];
            }

            // Exibe as respostas do aluno de acordo com a ordem das questões
            foreach ($questoesOrdem as $questaoId) {
                $respostaAluno = isset($respostasAluno[$questaoId]) ? $respostasAluno[$questaoId] : '';
                $queryCorreta = "SELECT * FROM cadastro_questoes WHERE Codigo='$questaoId'";
                $resultadoCorreta = mysqli_query($con, $queryCorreta);
                $corretaData = mysqli_fetch_assoc($resultadoCorreta);
                $respostaCorreta = isset($corretaData['Correta']) ? $corretaData['Correta'] : '';

                if ($respostaAluno == $respostaCorreta) {
                    echo "<td style='background-color: #3ACF1F;'>$respostaAluno</td>";
                    $pontos++;
                } else {
                    echo "<td style='background-color: #D32719;'>$respostaAluno</td>";
                }
                $total_questoes++;
            }

            $nota = $total_questoes > 0 ? round(($pontos / $total_questoes) * 10, 2) : 0;
            $percentualAcertos = $total_questoes > 0 ? round(($pontos / $total_questoes) * 100, 1) : 0;

            echo "<td style='text-align: center; background-color: #DADADA';>$pontos</td>";
            echo "<td style='text-align: center; background-color: #DADADA';>$nota</td>";
            echo "<td style='text-align: center; background-color: #DADADA';>$percentualAcertos%</td>";
            echo "</tr>";
        }

        // Adiciona as linhas finais
        echo "<tr><td colspan='3' style='background-color: #DADADA';>Acertos:</td>";
        for ($i = 0; $i < $total_questoes; $i++) {
            $somaAcertos = 0;
            // Lógica para contar acertos em cada questão
            mysqli_data_seek($resultadoAlunos, 0); // Resetando o ponteiro
            while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
                $codigo_aluno = $aluno['Aluno'];
                $queryRespostas = "SELECT * FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova' AND Resposta_Aluno=Resposta_Correta";
                $resultadoContagem = mysqli_query($con, $queryRespostas);
                $somaAcertos += mysqli_num_rows($resultadoContagem);
            }
            echo "<td style='background-color: #DADADA'>$somaAcertos</td>";
        }
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";
        echo "<td style='background-color: #DADADA; text-align: center;'></td>";
        //echo "<td colspan='3'></td></tr>";

        echo "<tr><td colspan='3' style='background-color: #DADADA';>%Acertos:</td>";
        for ($i = 0; $i < $total_questoes; $i++) {
            $percentual = $somaAcertos > 0 ? round(($somaAcertos / mysqli_num_rows($resultadoAlunos)) * 100, 0) : 0;
            echo "<td style='background-color: #DADADA'>$percentual%</td>";
        }
        echo "<td colspan='3' style='background-color: #DADADA'></td></tr>";

        // Fecha a tabela
        echo "</table>";
    }
} else {
    $voltar = "login.php";
    header("Location: $voltar");
}
?>

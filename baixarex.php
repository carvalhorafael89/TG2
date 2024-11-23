<?php
if (!isset($_COOKIE['Nivel'])) {
    header("Location: login.php?acesso=denied");
    exit;
}

require_once 'conecta.php';

if (isset($_COOKIE['Nivel'])) {
    // Informações do usuário
    $nivel = isset($_COOKIE['Nivel']) ? $_COOKIE['Nivel'] : '';
    $nome = isset($_COOKIE['Nome']) ? $_COOKIE['Nome'] : '';
    $email = isset($_COOKIE['Email']) ? $_COOKIE['Email'] : '';
    $codigo = isset($_COOKIE['Codigo']) ? $_COOKIE['Codigo'] : '';

    // Headers para exportação do arquivo Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=rel_geral.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Verifica se o código da prova foi fornecido
    if (isset($_GET['codigo_prova'])) {
        $codigo_prova = $_GET['codigo_prova'];

        // Inicializa o HTML da tabela
        echo "<table border='1'>";

        // Cabeçalho do relatório
        echo "<tr><th colspan='9' style='width: 1000px; background-color: #B20000; color: white;'>RELATÓRIO GERAL</th></tr>";
        echo "<tr>
                <th style='background-color: #B20000; color: white;'>Código do Aluno</th>
                <th style='background-color: #B20000; color: white;'>RA</th>
                <th style='background-color: #B20000; color: white;'>Nome do Aluno</th>";

        // Recupera as questões da prova
        $questoesOrdem = [];
        $queryQuestoes = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova' ORDER BY Questao";
        $resultadoQuestoes = mysqli_query($con, $queryQuestoes);

        if (!$resultadoQuestoes) {
            die("Erro na consulta de questões: " . mysqli_error($con));
        }

        // Adiciona as colunas das questões ao cabeçalho
        $numeroQuestao = 1;
        while ($questao = mysqli_fetch_assoc($resultadoQuestoes)) {
            $questoesOrdem[] = $questao['Questao'];
            echo "<th style='background-color: #B20000; color: white;'>Questão $numeroQuestao</th>";
            $numeroQuestao++;
        }

        echo "<th style='background-color: #B20000; color: white;'>Número de Acertos</th>";
        echo "<th style='background-color: #B20000; color: white;'>Nota</th>";
        echo "<th style='background-color: #B20000; color: white;'>% de Acertos</th>";
        echo "</tr>";

        // Adiciona a linha do gabarito
        echo "<tr><td colspan='3' style='text-align: center; background-color: #ffff00; color: white;'>Gabarito</td>";
        foreach ($questoesOrdem as $questaoId) {
            $queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questaoId'";
            $resultadoCorreta = mysqli_query($con, $queryCorreta);
            $correta = (isset($resultadoCorreta) && $resultadoCorreta) ? mysqli_fetch_assoc($resultadoCorreta)['Correta'] : '';
            echo "<td style='background-color: #3ACF1F; text-align: center;'>$correta</td>";
        }
        echo "<td colspan='3' style='background-color: #DADADA;'></td></tr>";

        // Consulta os alunos que responderam a prova
        $queryAlunos = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova='$codigo_prova'";
        $resultadoAlunos = mysqli_query($con, $queryAlunos);

        $notas = [];
        $acertos = [];
        $somaAcertos = array_fill(0, count($questoesOrdem), 0); // Inicializa o contador de acertos por questão

        while ($aluno = mysqli_fetch_assoc($resultadoAlunos)) { 
            $codigo_aluno = $aluno['Aluno'];

            // Recupera os dados do aluno
            $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
            $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
            $alunoData = mysqli_fetch_assoc($resultadoAlunoData);

            $nome_aluno = isset($alunoData['Nome']) ? $alunoData['Nome'] : '';
            $ra_aluno = isset($alunoData['RA']) ? $alunoData['RA'] : '';

            echo "<tr><td style='background-color: #DADADA;'>$codigo_aluno</td>";
            echo "<td style='background-color: #DADADA;'>$ra_aluno</td>";
            echo "<td style='background-color: #DADADA;'>$nome_aluno</td>";

            // Organiza as respostas do aluno
            $queryRespostas = "SELECT Questao, Resposta_Aluno FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova'";
            $resultadoRespostas = mysqli_query($con, $queryRespostas);

            $respostasAluno = [];
            while ($resposta = mysqli_fetch_assoc($resultadoRespostas)) {
                $respostasAluno[$resposta['Questao']] = $resposta['Resposta_Aluno'];
            }

            // Calcula os acertos do aluno
            $pontos = 0;
            foreach ($questoesOrdem as $index => $questaoId) {
                $respostaAluno = isset($respostasAluno[$questaoId]) ? $respostasAluno[$questaoId] : '';
                $queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questaoId'";
                $resultadoCorreta = mysqli_query($con, $queryCorreta);
                $respostaCorreta = (isset($resultadoCorreta) && $resultadoCorreta) ? mysqli_fetch_assoc($resultadoCorreta)['Correta'] : '';

                if ($respostaAluno == $respostaCorreta) {
                    echo "<td style='background-color: #3ACF1F; text-align: center;'>$respostaAluno</td>";
                    $pontos++;
                    $somaAcertos[$index]++;
                } else {
                    echo "<td style='background-color: #D32719; text-align: center;'>$respostaAluno</td>";
                }
            }

            $nota = round(($pontos / count($questoesOrdem)) * 10, 2);
            $percentualAcertos = round(($pontos / count($questoesOrdem)) * 100, 2);

            $notas[] = $nota;
            $acertos[] = $percentualAcertos;

            echo "<td style='background-color: #DADADA;'>$pontos</td>";
            echo "<td style='background-color: #DADADA;'>$nota</td>";
            echo "<td style='background-color: #DADADA;'>$percentualAcertos%</td>";
            echo "</tr>";
        }

        // Adiciona as médias e percentuais
        echo "<tr><td colspan='3' style='background-color: #DADADA;'>Acertos:</td>";
        foreach ($somaAcertos as $totalAcertos) {
            echo "<td style='background-color: #DADADA; text-align: center;'>$totalAcertos</td>";
        }
        echo "<td colspan='3' style='background-color: #DADADA;'></td></tr>";

        echo "<tr><td colspan='3' style='background-color: #DADADA;'>% de Acertos:</td>";
        foreach ($somaAcertos as $totalAcertos) {
            $percentual = round(($totalAcertos / mysqli_num_rows($resultadoAlunos)) * 100, 2);
            echo "<td style='background-color: #DADADA; text-align: center;'>$percentual%</td>";
        }
        echo "<td colspan='3' style='background-color: #DADADA;'></td></tr>";

        // Fecha a tabela
        echo "</table>";
    } else {
        echo "Código da prova não fornecido.";
    }
} else {
    header("Location: login.php");
}
?>

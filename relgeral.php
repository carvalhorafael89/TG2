<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit;
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;

    // Relatório geral
    if (isset($_GET['codigo_prova'])) {
        $codigo_prova = $_GET['codigo_prova'];
        $linha = 1;

        // Cabeçalho e título
        $queryProva = "SELECT * FROM cadastro_provas WHERE codigo_prova='$codigo_prova'";
        $resultadoProva = mysqli_query($con, $queryProva);
        if ($resultadoProva) {
            $prova = mysqli_fetch_array($resultadoProva);
            echo "<center><table width='1150'>";
            echo "<caption><h2 style='background-color: red; color: white; padding: 10px;'>" . strtoupper($prova['Titulo']) . "</h2></caption>";
            date_default_timezone_set('America/Sao_Paulo');
            echo "<tr><td>Data do relatório: " . date("d/m/y") . "</td><td>&nbsp;&nbsp;&nbsp;</td>";
            echo "<td style='text-align: right;'>Código: $codigo_prova</td></tr>";
            echo "</table><br><br></center>";
        }

        // Planilha Geral
        echo "<center><table border='1'>";
        echo "<caption><h2>PLANILHA GERAL</h2></caption>";
        echo "<tr>
                <td>&nbsp;Cód.&nbsp;</td>
                <td>&nbsp;RA&nbsp;</td>
                <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>";

        $queryQuestoes = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova'";
        $resultadoQuestoes = mysqli_query($con, $queryQuestoes);
        $questoes = [];
        $numero_questao = 1;

        while ($lqc = mysqli_fetch_array($resultadoQuestoes)) {
            $questoes[] = $lqc['Questao'];
            echo "<td>Q$numero_questao</td>";
            $numero_questao++;
        }
        echo "<td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>";
        echo "</tr>";

        // Linha do gabarito
        echo "<tr>
                <td> </td>
                <td> </td>
                <td>&nbsp;Gabarito:&nbsp;</td>";

        foreach ($questoes as $questao_id) {
            $queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
            $resultadoCorreta = mysqli_query($con, $queryCorreta);
            $respostaCorretaArray = mysqli_fetch_array($resultadoCorreta);
            $respostaCorreta = $respostaCorretaArray ? $respostaCorretaArray['Correta'] : '';
            echo "<td bgcolor='yellow'>&nbsp;<b>$respostaCorreta</b>&nbsp;</td>";
        }
        echo "<td></td><td></td><td></td><td></td>";
        echo "</tr>";

        // Respostas dos alunos
        $queryAlunos = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova='$codigo_prova'";
        $resultadoAlunos = mysqli_query($con, $queryAlunos);
        while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
            $codigo_aluno = $aluno['Aluno'];

            $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
            $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
            $alunoData = mysqli_fetch_array($resultadoAlunoData);

            $nome_aluno = $alunoData ? $alunoData['Nome'] : '';
            $ra_aluno = $alunoData ? $alunoData['RA'] : '';

            echo "<tr>
                    <td>&nbsp;$codigo_aluno&nbsp;</td>
                    <td>&nbsp;$ra_aluno&nbsp;</td>
                    <td>&nbsp;$nome_aluno&nbsp;</td>";

            $pontos = 0;
            $total_questoes = count($questoes);
            $respostasAluno = [];

            $queryRespostasAluno = "SELECT * FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova'";
            $resultadoRespostasAluno = mysqli_query($con, $queryRespostasAluno);

            while ($respostaAluno = mysqli_fetch_array($resultadoRespostasAluno)) {
                $respostasAluno[$respostaAluno['Questao']] = $respostaAluno['Resposta_Aluno'];
            }

            foreach ($questoes as $questao_id) {
                $respostaAluno = isset($respostasAluno[$questao_id]) ? $respostasAluno[$questao_id] : '';
                $queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
                $resultadoCorreta = mysqli_query($con, $queryCorreta);
                $respostaCorretaArray = mysqli_fetch_array($resultadoCorreta);
                $respostaCorreta = $respostaCorretaArray ? $respostaCorretaArray['Correta'] : '';

                if ($respostaAluno == $respostaCorreta) {
                    echo "<td bgcolor='lightgreen'>&nbsp;$respostaAluno&nbsp;</td>";
                    $pontos++;
                } else {
                    echo "<td bgcolor='#f8d7da'>&nbsp;$respostaAluno&nbsp;</td>";
                }
            }

            $nota = $total_questoes > 0 ? round(($pontos / $total_questoes) * 10, 2) : 0;
            $percentualAcertos = $total_questoes > 0 ? round(($pontos / $total_questoes) * 100, 1) : 0;

            echo "<td>&nbsp;$pontos&nbsp;</td>";
            echo "<td>&nbsp;$nota&nbsp;</td>";
            echo "<td>&nbsp;$percentualAcertos%&nbsp;</td>";
            echo "</tr>";
        }
        echo "</table></center>";


// Planilhas por Disciplina
$disciplinas = [];
$queryDisciplinas = "SELECT DISTINCT Disciplina FROM cadastro_questoes WHERE Codigo IN (SELECT Questao FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova')";
$resultadoDisciplinas = mysqli_query($con, $queryDisciplinas);
while ($disciplina = mysqli_fetch_array($resultadoDisciplinas)) {
    $disciplinas[] = $disciplina['Disciplina'];
}

foreach ($disciplinas as $disciplina) {
    if (empty($disciplina)) {
        continue;
    }

    echo "<center><br><table border='1'>";
    echo "<caption><h2>Disciplina: $disciplina</h2></caption>";
    echo "<tr>
            <td>&nbsp;Cód.&nbsp;</td>
            <td>&nbsp;RA&nbsp;</td>
            <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>";

    // Adiciona colunas para cada questão da disciplina
    foreach ($questoes as $questao_id) {
        $queryQuestaoDisciplina = "SELECT Disciplina FROM cadastro_questoes WHERE Codigo='$questao_id'";
        $resultadoQuestaoDisciplina = mysqli_query($con, $queryQuestaoDisciplina);
        $disciplinaQuestao = mysqli_fetch_array($resultadoQuestaoDisciplina)['Disciplina'];

        if ($disciplinaQuestao == $disciplina) {
            echo "<td>Q$questao_id</td>";
        }
    }

    echo "<td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>";
    echo "</tr>";

    // Gabarito por disciplina
    echo "<tr>
            <td> </td>
            <td> </td>
            <td>&nbsp;Gabarito:&nbsp;</td>";
    foreach ($questoes as $questao_id) {
        $queryQuestaoDisciplina = "SELECT Disciplina, Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
        $resultadoQuestaoDisciplina = mysqli_query($con, $queryQuestaoDisciplina);
        $questaoInfo = mysqli_fetch_array($resultadoQuestaoDisciplina);

        if ($questaoInfo['Disciplina'] == $disciplina) {
            echo "<td bgcolor='yellow'>&nbsp;<b>{$questaoInfo['Correta']}</b>&nbsp;</td>";
        }
    }
    echo "<td></td><td></td><td></td><td></td></tr>";

    // Respostas dos alunos por disciplina
    mysqli_data_seek($resultadoAlunos, 0); // Reseta o ponteiro do resultado dos alunos
    while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
        $codigo_aluno = $aluno['Aluno'];

        $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
        $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
        $alunoData = mysqli_fetch_array($resultadoAlunoData);

        $nome_aluno = $alunoData ? $alunoData['Nome'] : '';
        $ra_aluno = $alunoData ? $alunoData['RA'] : '';

        echo "<tr>
                <td>&nbsp;$codigo_aluno&nbsp;</td>
                <td>&nbsp;$ra_aluno&nbsp;</td>
                <td>&nbsp;$nome_aluno&nbsp;</td>";

        $pontos_disciplina = 0;
        $total_questoes_disciplina = 0;

        foreach ($questoes as $questao_id) {
            $queryQuestaoDisciplina = "SELECT Disciplina, Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
            $resultadoQuestaoDisciplina = mysqli_query($con, $queryQuestaoDisciplina);
            $questaoInfo = mysqli_fetch_array($resultadoQuestaoDisciplina);

            if ($questaoInfo['Disciplina'] == $disciplina) {
                $respostaAluno = isset($respostasAluno[$questao_id]) ? $respostasAluno[$questao_id] : '';
                $respostaCorreta = $questaoInfo['Correta'];

                if ($respostaAluno == $respostaCorreta) {
                    echo "<td bgcolor='lightgreen'>&nbsp;$respostaAluno&nbsp;</td>";
                    $pontos_disciplina++;
                } else {
                    echo "<td bgcolor='#f8d7da'>&nbsp;$respostaAluno&nbsp;</td>";
                }
                $total_questoes_disciplina++;
            }
        }

        $nota_disciplina = $total_questoes_disciplina > 0 ? round(($pontos_disciplina / $total_questoes_disciplina) * 10, 2) : 0;
        $percentualAcertosDisciplina = $total_questoes_disciplina > 0 ? round(($pontos_disciplina / $total_questoes_disciplina) * 100, 1) : 0;

        echo "<td>&nbsp;$pontos_disciplina&nbsp;</td>";
        echo "<td>&nbsp;$nota_disciplina&nbsp;</td>";
        echo "<td>&nbsp;$percentualAcertosDisciplina%&nbsp;</td>";
        echo "</tr>";
    }
    echo "</table></center>";
}

        // Exibição do desempenho dos alunos
echo "<center><table border='1'>";
echo "<caption><h2>Desempenho dos Alunos</h2></caption>";
echo "<tr>
        <td>&nbsp;Cód.&nbsp;</td>
        <td>&nbsp;RA&nbsp;</td>
        <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>
        <td>Desempenho</td><td>Acertos</td><td>Nota</td><td>%Acertos</td></tr>";

        // Resetando o ponteiro do resultado dos alunos
mysqli_data_seek($resultadoAlunos, 0);

while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
    $codigo_aluno = $aluno['Aluno'];

    $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
    $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
    $alunoData = mysqli_fetch_array($resultadoAlunoData);

    $nome_aluno = $alunoData ? $alunoData['Nome'] : '';
    $ra_aluno = $alunoData ? $alunoData['RA'] : '';

  

    $total_questoes_geral = count($questoes);
    $respostasAluno = [];
    
    // Preenchendo respostas do aluno para comparação
    $queryRespostasAluno = "SELECT * FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova'";
    $resultadoRespostasAluno = mysqli_query($con, $queryRespostasAluno);
    while ($respostaAluno = mysqli_fetch_array($resultadoRespostasAluno)) {
        $respostasAluno[$respostaAluno['Questao']] = $respostaAluno['Resposta_Aluno'];
    }

    $pontos_geral = 0;

    // Itera sobre cada questão da prova
foreach ($questoes as $questao_id) {
// Verifica se o aluno respondeu a questão
if (isset($respostasAluno[$questao_id])) {
$respostaAluno = $respostasAluno[$questao_id];

// Consulta a resposta correta para a questão atual
$queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
$resultadoCorreta = mysqli_query($con, $queryCorreta);
$respostaCorretaArray = mysqli_fetch_array($resultadoCorreta);
$respostaCorreta = $respostaCorretaArray ? $respostaCorretaArray['Correta'] : '';

// Verifica se a resposta do aluno está correta
if ($respostaAluno == $respostaCorreta) {
    $pontos_geral++; // Adiciona um ponto se a resposta estiver correta
}
}
}

    // Cálculo do percentual de acertos
    $percentualAcertosGeral = $total_questoes_geral > 0 ? round(($pontos_geral / $total_questoes_geral) * 100, 1) : 0;

            // Exibição dos resultados
    echo "<tr>
    <td>&nbsp;$codigo_aluno&nbsp;</td>
    <td>&nbsp;$ra_aluno&nbsp;</td>
    <td>&nbsp;$nome_aluno&nbsp;</td>";
echo "<td width='800'>
<div class='progress'>
    <div class='progress-bar progress-bar-danger progress-bar-striped active' role='progressbar' aria-valuenow='$percentualAcertosGeral' aria-valuemin='0' aria-valuemax='100' style='width: $percentualAcertosGeral%'>
        $percentualAcertosGeral%
    </div>
</div>
</td>";
echo "<td>&nbsp;$pontos_geral&nbsp;</td>";
echo "<td>&nbsp;" . ($total_questoes_geral > 0 ? round(($pontos_geral / $total_questoes_geral) * 10, 2) : 0) . "&nbsp;</td>";
echo "<td>&nbsp;$percentualAcertosGeral%&nbsp;</td>";
echo "</tr>";
        }
        echo "</table></center>";
        echo "<br>";
        echo "<br>";
        echo "<br>";

    }

    
} else {
    $voltar = "login.php";
    header("Location: $voltar");
}
?>

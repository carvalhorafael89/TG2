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
?>

<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Relatórios</a><i class="icon-angle-right"></i></li>
          <li class="active">Relatório Geral</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="content">

<?php
    if (isset($_GET['codigo_prova'])) {
        $codigo_prova = $_GET['codigo_prova'];
        $linha = 1;

        $queryProva = "SELECT * FROM cadastro_provas WHERE codigo_prova='$codigo_prova'";
        $resultadoProva = mysqli_query($con, $queryProva);

        if ($resultadoProva) {
            $prova = mysqli_fetch_array($resultadoProva);
            echo "<center><table width='800'>";
            echo "<caption><h2>{$prova['Titulo']}</h2></caption>";
            date_default_timezone_set('America/Sao_Paulo');
            echo "<tr><td>Data do relatório: " . date("d/m/y") . "</td><td>&nbsp;&nbsp;&nbsp;</td>";
            echo "<td>Código: $codigo_prova</td></tr>";
            echo "</table><br><br></center>";
        }

        // Cabeçalho da planilha geral
        echo "<center><table border='1'>";
        echo "<caption><h2>PLANILHA GERAL</h2></caption>";
        echo "<tr>
                <td>&nbsp;Cód.&nbsp;</td>
                <td>&nbsp;RA&nbsp;</td>
                <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>";

        $queryQuestoes = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova'";
        $resultadoQuestoes = mysqli_query($con, $queryQuestoes);
        $questoes = array();
        $numero_questao = 1;

        // Mapeia as questões para a ordem correta
        while ($lqc = mysqli_fetch_array($resultadoQuestoes)) {
            $questoes[] = $lqc['Questao'];
            echo "<td>Q$numero_questao</td>";
            $numero_questao++;
        }
        echo "<td></td><td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>";
        echo "</tr>";   

        // Linha do gabarito
        echo "<tr>
                <td> </td>
                <td> </td>
                <td>&nbsp;Gabarito:&nbsp;</td>";

        foreach ($questoes as $questao_id) {
            $queryCorreta = "SELECT * FROM cadastro_questoes WHERE Codigo='$questao_id'";
            $resultadoCorreta = mysqli_query($con, $queryCorreta);
            $respostaCorretaArray = mysqli_fetch_array($resultadoCorreta);
            $respostaCorreta = isset($respostaCorretaArray['Correta']) ? $respostaCorretaArray['Correta'] : '';
            echo "<td bgcolor='yellow'>&nbsp;<b>$respostaCorreta</b>&nbsp;</td>";
        }
        echo "<td></td><td></td><td></td><td></td>";
        echo "</tr>";

        // Tabela de respostas dos alunos
        $queryAlunos = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova='$codigo_prova'";
        $resultadoAlunos = mysqli_query($con, $queryAlunos);
        while ($aluno = mysqli_fetch_array($resultadoAlunos)) {
            $codigo_aluno = $aluno['Aluno'];

            $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE Codigo='$codigo_aluno'";
            $resultadoAlunoData = mysqli_query($con, $queryAlunoData);
            $alunoData = mysqli_fetch_array($resultadoAlunoData);

            $nome_aluno = isset($alunoData['Nome']) ? $alunoData['Nome'] : '';
            $ra_aluno = isset($alunoData['RA']) ? $alunoData['RA'] : '';

            echo "<tr>
                    <td>&nbsp;$codigo_aluno&nbsp;</td>
                    <td>&nbsp;$ra_aluno&nbsp;</td>
                    <td>&nbsp;$nome_aluno&nbsp;</td>";

            $pontos = 0;
            $total_questoes = count($questoes);

            // Respostas do aluno organizadas por questão
            $queryRespostasAluno = "SELECT * FROM gabaritos WHERE Aluno='$codigo_aluno' AND codprova='$codigo_prova'";
            $resultadoRespostasAluno = mysqli_query($con, $queryRespostasAluno);
            $respostasAluno = array();

            while ($respostaAlunoArray = mysqli_fetch_array($resultadoRespostasAluno)) {
                $respostasAluno[$respostaAlunoArray['Questao']] = $respostaAlunoArray['Resposta_Aluno'];
            }

            foreach ($questoes as $questao_id) {
                $respostaAluno = isset($respostasAluno[$questao_id]) ? $respostasAluno[$questao_id] : '';
                $queryCorreta = "SELECT * FROM cadastro_questoes WHERE Codigo='$questao_id'";
                $resultadoCorreta = mysqli_query($con, $queryCorreta);
                $respostaCorretaArray = mysqli_fetch_array($resultadoCorreta);
                $respostaCorreta = isset($respostaCorretaArray['Correta']) ? $respostaCorretaArray['Correta'] : '';

                if ($respostaAluno == $respostaCorreta) {
                    echo "<td bgcolor='lightgreen'>&nbsp;$respostaAluno&nbsp;</td>";
                    $pontos++;
                } else {
                    echo "<td bgcolor='#f8d7da'>&nbsp;$respostaAluno&nbsp;</td>";
                }
            }

            $nota = round(($pontos / $total_questoes) * 10, 2);
            $percentualAcertos = round(($pontos / $total_questoes) * 100, 1);

            echo "<td>&nbsp;$pontos&nbsp;</td>";
            echo "<td>&nbsp;$nota&nbsp;</td>";
            echo "<td>&nbsp;$percentualAcertos%&nbsp;</td>";
            echo "</tr>";
        }

        // Estatísticas gerais
        echo "<tr><td colspan='3'>Total de Acertos:</td>";
        for ($i = 0; $i < $total_questoes; $i++) {
            echo "<td>-</td>"; // Placeholder para valores de soma
        }
        echo "<td></td><td></td><td></td><td></td></tr>";

        echo "<tr><td colspan='3'>% de Acertos:</td>";
        for ($i = 0; $i < $total_questoes; $i++) {
            echo "<td>-</td>"; // Placeholder para valores de percentual
        }
        echo "<td></td><td></td><td></td><td></td></tr>";

        echo "</table></center>";

        // Outras tabelas: por disciplina e desempenho dos alunos
        // Aqui você pode inserir a lógica para gerar as tabelas por disciplina e o desempenho dos alunos,
        // com a mesma estrutura geral usada acima, mas adaptada para cada propósito.
    }
} else {
    $voltar = "login.php";
    header("Location: $voltar");
}
?>

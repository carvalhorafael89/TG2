    <?php
    // Iniciar buffer de saída
    ob_start();

    // Iniciar sessão para verificar o modo
    session_start();

    // Verificar cookie de acesso
    if (!isset($_COOKIE['Nivel'])) {
        $voltar = "login.php?acesso=denied";
        header("Location: $voltar");
        exit;
    }

    // Conectar ao banco de dados
    require_once 'conecta.php';
    include 'cabecalho.php';

    // Se o cookie estiver definido, prosseguir
    if (isset($_COOKIE['Nivel'])) {
        $nivel = $_COOKIE['Nivel'];
        $nome = $_COOKIE['Nome'];
        $email = $_COOKIE['Email'];
        $codigo = $_COOKIE['Codigo'];
        $codigo_aluno = $codigo;

        // Verificar se o código da prova foi fornecido
        if (isset($_GET['codigo_prova'])) {
            $codigo_prova = $_GET['codigo_prova'];
            $linha = 1;

            // Cabeçalho e título do relatório
            $queryProva = "SELECT * FROM cadastro_provas WHERE codigo_prova='$codigo_prova'";
            $resultadoProva = mysqli_query($con, $queryProva);

            if ($resultadoProva && $prova = mysqli_fetch_assoc($resultadoProva)) {
                echo "<center><table width='1150'>";
                echo "<caption><h2 style='background-color: red; color: white; padding: 10px;'>" . strtoupper($prova['Titulo']) . "</h2></caption>";
                date_default_timezone_set('America/Sao_Paulo');
                echo "<tr><td>Data do relatório: " . date("d/m/y") . "</td><td>&nbsp;&nbsp;&nbsp;</td>";
                echo "<td style='text-align: right;'>Código: $codigo_prova</td></tr>";
                echo "</table><br><br></center>";
            } else {
                echo "<p style='color: red;'>Erro ao buscar dados da prova: " . mysqli_error($con) . "</p>";
                exit();
            }

            // Planilha Geral
            echo "<center><table border='1'>";
            echo "<caption><h2>PLANILHA GERAL</h2></caption>";
            echo "<tr>
                    <td>&nbsp;Cód.&nbsp;</td>
                    <td>&nbsp;RA&nbsp;</td>
                    <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>";

            // Obter questões da prova
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

            // Linha do Gabarito
            echo "<tr>
                    <td> </td>
                    <td> </td>
                    <td>&nbsp;Gabarito:&nbsp;</td>";

            foreach ($questoes as $questao_id) {
                $queryCorreta = "SELECT Correta FROM cadastro_questoes WHERE Codigo='$questao_id'";
                $resultadoCorreta = mysqli_query($con, $queryCorreta);
                $respostaCorretaArray = mysqli_fetch_assoc($resultadoCorreta);
                $respostaCorreta = $respostaCorretaArray ? $respostaCorretaArray['Correta'] : '';
                echo "<td bgcolor='yellow'>&nbsp;<b>$respostaCorreta</b>&nbsp;</td>";
            }
            echo "<td></td><td></td><td></td>";
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
                    $respostaCorretaArray = mysqli_fetch_assoc($resultadoCorreta);
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
        } else {
            echo "<p style='color: red;'>Código da prova não foi fornecido.</p>";
        }
    } else {
        $voltar = "login.php";
        header("Location: $voltar");
    }

    // Enviar o buffer de saída e encerrar
    ob_end_flush();
    ?>

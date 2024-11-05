<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
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
<!-- end header -->
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Relatórios</a><i class="icon-angle-right"></i></li>
                    <li class="active">Relatório por disciplinas</li>
                </ul>
            </div>
        </div>
    </div>
</section>
        
<section id="content">
<?php
    if (isset($_GET['codigo_prova'])) {
        $codigo_aluno = 0;
        $codigo_prova = $_GET['codigo_prova'];

        // Exibe título da prova
        $nq = "SELECT * FROM cadastro_provas WHERE codigo_prova='$codigo_prova'";
        $lq = mysqli_query($con, $nq);
        while ($lqc = mysqli_fetch_array($lq)) {
            echo "<center><table width='800'>
            <caption><h2>" . $lqc['Titulo'] . "</h2></caption>";
            date_default_timezone_set('America/Sao_Paulo');
            echo "<tr><td>Data do relatório: " . date("d/m/y") . "</td><td>&nbsp;&nbsp;&nbsp;</td>";
            echo "<td>Código: " . $codigo_prova . "</td>";
            echo "</tr></table></center><br>";
        }

        // Inicializa a matriz de disciplinas e questões
        $qdis = 1;
        $disciplinas = [0 => ""];
        $questdis = [0 => 0];
        $nq = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova'";
        $lqa = mysqli_query($con, $nq);

        while ($lqc = mysqli_fetch_array($lqa)) {
            $tempn = $lqc['Questao'];
            $qcor = "SELECT * FROM cadastro_questoes WHERE Codigo='$tempn'";
            $lqcor = mysqli_query($con, $qcor);

            while ($wlqcor = mysqli_fetch_array($lqcor)) {
                $disciplinas[$qdis] = $wlqcor['Disciplina'];
            }
            $questdis[$qdis] = $tempn;
            $qdis++;
        }

        $tempdisc = array_unique($disciplinas);
        $nomesdisciplinas = array_values(array_filter($tempdisc));

        foreach ($nomesdisciplinas as $value) {
            if ($value == "" || $value == NULL) continue;

            $linha = 1;
            echo "<center><br><table border='1'>";
            echo "<caption><h2>$value</h2></caption>";
            echo "<tr>
                <td>&nbsp;Cód.&nbsp;</td>
                <td>&nbsp;RA&nbsp;</td>
                <td width='200'>&nbsp;Nome do Aluno&nbsp;</td>";

            $nq = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova'";
            $lq = mysqli_query($con, $nq);
            $nq = 1;
            while ($lqc = mysqli_fetch_array($lq)) {
                if ($value == $disciplinas[$nq]) {
                    echo "<td>$nq</td>";
                }
                $nq++;
            }
            echo "<td></td><td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>";
            echo "</tr>";

            echo "<tr>
                <td> </td>
                <td> </td>
                <td>&nbsp;Gabarito:&nbsp;</td>";

            $nq = "SELECT * FROM tabela_questoes WHERE Codigo_Prova='$codigo_prova'";
            $lqa = mysqli_query($con, $nq);
            $nq = 1;
            while ($lqc = mysqli_fetch_array($lqa)) {
                $tempn = $lqc['Questao'];
                $qcor = "SELECT * FROM cadastro_questoes WHERE Codigo='$tempn'";
                $lqcor = mysqli_query($con, $qcor);

                while ($wlqcor = mysqli_fetch_array($lqcor)) {
                    if ($disciplinas[$nq] == $value && $questdis[$nq] == $tempn) {
                        echo "<td bgcolor='yellow'>&nbsp;<b>" . $wlqcor['Correta'] . "</b>&nbsp;</td>";
                    }
                }
                $nq++;
            }
            echo "<td></td><td></td><td></td><td></td>";
            echo "</tr>";

            $lista = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova='$codigo_prova'";
            $l = mysqli_query($con, $lista);
            while ($lc = mysqli_fetch_array($l)) {
                $codigo_aluno = $lc['Aluno'];
                $temp = "SELECT * FROM cadastro_alunos WHERE Codigo=$codigo_aluno";
                $temp2 = mysqli_query($con, $temp);

                while ($temp3 = mysqli_fetch_array($temp2)) {
                    $nome_aluno = $temp3['Nome'];
                    $ra_aluno = $temp3['RA'];
                }
                echo "<tr>
                    <td>&nbsp;$codigo_aluno&nbsp;</td>
                    <td>&nbsp;$ra_aluno&nbsp;</td>
                    <td>&nbsp;$nome_aluno&nbsp;</td>";

                $total_questoes = 0;
                $totdisto = 0;
                $pontos = 0;
                $pdisto = 0;

                $sql = "SELECT * FROM gabaritos WHERE Aluno=$codigo_aluno AND codprova='$codigo_prova'";
                $data = mysqli_query($con, $sql);
                $nq = 1;
                while ($dados = mysqli_fetch_array($data)) {
                    $matriz[$linha][$total_questoes] = 0;

                    if ($disciplinas[$nq] == $value && $questdis[$nq] == $dados['Questao']) {
                        echo "<td>";
                        if ($dados['Resposta_Aluno'] == $dados['Resposta_Correta']) {
                            echo "<span style='background-color: lightblue;'>&nbsp;" . $dados['Resposta_Aluno'] . "&nbsp;</span>";
                            $pdisto++;
                            $matriz[$linha][$total_questoes] = 1;
                        } else {
                            echo "<span>&nbsp;" . $dados['Resposta_Aluno'] . "&nbsp;</span>";
                        }
                        echo "</td>";
                        $totdisto++;
                    }

                    $total_questoes++;
                    $nq++;
                }

                echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
                echo $pdisto;
                $linha++;
                echo "</td>";
                echo "<td>&nbsp;&nbsp;";
                if ($totdisto > 0) {
                    echo round($pdisto / $totdisto * 10, 2);
                    echo "&nbsp;</td>";
                    echo "<td>&nbsp;&nbsp;";
                    echo round($pdisto / $totdisto * 100, 1);
                    echo "%";
                    echo "&nbsp;</td>";
                } else {
                    echo "0&nbsp;</td>";
                    echo "<td>&nbsp;&nbsp;";
                    echo "0%";
                    echo "&nbsp;</td>";
                }
                echo "</tr>";
            }

            echo "<tr><td>&nbsp;</td><td width='10'>&nbsp</td><td>&nbsp;Acertos:&nbsp;</td>";
            $i = 0;
            do {
                echo "<td>&nbsp;";
                $j = 1;
                $somamatriz = 0;
                do {
                    $somamatriz = $somamatriz + (isset($matriz[$j][$i]) ? $matriz[$j][$i] : 0);
                } while ($j++ <= $linha);

                echo $somamatriz;
                echo "&nbsp;</td>";
            } while ($i++ <= $total_questoes - 2);
            echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
            echo "</tr>";

            echo "<tr><td>&nbsp;</td><td>&nbsp</td><td>&nbsp;%Acertos:&nbsp;</td>";
            $i = 0;
            do {
                echo "<td>&nbsp;";
                $j = 1;
                $somamatriz = 0;
                do {
                    $somamatriz = $somamatriz + (isset($matriz[$j][$i]) ? $matriz[$j][$i] : 0);
                } while ($j++ <= $linha);

                echo round($somamatriz / ($linha - 1) * 100, 0);
                echo "%&nbsp;</td>";
            } while ($i++ <= $total_questoes - 2);
            echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
            echo "</tr>";
        }
        echo "</table></center><br><br>";
    }
}
else {
    $voltar = "login.php";
    header("Location: $voltar");
}
?>
</section>
<?php include 'footer.php'; ?>
      
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
    $nome  = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;

    if (isset($_GET['codigo_prova']) && isset($_GET['codigo_aluno'])) {
        $codigo_prova = $_GET['codigo_prova'];
        $codigo_aluno = $_GET['codigo_aluno'];
        $numero = isset($_GET['numero']) ? $_GET['numero'] : 1;

        // Obter o número total de questões da prova
        $total_questoes = 0;
        $sql = "SELECT * FROM gabaritos WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
        $data = mysqli_query($con, $sql);
        while ($dados = mysqli_fetch_array($data)) {
            $total_questoes++;
        }

        // Ajusta o número da questão atual para não ultrapassar os limites
        if ($numero > $total_questoes) {
            $numero = $total_questoes;
        }
        if ($numero < 1) {
            $numero = 1;
        }

        // Busca a questão atual
        $sql = "SELECT * FROM gabaritos WHERE Numero = $numero AND Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
        $r = mysqli_query($con, $sql);

        echo "<div style='margin-left: 200px;'>"; // Adiciona a margem na região da questão
        echo "<h2><small>Questão $numero de $total_questoes</small></h2>";

        // Exibir questão e respostas
        while ($dados = mysqli_fetch_array($r)) {
            $resposta = $dados['Resposta_Aluno'];
            $finalizado = $dados['Finalizado'];
            $rcorreta = $dados['Resposta_Correta'];
            $bqsql = "SELECT * FROM cadastro_questoes WHERE Codigo = " . $dados['Questao'];
            $resp1 = mysqli_query($con, $bqsql);

            while ($bqdados = mysqli_fetch_array($resp1)) {
                echo "<h3><small>Disciplina: " . $bqdados['Disciplina'] . "</small></h3><br>";
                echo "<h3><small>" . $bqdados['Questao'] . "</small></h3><br>";

                if ($bqdados['Figura'] && $bqdados['Figura'] != 'figuras/') {
                    echo "<a href=\"" . $bqdados['Figura'] . "\" target=\"_blank\" border=0><img src=\"" . $bqdados['Figura'] . "\" width=\"800\"></a>";
                    echo "<br><small>Clique na figura para ver no tamanho original.</small><br>";
                }

                // Exibir alternativas, sem a possibilidade de alterar
                $alternativas = ['A', 'B', 'C', 'D', 'E'];
                foreach ($alternativas as $alt) {
                    echo "<table><tr><td>";
                    echo "<h4><input type=\"radio\" name=\"resposta\" value=\"$alt\" ";
                    if ($resposta == $alt) {
                        echo " checked";
                    }
                    echo " disabled> $alt </h4>";
                    echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                    
                    // Exibir em vermelho se for a correta, em verde se foi a escolhida
                    if ($finalizado == "Sim" && $rcorreta == $alt) {
                        echo '<font color="red">';
                    } else {
                        echo ($resposta == $alt) ? '<font color="green">' : '<font color="black">';
                    }

                    echo $bqdados['Resposta' . $alt];
                    echo '</font>';
                    echo "</small></h4></td></tr></table>";
                }

                echo "<br>";
            }
        }
        echo "</div>"; // Fecha o bloco da margem para a questão

        // Navegação entre questões por número
        echo "<div style='margin-left: 200px;'>"; // Adiciona a margem na seleção de páginas
        echo "<br><br>";
        echo "<h4><small><table><tr>";

        // Exibe os números das questões, clicáveis
        for ($i = 1; $i <= $total_questoes; $i++) {
            echo "<td><center><a href=\"comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$i\" border=0>";
            if ($i == $numero) {
                echo "<strong>[$i]</strong>"; // Destaca a questão atual
            } else {
                echo "$i";
            }
            echo "</a>&nbsp;&nbsp;</center></td>";
        }

        echo "</tr></table></small></h4>";
        echo "</div>"; // Fecha o bloco da margem para a seleção de páginas
    }
} else {
    $voltar = "login.php";
    header("Location: $voltar");
}
?>

</div>
</div>
</div>
</section>

<?php include 'footer.php'; ?>

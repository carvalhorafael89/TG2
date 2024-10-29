<?php
// Iniciar sessão para verificar o modo
session_start();

if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Conectar ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

$nivel = $_COOKIE['Nivel'];
$nome = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];
$codigo_aluno = $codigo;

$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';
$is_professor_em_modo_aluno = $modo_aluno && $nivel === 'Professor';

if (isset($_GET['codigo_prova']) && isset($_GET['codigo_aluno'])) {
    $codigo_prova = $_GET['codigo_prova'];
    $codigo_aluno = $_GET['codigo_aluno'];
    $numero = isset($_GET['numero']) ? $_GET['numero'] : 1;

    // Se a resposta for enviada, atualize-a no banco de dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
        $resposta_aluno = $_POST['resposta'];
        $sql_update_resposta = "UPDATE gabaritos SET Resposta_Aluno = '$resposta_aluno' 
                                WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova' AND Numero = $numero";
        mysqli_query($con, $sql_update_resposta);
    }

    // Obter o número total de questões da prova
    $sql_total_questoes = "SELECT COUNT(*) as total FROM gabaritos WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
    $data_total = mysqli_query($con, $sql_total_questoes);
    $row_total = mysqli_fetch_assoc($data_total);
    $total_questoes = $row_total['total'];

    // Ajusta o número da questão atual
    $numero = max(1, min($numero, $total_questoes));

    // Buscar a questão atual
    $sql = "SELECT * FROM gabaritos WHERE Numero = $numero AND Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
    $data_questao = mysqli_query($con, $sql);
    $dados_questao = mysqli_fetch_assoc($data_questao);

    // Verifica se a questão foi encontrada
    if ($dados_questao) {
        $resposta = isset($dados_questao['Resposta_Aluno']) ? $dados_questao['Resposta_Aluno'] : '';
        $finalizado = isset($dados_questao['Finalizado']) ? $dados_questao['Finalizado'] : '';
        $rcorreta = isset($dados_questao['Resposta_Correta']) ? $dados_questao['Resposta_Correta'] : '';

        // Busca o texto da questão e as alternativas
        $questao_id = $dados_questao['Questao'];
        $sql_questao = "SELECT * FROM cadastro_questoes WHERE Codigo = $questao_id";
        $data_questao_texto = mysqli_query($con, $sql_questao);
        $questao_texto = mysqli_fetch_assoc($data_questao_texto);

        // Exibir a questão e as alternativas, se existir
        if ($questao_texto) {
            echo "<form method='POST'>";
            echo "<div style='margin-left: 200px;'>";
            echo "<h2><small>Questão $numero de $total_questoes</small></h2>";
            echo "<h3><small>Disciplina: " . $questao_texto['Disciplina'] . "</small></h3><br>";
            echo "<h3><small>" . $questao_texto['Questao'] . "</small></h3><br>";

            if (!empty($questao_texto['Figura']) && $questao_texto['Figura'] != 'figuras/') {
                echo "<a href=\"" . $questao_texto['Figura'] . "\" target=\"_blank\"><img src=\"" . $questao_texto['Figura'] . "\" width=\"800\"></a>";
                echo "<br><small>Clique na figura para ver no tamanho original.</small><br>";
            }

            // Exibir alternativas, bloqueadas caso finalizado
            $alternativas = ['A', 'B', 'C', 'D', 'E'];
            foreach ($alternativas as $alt) {
                echo "<table><tr><td>";
                echo "<h4><input type=\"radio\" name=\"resposta\" value=\"$alt\" ";
                if ($resposta == $alt) {
                    echo " checked";
                }
                echo ($finalizado === "Sim") ? " disabled" : ""; // Bloqueia se finalizado
                echo "> $alt </h4>";
                echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";

                // Verifique se a chave 'Resposta_' . $alt existe antes de tentar exibi-la
                $resposta_texto = isset($questao_texto['Resposta' . $alt]) ? $questao_texto['Resposta' . $alt] : 'Resposta não disponível';

                // Exibir em vermelho se for a correta, em verde se foi a escolhida
                if ($finalizado == "Sim" && $rcorreta == $alt) {
                    echo '<font color="red">';
                } else {
                    echo ($resposta == $alt) ? '<font color="green">' : '<font color="black">';
                }

                echo $resposta_texto; // Exibir o texto da resposta ou uma mensagem padrão
                echo '</font>';
                echo "</small></h4></td></tr></table>";
            }

            // Navegação entre questões
            echo "<div style='margin-left: 200px;'>";
            $numero = 1;
            if ($numero > 1) {
                $anterior = $numero - 1;
                echo "<button type='submit' formaction='comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$anterior' class='btn btn-secondary'>Voltar</button>";
            }
            if ($numero < $total_questoes) {
                $proximo = $numero + 1;
                echo "<button type='submit' formaction='comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$proximo' class='btn btn-primary'>Avançar</button>";
            } else {
                echo "<button type='submit' formaction='finalprv.php' class='btn btn-success'>Finalizar Prova</button>";
            }

            echo "</div>";
            echo "</form>";
        } else {
            echo "<p style='color: red;'>Questão não encontrada.</p>";
        }
    } else {
        echo "<p style='color: red;'>Questão não encontrada no banco de dados.</p>";
    }
} else {
    $voltar = "login.php";
    header("Location: $voltar");
    exit();
}

?>
</div>
</div>
</div>
</section>
<?php include 'footer.php'; ?>

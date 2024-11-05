<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Conectar ao banco de dados
require_once 'conecta.php';

ob_start();
include 'cabecalho.php';

$nivel = $_COOKIE['Nivel'];
$codigo_aluno = $_COOKIE['Codigo'];

// Verificar se o usuário é um professor em modo aluno
$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';
$is_professor_em_modo_aluno = $modo_aluno && $nivel === 'Professor';

if (isset($_GET['codigo_prova']) && isset($_GET['codigo_aluno'])) {
    $codigo_prova = mysqli_real_escape_string($con, $_GET['codigo_prova']);
    $codigo_aluno = (int)$_GET['codigo_aluno'];

    // Verificar se a prova já foi finalizada pelo aluno
    $sql_verifica_finalizado = "SELECT Finalizado FROM gabaritos WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova' LIMIT 1";
    $resultado_finalizado = mysqli_query($con, $sql_verifica_finalizado);

    if (!$resultado_finalizado) {
        die("Erro na consulta: " . mysqli_error($con));
    }

    $dados_finalizado = mysqli_fetch_assoc($resultado_finalizado);

    echo "<div style='text-align: center;'>";

    // Permitir acesso se for um professor em modo aluno, mesmo que a prova esteja finalizada
    if ($dados_finalizado && $dados_finalizado['Finalizado'] === 'Sim' && !$is_professor_em_modo_aluno) {
        echo "<p style='color: red;'>Esta prova já foi finalizada e não pode ser alterada.</p>";
        echo "<p><a href='index.php'>Voltar à página inicial</a></p>";
    } else {
        $total_questoes = 0;
        $pontos = 0;

        $sql = "SELECT * FROM gabaritos WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova'";
        $data = mysqli_query($con, $sql);

        if (!$data) {
            die("Erro ao buscar gabaritos: " . mysqli_error($con));
        }

        echo "<h2>Resultados da Prova</h2>";
        echo "<table border='1' style='margin: 0 auto;'>";
        echo "<tr><td><h4>Questão</h4></td><td><h4>Resposta do Aluno</h4></td><td><h4>Situação</h4></td></tr>";

        while ($dados = mysqli_fetch_assoc($data)) {
            echo "<tr><td><h4>" . htmlspecialchars($dados['Numero']) . "</h4></td><td><h4>" . htmlspecialchars($dados['Resposta_Aluno']) . "</h4></td><td><h4>";

            if ($dados['Resposta_Aluno'] == $dados['Resposta_Correta']) {
                echo "<font color='green'>Correta</font>";
                $pontos++;
            } else {
                echo "<font color='red'>Incorreta</font>";
            }

            echo "</h4></td></tr>";
            $total_questoes++;
        }

        echo "</table>";
        
        $nota = $total_questoes > 0 ? ($pontos / $total_questoes) * 10 : 0;
        echo "<div style='margin-top: 20px;'>";
        echo "<h2>Total de acertos: $pontos</h2>";
        echo "<h2>Nota (0 a 10): " . round($nota, 2) . "</h2>";

        // Atualizar o status para "Finalizado" apenas se não for um professor em modo aluno
        if (!$is_professor_em_modo_aluno) {
            $sql_update = "UPDATE gabaritos SET Finalizado = 'Sim' WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova'";
            if (!mysqli_query($con, $sql_update)) {
                die("Erro ao atualizar status de finalização: " . mysqli_error($con));
            } else {
                echo "<p>Status de finalização atualizado com sucesso!</p>";
            }
        }

        echo "</div>";
    }
    echo "</div>";
} else {
    $voltar = "index.php";
    header("Location: $voltar");
    exit();
}
?>
</div>
</div>
</div>
</section>
<?php include 'footer.php'; ?>

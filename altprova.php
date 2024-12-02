<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

$mensagem_erro = ""; // Variável para armazenar a mensagem de erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_prova = $_POST['prova'];

    // Verifica se o código da prova existe no banco de dados
    $sql_verifica_prova = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
    if ($stmt_prova = $con->prepare($sql_verifica_prova)) {
        $stmt_prova->bind_param("s", $codigo_prova);
        $stmt_prova->execute();
        $stmt_prova->store_result();

        if ($stmt_prova->num_rows > 0) {
            // Se a prova existir, redireciona para a página de inclusão/remoção com o modo 'adicionar'
            header("Location: inccquestao.php?prova=$codigo_prova&modo=inserir");
            exit();
        } else {
            // Se a prova não existir, define a mensagem de erro
            $mensagem_erro = "Código da prova inválido. Tente novamente.";
        }

        $stmt_prova->close();
    } else {
        $mensagem_erro = "Erro ao preparar a consulta. Tente novamente.";
    }
}

include 'cabecalho.php'; // Inclui o cabeçalho somente após a verificação
?>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                <form role="form" class="register-form" method="POST" action="altprova.php">
                    <h2>Seleção de Prova: <small>Digite o código da prova que deseja alterar.</small></h2>
                    <div class="form-group">
                        <input type="text" name="prova" id="prova" class="form-control input-lg" placeholder="Código da Prova" required>
                        <?php if (!empty($mensagem_erro)): ?>
                            <small class="text-danger"><?php echo $mensagem_erro; ?></small>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Alterar" class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

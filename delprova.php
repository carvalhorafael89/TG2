<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

$mensagem_sucesso = "";
$mensagem_erro = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_prova = $_POST['prova'];

    // Verifica se o código da prova existe no banco de dados
    $sql_verifica_prova = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
    if ($stmt_prova = $con->prepare($sql_verifica_prova)) {
        $stmt_prova->bind_param("s", $codigo_prova);
        $stmt_prova->execute();
        $stmt_prova->store_result();

        if ($stmt_prova->num_rows > 0) {
            // Exclui todas as entradas relacionadas ao código da prova em todas as tabelas necessárias
            $tables = ['gabaritos', 'tabela_questoes', 'cadastro_provas']; // Adicione mais tabelas conforme necessário

            foreach ($tables as $table) {
                $sql_delete = "DELETE FROM $table WHERE codigo_prova = ?";
                if ($stmt_delete = $con->prepare($sql_delete)) {
                    $stmt_delete->bind_param("s", $codigo_prova);
                    if (!$stmt_delete->execute()) {
                        $mensagem_erro[] = "Erro ao excluir da tabela $table: " . $stmt_delete->error;
                    }
                    $stmt_delete->close();
                } else {
                    $mensagem_erro[] = "Erro na preparação da consulta de exclusão para a tabela $table: " . $con->error;
                }
            }

            if (empty($mensagem_erro)) {
                $mensagem_sucesso = "Prova e todos os dados relacionados foram excluídos com sucesso.";
            }
        } else {
            // Se a prova não existir, define mensagem de erro
            $mensagem_erro[] = "Código da prova inválido. Tente novamente.";
        }

        $stmt_prova->close();
    } else {
        $mensagem_erro[] = "Erro ao preparar a consulta. Tente novamente.";
    }
}

include 'cabecalho.php'; // Inclui o cabeçalho somente após a verificação
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
                    <li class="active">Excluir Prova/Simulados</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                <form role="form" class="register-form" method="POST" action="delprova.php">
                    <h2>Excluir Prova: <small>Digite o código da prova que deseja excluir. <br><strong style="color: red;">Aviso: Esta ação é irreversível e irá apagar todos os dados associados à prova.</strong></small></h2>
                    <?php if (!empty($mensagem_sucesso)): ?>
                        <div class="alert alert-success">
                            <?php echo $mensagem_sucesso; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($mensagem_erro)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($mensagem_erro as $erro): ?>
                                    <li><?php echo $erro; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input type="text" name="prova" id="prova" class="form-control input-lg" placeholder="Código da Prova" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Excluir Prova" class="btn btn-danger btn-block btn-lg" onclick="return confirm('Tem certeza de que deseja excluir esta prova e todos os dados associados? Esta ação é irreversível.')">
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

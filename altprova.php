<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_prova = $_POST['prova'];

    // Verifica se o código da prova existe no banco de dados
    $sql_verifica_prova = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
    if ($stmt_prova = $con->prepare($sql_verifica_prova)) {
        $stmt_prova->bind_param("s", $codigo_prova);
        $stmt_prova->execute();
        $stmt_prova->store_result();

        if ($stmt_prova->num_rows > 0) {
            // Se a prova existir, redireciona para a página de alteração
            header("Location: inccquestao.php?prova=$codigo_prova&codigo_aluno=$codigo_aluno");
            exit();
        } else {
            // Se a prova não existir, exibe mensagem de erro
            echo "<script>
                alert('Código da prova inválido. Tente novamente.');
                window.location.href = 'altprova.php';
            </script>";
            exit(); // Termina a execução após o alerta
        }

        $stmt_prova->close();
    } else {
        echo "<p style='color:red;'>Erro na preparação da consulta do código da prova. Tente novamente.</p>";
    }
}

include 'cabecalho.php'; // Inclui o cabeçalho somente após a verificação
?>

<!-- Página de Alteração de Prova adaptada ao layout de login -->
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
                    <li class="active">Alterar Prova/Simulados</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                <form role="form" class="register-form" method="POST" action="altprova.php">
                    <h2>Seleção de Prova: <small>Digite o código da prova que deseja alterar.</small></h2>
                    <div class="form-group">
                        <input type="text" name="prova" id="prova" class="form-control input-lg" placeholder="Código da Prova" required>
                        <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
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

<?php
// Iniciar buffer de saída
ob_start();

if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Conectar ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome  = $_COOKIE['Nome'];
    $email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Alunos</a><i class="icon-angle-right"></i></li>
                    <li class="active">Verificar Prova / Simulados</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-6">
                <form role="form" class="register-form" method="POST" action="veprova.php">
                    <h2 style="text-align: center;">Atenção: <small>Digite o código da prova que deseja verificar.</small></h2>
                    <div class="form-group">
                        <label for="codigo_prova">Código da Prova</label>
                        <input type="text" name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Digite o código da prova" required>
                    </div>
                    
                    <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
                    <div class="row justify-content-center">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Verificar Respostas" class="btn btn-primary btn-block btn-lg">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo_prova']) && isset($_POST['codigo_aluno'])) {
    $codigo_prova = mysqli_real_escape_string($con, $_POST['codigo_prova']);
    $codigo_aluno = (int)$_POST['codigo_aluno'];

    // Verificar o status de finalização da prova
    $sql_verifica_finalizado = "SELECT Finalizado FROM gabaritos WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova' LIMIT 1";
    $resultado_finalizado = mysqli_query($con, $sql_verifica_finalizado);

    if (!$resultado_finalizado) {
        echo "<p style='color: red; text-align: center;'>Erro na consulta: " . mysqli_error($con) . "</p>";
    } else {
        $dados_finalizado = mysqli_fetch_assoc($resultado_finalizado);

        if ($dados_finalizado) {
            $finalizado = $dados_finalizado['Finalizado'];

            // Redirecionar para comeca.php com o status de finalização
            header("Location: comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&finalizado=$finalizado");
            exit();
        } else {
            echo "<p style='color: red; text-align: center;'>Prova não encontrada ou não iniciada.</p>";
        }
    }
}

include 'footer.php';

// Enviar o buffer de saída e encerrar
ob_end_flush();
} else {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
}
?>

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

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $codigo_prova = $_POST['codigo_prova'];

        // Verifica se o código da prova existe no banco de dados
        $sql_verifica_prova = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
        if ($stmt_prova = $con->prepare($sql_verifica_prova)) {
            $stmt_prova->bind_param("s", $codigo_prova);
            $stmt_prova->execute();
            $stmt_prova->store_result();

            if ($stmt_prova->num_rows > 0) {
                // Se a prova existir, verifica se o aluno já realizou a prova
                $sql_verifica = "SELECT * FROM gabaritos WHERE Aluno = ? AND Prova = ? AND Finalizado = 'Sim'";
                if ($stmt = $con->prepare($sql_verifica)) {
                    $stmt->bind_param("is", $codigo_aluno, $codigo_prova);
                    $stmt->execute();
                    $stmt->store_result();
                    
                    if ($stmt->num_rows > 0) {
                        // Prova já realizada - redireciona para verprova.php
                        header("Location: veprova.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno");
                        exit();
                    } else {
                        // Prova não realizada - redireciona para comeca.php
                        header("Location: comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno");
                        exit();
                    }

                    $stmt->close();
                } else {
                    echo "<p style='color:red;'>Erro na preparação da verificação da prova. Tente novamente.</p>";
                }
            } else {
                // Se a prova não existir, exibe mensagem de erro
                echo "<script>
                    alert('Código da prova inválido. Tente novamente.');
                    window.location.href = 'realiza.php';
                </script>";
            }

            $stmt_prova->close();
        } else {
            echo "<p style='color:red;'>Erro na preparação da consulta do código da prova. Tente novamente.</p>";
        }
    }
?>

<!-- end header -->
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Alunos</a><i class="icon-angle-right"></i></li>
                    <li class="active">Realizar Prova/Simulados</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-0">
                <form role="form" class="register-form" method="POST" action="realiza.php">
                    <h2>Seleção de Prova: <small>Insira o código da prova que deseja realizar.</small></h2>
                    <div class="form-group">
                        <input type="text" name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" required>
                        <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Acessar" class="btn btn-primary btn-block btn-lg" tabindex="7">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
}
?>

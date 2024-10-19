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
                <form role="form" class="register-form" method="POST" action="fazprova.php">
                    <h2>Seleção de Prova: <small>Escolha o código da prova que deseja realizar.</small></h2>
                    <div class="form-group">
                        <select name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4">
                            <?php
                            $sql = "SELECT * from cadastro_provas";
                            $data = mysqli_query($con, $sql);
                            while ($dados = mysqli_fetch_array($data)) {
                                echo "<option>" . $dados['Codigo_prova'] . "</option>";
                            }
                            ?>
                        </select>
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
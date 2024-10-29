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
                    <li class="active">Verificar Prova / Simulados</li>
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
                    <h2>Atenção: <small>Digite o código da prova que deseja verificar.</small></h2>
                    <div class="form-group">
                        <label for="codigo_prova">Código da Prova</label>
                        <select name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4" required>
                            <option value="" disabled selected>Selecione o código da prova</option>
                            <?php
                                $sql = "SELECT DISTINCT Prova FROM gabaritos WHERE Aluno = $codigo_aluno";
                                $data = mysqli_query($con, $sql);
                                while ($dados = mysqli_fetch_array($data)) {
                                    echo "<option value='" . $dados['Prova'] . "'>" . $dados['Prova'] . "</option>";
                                }
                            ?>
                        </select>
                    </div>
                    
                    <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Verificar Respostas" class="btn btn-primary btn-block btn-lg" tabindex="7">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
} else {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
}
?>

    <?php

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

if (isset($_GET['acesso'])) {   
    $acesso = $_GET['acesso']; 
} else {  
    $acesso = "ok"; 
}

// Define a classe de erro se o acesso for negado
$erroClasse = ($acesso == "denied") ? 'border-danger' : '';
?>

<!-- end header -->
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Home</a><i class="icon-angle-right"></i></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6">
                <form role="form" class="register-form" method="POST" action="prologin.php">
                    <?php
                    if ($acesso != "denied") {
                        echo '<h2>Bem-vindo(a) <small>Acesse sua conta</small></h2>';
                    } else {
                        echo '<h2>Atenção: <small>E-mail ou senha incorretos</small></h2>';
                    }
                    ?>
                    
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg <?php echo $erroClasse; ?>" placeholder="Endereço de E-Mail" tabindex="4">
                    </div>
                    <div class="form-group">
                        <input type="password" name="senha" id="senha" class="form-control input-lg <?php echo $erroClasse; ?>" placeholder="Senha" tabindex="5">
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-md-6">
                            <input type="submit" value="Entrar" class="btn btn-primary btn-block btn-lg" tabindex="6">
                        </div>
                        <div class="col-xs-12 col-md-6">Não possui Acesso ? <a href="cadAluno.php">Cadastre-se aqui!</a></div>
                        <div class="col-xs-12 col-md-6">Esqueceu a senha ? <a href="esqsenha.php">Clique aqui!</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>
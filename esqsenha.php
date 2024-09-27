<?php

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';

?>


  <!-- end header -->
  <section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Home</a><i class="icon-angle-right"></i></li>
          <li class="active">Esqueceu a senha</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
  <section id="content">
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form role="form" class="register-form" method="POST" action="prosenha.php">
                <h2>Esqueceu a Senha: <small>Digite seu e-mail cadastrado</small></h2>
      
      <hr class="colorgraph">

      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Endereço de E-Mail" tabindex="4">
      </div>
      

      <div class="row">
        <div class="col-xs-4 col-sm-3 col-md-3">
          
        </div>
      </div>
      
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-6"><input type="submit" value="Enviar Senha" class="btn btn-primary btn-block btn-lg" tabindex="6"></div>
                                <div class="col-xs-12 col-md-6">Não possui Acesso ? <a href="cadAluno.php">Cadastre-se aqui!</a></div>
      </div>
    </form>
  </div>
</div>

</div>
  </section>

        <?php
        include 'footer.php';
        ?>
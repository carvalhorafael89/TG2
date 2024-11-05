
<?php
if (!isset($_COOKIE['Nivel']))
{
    
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
}  
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';

if (isset($_COOKIE['Nivel']))
{
    
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
    $codigo_aluno=$codigo;
                    

?>
<!-- end header -->
  <section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
          <li class="active">Finalizar Prova</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">
<div class="container">

<div class="row">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <form role="form" class="register-form" method="POST" action="poefim.php">
                               
      <h2>Atenção: <small>A prova será fechada e finalizada para todos os aluno!.</small></h2>


      <div class="form-group">
        <select name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4">
          <?php
  
                    $sql="SELECT * from cadastro_provas";
                    $data=mysqli_query($con,$sql);
                    while ($dados=mysqli_fetch_array($data))
                    {
                        echo "<option>";
                        echo $dados['Codigo_prova'];
                        echo "</option>";
                    }
           ?>
        </select>
        <!-- <input type="text" name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4"> -->
                                <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-6"><input type="submit" value="Gerar Relatório" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
        
      </div>
    </form>
  </div>
</div>

</div>
  </section>
<?php

include 'footer.php';


}
else
{
    
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
}
?>
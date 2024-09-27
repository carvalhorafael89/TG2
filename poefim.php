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
          <li><a href="index.php">Relatórios</a><i class="icon-angle-right"></i></li>
          <li class="active">Relatório Geral para Excel</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">

<?php
 if (isset($_POST['codigo_prova']))
                {
                    
                    $codigo_prova=$_POST['codigo_prova'];
                    
                    $sql="update gabaritos SET Finalizado= 'Sim' where Prova='".$codigo_prova."'";
                    
                    mysqli_query($con,$sql);
                    
                  echo "<center><h2>Todas as provas em andamento com código ".$codigo_prova." foram finalizadas para os alunos.</h2></center>";
          
        }
   
}
                

else
{
    $voltar="login.php";
    header("Location: $voltar");
}
  
  
  
  
 
?>
 
</section>
<?php include 'footer.php'; ?>
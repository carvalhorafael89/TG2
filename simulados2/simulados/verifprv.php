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
  <div class="col-lg-12">
<?php

                if (isset($_GET['codigo_prova']))
                {
                    if (isset($_GET['codigo_aluno']))  
                    {
                    $codigo_prova=$_GET['codigo_prova'];
                    
                    $codigo_aluno=$_GET['codigo_aluno'];
                                    
                    $total_questoes=0;
                    $pontos=0;
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    echo "<table>";
                    echo "<tr><td><h4>Questão</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta do Aluno</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta Correta</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Situação</h4></td></tr>";
                    while ($dados=mysqli_fetch_array($data))
                    {
                        echo "<tr><td><h4>";
                        echo $dados['Numero'];
                        echo "</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>";
                        echo $dados['Resposta_Aluno'];
                        echo "</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>";
                        echo $dados['Resposta_Correta'];
                        echo "</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>";
                        if ($dados['Resposta_Aluno']==$dados['Resposta_Correta'])
                        {
                            echo "<font color=green>Correta</font>";
                            $pontos=$pontos+1;
                        }
                        else
                        {
                            echo "<font color=red>Incorreta</font>";
                        }
                        echo "</h4></td></tr>";
                       $total_questoes=$total_questoes+1;
                    }
                    
                    echo "</table>";
                    echo "<H2>Total de acertos: ".$pontos;
                    $nota=round ($pontos/$total_questoes*10,2);
                    echo "</h2><h2>Nota (0 a 10): ".$nota."</h2>";
                    
                    }
                }
                
}
else
{
    $voltar="login.php";
    header("Location: $voltar");
}
?>
 </div>
</div>
</div>
</section>
<?php include 'footer.php'; ?>
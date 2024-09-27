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
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
          <li class="active">Cadastrar Questão</li>
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
                if (isset($_POST['nome']))
                {
                    $nome=$_POST['nome'];
                    $senha=$_POST['senha'];
                    $ra=$_POST['ra'];
                    $cpf=$_POST['cpf'];
                    $email=$_POST['email'];
                    $curso=$_POST['curso'];
                    $semestre=$_POST['semestre'];
                    $ano=$_POST['ano'];
                    
                    $valido=0;
                    $vsql="select * from cadastro_alunos";
                    $vr=mysqli_query($con,$vsql);
                   
                    while ($dados=mysqli_fetch_array($vr))
                    {
                       if (trim($dados['EMail'])==trim($email))
                       {
                         $valido=1;
                       }
                        
                    }
                  
                    if ($valido==0) {
                    $sql= "insert INTO cadastro_alunos (Nome, Senha, Ra, CPF, Email, Curso, Turma, Semestre, Ano) VALUES ( '".$nome."', '".$senha."', '".$ra."', '".$cpf."', '".$email."', '".$curso."',' ','".$semestre."', '".$ano."')";
                   //echo $sql;
                   //mysqli_query($con, "insert into cursos (curso) values ('Eletr. Automotiva')");
                      mysqli_query($con, $sql); 
                      echo '  <h1>Aluno Cadastrado com sucesso!</h1>
                        <p></p>
                        <p></p>';
                      }
  else
  {
    echo '<h1>O E-Mail já existe na base de dados!</h1>
                        <p></p>
                        <p></p>';
                    
                    
                         
  }
 
  }
                else
                {
                    
?>
                
                        <h1>Ocorreu uma falha no cadastro de dados.</h1>
                        <p></p>
                        <p></p>
                    
 <?php
                } // fecha else
?>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
</div>
</section>

        <?php
            include 'footer.php';
    
        ?>    

        
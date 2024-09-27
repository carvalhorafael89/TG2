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
                    
    if ($nivel=='Professor')
    {
        
    
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
                if (isset($_POST['questao']))
                {
                    
                    if (isset($_FILES['arquivo']['name'])){
                      $uploaddir = 'figuras/';
                    $arquivo = $uploaddir. $_FILES['arquivo']['name'];
                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo)) {
                    echo "<h2>O arquivo de imagem foi gravado com sucesso.</h2>";}
                    }
                    else {
                        $arquivo="";
                        echo "<h2>O arquivo de imagem não pôde ser gravado.</h2>";
                    }

                    $disciplina=$_POST['disciplina'];
                    $questao=$_POST['questao'];
                    $A=$_POST['A'];
                    $B=$_POST['B'];
                    $C=$_POST['C'];
                    $D=$_POST['D'];
                    $E=$_POST['E'];
                    $correta=$_POST['correta'];
                    $positivo=$_POST['positivo'];
                    $negativo=$_POST['negativo'];
                    $professor=$_POST['professor'];
                    
                    $sql= "insert INTO cadastro_questoes (Disciplina, Questao, RespostaA, RespostaB, RespostaC, RespostaD, RespostaE, Correta, Feedback_Positivo, Feedback_Negativo, Professor_Responsavel, Figura) VALUES ( '".$disciplina."', '".$questao."', '".$A."', '".$B."', '".$C."', '".$D."','".$E."', '".$correta."', '".$positivo."', '".$negativo."','".$professor."','".$arquivo."')";
                   //echo $sql;
                   //mysqli_query($con, "insert into cursos (curso) values ('Eletr. Automotiva')");
                    mysqli_query($con, $sql);
                    
                
                ?>
                
                
                
                 <h2>Questão cadastrada com sucesso na base de dados!</h2>
                        
<?php
                }
                else
                {
                    
?>
                
                        <h2>Ocorreu uma falha no cadastro da questão.</h2>
                        
                    
           
 <?php
                } // fecha else
}
else
{
    $voltar="login.php";
    header("Location: $voltar");
}

                }
                else{
                    $voltar="login.php";
                header("Location: $voltar");
    }
?>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
</div>
</session>


        <?php
            include 'footer.php';
    
        ?>    

        
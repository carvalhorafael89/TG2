<?php

require_once 'conecta.php';

include 'cabecalho.php';

// Envia a senha para o e-mail informado
//
if(isset($_POST['email']))
{
    $email=$_POST['email'];
    
    
    //echo $email;
    
    
    $sql="select * from cadastro_alunos";
    $existe=0;
    $data=mysqli_query($con,$sql);
    while ($dados=mysqli_fetch_array($data))
       {
           if ($dados['EMail']==$email)
           {
           
                $nivel="Aluno";
                $nome=$dados['Nome'];
                $Email=$dados['EMail'];
                $codigo=$dados['Codigo'];
				$senha=$dados['Senha'];
                
				// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
                // O return-path deve ser ser o mesmo e-mail do remetente.
				$headers = "MIME-Version: 1.1\r\n";
				$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
				$headers .= "From: suporte@professorrenato.com.br\r\n"; // remetente
				$headers .= "Return-Path: eu@seudominio.com\r\n"; // return-path
				$emaildestinatario=$Email;
				$assunto="Lembrar Senha de Acesso";
				$mensagemHTML="Segundo solicitado, sua senha de acesso : ".$senha;
				if(!mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender))
				{ // Se for Postfix
                       $headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
                       mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
				}
				
				
                $existe=1;
                $voltar="index.php";
                //header("Location: $voltar");
            
            
        }
        
       }
    
    
}
?>

 <!-- end header -->
  <section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Home</a><i class="icon-angle-right"></i></li>
          <li class="active">Lembrar a senha</li>
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
		<?php
			if ($existe==1)
			{
				echo '
                <h2>Senha enviada para seu e-mail.</h2>';
			}
			else {
			echo '<h2>Dados não encontrados.</h2>';}
			?>
      
      <hr class="colorgraph">

      
  </div>
</div>

</div>
  </section>

        <?php
        include 'footer.php';
        ?>

<?php
// Programa para a realização de simulados on-line
// Professor Renato Luiz Cardoso
// Set/2018

// Ativa o bloco que conecta ao banco de dados
header('Content-Type: text/html; charset=utf-8');
require_once 'conecta.php';

?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
    

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="Sistema para a realização de simulados e provas on-line">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" href="apple-touch-icon.png">

        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="css/main.css">

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
 <?php
    include 'menutopo.php';
    
 ?>
        <div class="main-container">
            <div class="main wrapper clearfix">

                <?php
                if (isset($_POST['nome']))
                {
                    $nome=$_POST['nome'];
                    $senha=$_POST['senha'];
                    $email=$_POST['email'];
                    $telefone=$_POST['telefone'];
                    
                   $sql= "insert INTO cadastro_professor (Nome, Senha, Email, Telefone) VALUES ( '".$nome."', '".$senha."','".$email."', '".$telefone."')";
                   //echo $sql;
                   //mysqli_query($con, "insert into cursos (curso) values ('Eletr. Automotiva')");
                    mysqli_query($con, $sql);
                    
                
                ?>
                
                
                <article>
                    <header>
                        <h1>Professor Cadastrado com sucesso!</h1>
                        <p></p>
                    </header>
                    <section>
                    
                        
            </section>
                    
            </article>
<?php
                }
                else
                {
                    
?>
                <article>
                    <header>
                        <h1>Ocorreu uma falha no cadastro de dados.</h1>
                        <p></p>
                    </header>
                    <section>
                    
                        
            </section>
                    
            </article>
 <?php
                } // fecha else
?>

            </div> <!-- #main -->
        </div> <!-- #main-container -->

        <?php
            include 'footer.php';
    
        ?>    

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
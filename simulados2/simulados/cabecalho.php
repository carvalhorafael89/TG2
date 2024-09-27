<?php

  // Verifica e o usuário realizou o LogIN e o nível de acesso do mesmo.
  
  if (isset($_COOKIE['Nivel']))
  {
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
                
  }
else
{
    $nivel ="Visitante";
    
}
    
echo '
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Sistema para a realização de simulados e provas on-lineplate" />
        <title>Sistema para a realização de simulados e provas on-line</title>
        <meta name="author" content="Renato Luiz Cardoso, professor" />
        
        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />  
        <link href="css/cubeportfolio.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <!-- Theme skin -->
        <link id="t-colors" href="skins/default.css" rel="stylesheet" />

        <!-- boxed bg -->
        <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
  
  
        <!-- O bloco a seguir corrige uma falha de bullet no template/design. Não remover -->
  
        <style type"text/css">
            <!--
                li {  list-style: none; }
                ul {  list-style: none; }
            -->
        </style>
 

    </head>
    <body>

    <div id="wrapper">
      <!-- start header -->
      <header>
      <div class="top">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <ul class="topleft-info">
                <li><i class=""></i>';


if (isset($_COOKIE['Nome']))
{
    echo 'Olá,&nbsp;&nbsp;'.$nome.'</li>';   
}
else
{
    echo 'Olá,&nbsp;&nbsp;bem-vindo(a)</li>';
}
echo '
              </ul>
            </div>
            <div class="col-md-6">
            <div id="sb-search" class="sb-search">
              <form>
                <input class="sb-search-input" placeholder="Digite o termo para pesquisa..." type="text" value="" name="search" id="search">
                <input class="sb-search-submit" type="submit" value="">
                <span class="sb-icon-search" title="Clique para iniciar a busca"></span>
              </form>
            </div>


            </div>
          </div>
        </div>
      </div>  
      
        <div class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="" width="199" height="52" /></a>
                </div>
                <div class="navbar-collapse collapse ">
                    <ul class="nav navbar-nav">';
  if ($nivel!="Professor"){ echo '<li class="dropdown active">
      <a href="index.php" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Alunos<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="realiza.php">Realizar Prova/Simulado</a></li>
                                <li><a href="veprova.php">Rever Prova/Simulado</a></li>';
     // Habilita menu de cadastro
     if ( $nivel == "Visitante") {  echo '<li><a href="cadAluno.php">Realizar Cadastro</a></li>'; }
  
                        echo '</ul>        
            
                          </li>'; }

                        if ($nivel=="Professor"){
                        echo '<li class="dropdown">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Professor <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                              <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown">Questões</a>
          <ul class="dropdown-menu">
                                            <li><a href="cadquestao.php">Incluir</a></li>
                                            <li><a href="#">Alterar</a></li>
                                            <li><a href="#">Excluir</a></li>
                                            
          </ul>  
        </li>
                                <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown">Provas</a>
          <ul class="dropdown-menu">
                                            <li><a href="cadprova.php">Criar nova prova ou simulado</a></li>
                                            <li><a href="altprova.php">Alterar prova ou simulado</a></li>
                                            <li><a href="altprova.php">Excluir prova ou simulado</a></li>
                                            <li><a href="realiza2.php">Testar  prova ou simulado</a></li>
                                            <li><a href="rel6.php">Encerra todas as provas em andamento</a></li>
                                            
          </ul>  
        </li>
                                <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown">Alunos</a>
          <ul class="dropdown-menu">
                                            <li><a href="cadAluno.php">Cadastrar Aluno(a)</a></li>
                                            <li><a href="#">Alterar dados de Aluno(a)</a></li>
                                            <li><a href="#">Excluir Aluno(a)</a></li>
                                            <li><a href="#">Pesquisar Aluno Cadastrado</a></li>
          </ul>  
        </li>
                                <li class="dropdown-submenu">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown">Relatórios</a>
          <ul class="dropdown-menu">
                                            <li><a href="rel1.php">Relatório geral da prova</a></li>
                                            <li><a href="rel2.php">Relatório da prova por disciplina</a></li>
                                            <li><a href="rel3.php">Relatório por aluno</a></li>
                                            <li><a href="rel4.php">Relatório para Impressão</a></li>
                                            <li><a href="rel5.php">Baixar relatório geral em Excel</a></li>
                          
          </ul>  
        </li>
                            </ul>
                        </li>';}
                        
                        echo '
                        <li><a href="#">Perfil</a></li>                      
                        <li><a href="#">Contato</a></li>';
  
  
                          if ( $nivel == "Visitante") {
                            echo '<li><a href="login.php">LogIn</a>'; }
                          else { echo '<li><a href="sair.php">Sair</a></li>'; }
  
  
                   echo ' </ul>
                </div>
            </div>
        </div>
  </header>
';
?>
<!-- Fim do cabeçalho -->
<?php
// Verificar se a sessão já foi iniciada antes de chamar session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Definir o nível padrão como "Visitante"
$nivel = "Visitante";

// Verifica se os cookies estão definidos
if (isset($_COOKIE['Nivel']) && isset($_COOKIE['Nome']) && isset($_COOKIE['Email']) && isset($_COOKIE['Codigo'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
} else {
    // Se não houver cookies, os valores padrão são para um visitante
    $nome = "Visitante";
}

// Inicialmente, o modo não deve ser aluno ou professor se for visitante ou aluno
if ($nivel === "Professor" && !isset($_SESSION['modo'])) {
    $_SESSION['modo'] = 'professor'; // Define modo professor se o usuário for professor e estiver logado
}

// Verifica se o modo aluno está ativo
$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';

// Alterar o estilo da barra superior se o modo aluno estiver ativo
$top_bar_style = $modo_aluno ? "background-color: red; color: white; font-weight: bold; padding: 20px 20px; border: none; cursor: pointer;" : "";

// Estilização do botão faixa de segurança
$button_style = "background-color: red; color: white; font-weight: bold; margin-top: 8px; padding: -2px 5px; border: none; cursor: pointer;"; //border-radius: 10px; font-size: 12px;";



// Teste para verificar o modo
//echo 'Modo atual: ' . (isset($_SESSION['modo']) ? $_SESSION['modo'] : 'não definido');

echo '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Sistema para a realização de simulados e provas on-line" />
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

    <!-- Corrige uma falha de bullet no template/design. Não remover -->
    <style type="text/css">
        li { list-style: none; }
        ul { list-style: none; }
        .faixa-botao {
            ' . $button_style . '
        }
    </style>
</head>

<body>

<div id="wrapper">
  <!-- start header -->
  <header>
  <div class="top" style="' . $top_bar_style . '">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <ul class="topleft-info">
            <li><i class=""></i>';

            if ($nivel !== "Visitante") {
              
          
              // Verifica se o modo aluno está ativo e exibe a indicação
              if ($modo_aluno) {
                echo '<style="' . $button_style . '">Olá,&nbsp;' . $nome;
                echo '<style="' . $button_style . '">&nbsp&nbsp (Modo Aluno)';

              }else{
                echo 'Olá,&nbsp;&nbsp;' . $nome;
              }
          
              echo '</li>';
          } else {
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
            <a class="navbar-brand" href="index.php"><img src="img/logo.png" alt="" width="120" height="72" /></a>
        </div>
        <div class="navbar-collapse collapse ">
            <ul class="nav navbar-nav">';

// Adicionar botão para alternar entre modo aluno e professor, apenas para professores
if ($nivel == "Professor") {
  echo '<li>
      <form method="GET" action="mudar_modo.php" style="display: inline;">
          <input type="hidden" name="modo" value="' . ($modo_aluno ? 'professor' : 'aluno') . '">
          <button type="submit" class="faixa-botao">
              <span style="' . $button_style . '">' . ($modo_aluno ? 'Sair do Modo Aluno' : 'Entrar no Modo Aluno') . '</span>
          </button>
      </form>
  </li>';
}



// Menu de navegação com base no nível de acesso
if ($nivel == "Aluno" || $modo_aluno) {
    echo '<li class="dropdown active">
    <a href="index.php" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Aluno <i class="fa fa-angle-down"></i></a>
    <ul class="dropdown-menu">
        <li><a href="realiza.php">Realizar Prova/Simulado</a></li>
        <li><a href="veprova.php">Rever Prova/Simulado</a></li>
    </ul>
    </li>
    <li><a href="#">Perfil</a></li>';
} elseif ($nivel == "Professor") {
    echo '<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">Professor <i class="fa fa-angle-down"></i></a>
    <ul class="dropdown-menu">
        <li class="dropdown-submenu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Questões</a>
          <ul class="dropdown-menu">
              <li><a href="cadquestao.php">Incluir</a></li>
              <li><a href="inccquestao.php">Alterar</a></li>
              <li><a href="#">Excluir</a></li>
          </ul>  
        </li>
        <li class="dropdown-submenu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Provas</a>
          <ul class="dropdown-menu">
              <li><a href="cadprova.php">Criar nova prova ou simulado</a></li>
              <li><a href="altprova.php">Alterar prova ou simulado</a></li>
              <li><a href="altprova.php">Excluir prova ou simulado</a></li>
              <li><a href="realiza.php">Testar prova ou simulado</a></li>
              <li><a href="rel6.php">Encerra todas as provas em andamento</a></li>
          </ul>  
        </li>
        <li class="dropdown-submenu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Alunos</a>
          <ul class="dropdown-menu">
              <li><a href="cadAluno.php">Cadastrar Aluno(a)</a></li>
              <li><a href="#">Alterar dados de Aluno(a)</a></li>
              <li><a href="#">Excluir Aluno(a)</a></li>
              <li><a href="#">Pesquisar Aluno Cadastrado</a></li>
          </ul>  
        </li>
        <li class="dropdown-submenu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">Relatórios</a>
          <ul class="dropdown-menu">
              <li><a href="rel1.php">Relatório geral da prova</a></li>
              <li><a href="rel2.php">Relatório da prova por disciplina</a></li>
              <li><a href="rel3.php">Relatório por aluno</a></li>
              <li><a href="rel4.php">Relatório para Impressão</a></li>
              <li><a href="rel5.php">Baixar relatório geral em Excel</a></li>
          </ul>  
        </li>
    </ul>
    </li>
    <li><a href="#">Perfil</a></li>';
}

if ($nivel == "Visitante") {
    echo '<li><a href="login.php">Login</a></li>
          <li><a href="verifica.php">Cadastre-se</a></li>';
} else {
    echo '<li><a href="sair.php">Sair</a></li>';
}

echo ' </ul>
        </div>
    </div>
</div>
</header>
';
?>

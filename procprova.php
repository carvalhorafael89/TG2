<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;
                    
    if ($nivel == 'Professor') {
?>
<!-- end header -->
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
          <li class="active">Cadastrar Prova</li>
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
        if (isset($_POST['titulo'])) {
            $titulo = $_POST['titulo'];
            $codigo = $_POST['codigo'];
            $disciplina = $_POST['disciplina'];
            $professor = $_POST['professor'];
            $horas = $_POST['horas'];
            $minutos = $_POST['minutos'];
            $codigoacesso = $_POST['codigoacesso'];
            $quantidade = $_POST['quantidade'];
            $descricao = $_POST['descricao'];
            
            $sql = "INSERT INTO cadastro_provas (Titulo, Codigo_Prova, Disciplina, Professor, Duracao_Horas, Duracao_Minutos, Codigo_Acesso, Numero_Questoes, Descricao) VALUES ('$titulo', '$codigo', '$disciplina', '$professor', '$horas', '$minutos', '$codigoacesso', '$quantidade', '$descricao')";
            
            if (mysqli_query($con, $sql)) {
        ?>
        
            <h1>Prova cadastrada com sucesso! Selecione, a seguir, as questões que deseja incluir.</h1>
            <p></p>
            <h2>Clique <a href="inccquestao.php?prova=<?php echo urlencode($codigo); ?>&modo=inserir">aqui</a> para cadastrar questões para esta prova</h2>
        
        <?php
            } else {
        ?>
            <h1>Ocorreu uma falha no cadastro de dados.</h1>
            <p></p>
        <?php
            }
        } else {
        ?>
            <h1>Ocorreu uma falha no envio dos dados do formulário.</h1>
            <p></p>
        <?php
        } // fecha else
    }
}
?>

            </div> <!-- #main -->
        </div> <!-- #main-container -->
</div>
</section>

<?php
include 'footer.php';
?>

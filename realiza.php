<?php
// Iniciar sessão para verificar o modo
session_start();

// Verificar se o usuário está no "Modo Aluno"
$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';

// Verificar se os cookies já estão definidos, se não, redirecionar para login
if (!isset($_COOKIE['Nome']) || !isset($_COOKIE['Email']) || !isset($_COOKIE['Codigo'])) {
    // Redireciona para a página de login se os cookies não existirem
    header("Location: login.php?acesso=denied");
    exit();
}

// Recupera os dados dos cookies
$nome = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];
$nivel = $_COOKIE['Nivel'];

// Se o nível for "Professor" e não estiver no modo aluno, bloqueie o acesso
if ($nivel == 'Professor' && !$modo_aluno) {
    echo "<p style='color: red;'>Professores não podem realizar provas ou simulados a menos que ativem o Modo Aluno.</p>";
    echo "<p><a href='index.php'>Voltar à página inicial</a></p>";
    exit();
}

// Definir o código do aluno com base no modo
if ($modo_aluno || $nivel === 'Aluno') {
    $codigo_aluno = $codigo;
}

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
          <li><a href="index.php">Alunos</a><i class="icon-angle-right"></i></li>
          <li class="active">Realizar Prova / Simulados</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="content">
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-md-7 col-sm-offset-2 col-md-offset-0">
        <form role="form" class="register-form" method="POST" action="fazprova.php">
      <h2>Atenção: <small>Você está logado como <?php echo $modo_aluno ? 'Professor (Modo Aluno)' : 'Aluno'; ?> "<strong><?php echo $nome; ?></strong>"<br>
      <?php
      if ($modo_aluno) {
          echo 'Para voltar ao modo professor, clique em <a href="mudar_modo.php?modo=professor">Sair do Modo Aluno</a>.';
      } else {
          echo 'Para utilizar as opções de professor, clique em sair e acesse novamente.';
      }
      ?>
      </small></h2>

      <div class="form-group">
        <select name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4">
          <?php
            // Obter todas as provas disponíveis no banco de dados
            $sql = "SELECT * FROM cadastro_provas";
            $data = mysqli_query($con, $sql);
            while ($dados = mysqli_fetch_array($data)) {
                echo "<option>";
                echo $dados['Codigo_prova'];
                echo "</option>";
            }
          ?>
        </select>

        <input type="hidden" name="codigo_aluno" value="<?php echo $codigo_aluno; ?>">
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-6">
            <input type="submit" value="Acessar" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
      </div>
    </form>
  </div>
</div>
</div>
</section>
<?php
include 'footer.php';
?>

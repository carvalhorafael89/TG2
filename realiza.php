<?php
// Iniciar o buffer de saída para evitar problemas com header() mais tarde
ob_start();

// Iniciar sessão para verificar o modo
session_start();

// Verificar se o usuário está no "Modo Aluno"
$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';

// Verificar se os cookies já estão definidos, se não, redirecionar para login
if (!isset($_COOKIE['Nome']) || !isset($_COOKIE['Email']) || !isset($_COOKIE['Codigo'])) {
    header("Location: login.php?acesso=denied");
    exit();
}

// Recupera os dados dos cookies
$nome = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];
$nivel = $_COOKIE['Nivel'];

// Se o nível for "Professor" e não estiver no modo aluno, ative automaticamente o Modo Aluno
if ($nivel == 'Professor' && !$modo_aluno) {
  $_SESSION['modo'] = 'aluno';
  $modo_aluno = true;
  $codigo_aluno = 0; // código genérico "0" para o modo aluno do professor
}

// Definir o código do aluno com base no modo
if ($nivel === 'Aluno') {
    $codigo_aluno = $codigo;
} elseif ($modo_aluno && $nivel === 'Professor') {
    // Se for um professor no Modo Aluno, usa o código de aluno genérico "0"
    $codigo_aluno = 0;
}

// conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

// Variável para armazenar a mensagem de erro
$erro_codigo = "";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $codigo_prova = $_POST['codigo_prova'];

  // Verificar se o código da prova existe no banco de dados
  $sql = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("s", $codigo_prova);
  $stmt->execute();
  $result = $stmt->get_result();

  // Se o código da prova não existir, define a mensagem de erro
  if ($result->num_rows === 0) {
      $erro_codigo = "Código da prova inválido. Verifique com seu professor.";
  } else {
      // Verificar se o aluno já realizou a prova, exceto se for um professor em modo aluno
      if (!$modo_aluno || ($modo_aluno && $nivel !== 'Professor')) {
          $sql_verifica_resposta = "SELECT * FROM gabaritos WHERE Aluno = ? AND codprova = ? AND Finalizado = 'Sim'";
          $stmt_verifica = $con->prepare($sql_verifica_resposta);
          $stmt_verifica->bind_param("is", $codigo_aluno, $codigo_prova);
          $stmt_verifica->execute();
          $resultado_resposta = $stmt_verifica->get_result();

          if ($resultado_resposta->num_rows > 0) {
              $erro_codigo = "Você já realizou esta prova. Verifique com seu professor.";
          } else {
              // Redirecionar para a página da prova se ainda não foi realizada
              header("Location: fazprova.php?codigo_prova=" . urlencode($codigo_prova) . "&codigo_aluno=" . urlencode($codigo_aluno));
              exit();
          }
      } else {
          // Permitir acesso se for um professor em modo aluno
          header("Location: fazprova.php?codigo_prova=" . urlencode($codigo_prova) . "&codigo_aluno=" . urlencode($codigo_aluno));
          exit();
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
        <form role="form" class="register-form" method="POST" action="">
      <h2>Atenção: <small>Você está logado como <?php echo $modo_aluno ? 'Professor (Modo Aluno)' : 'Aluno'; ?> "<strong><?php echo $nome; ?></strong>"<br>
      <?php
      if ($modo_aluno) {
          echo 'Para voltar ao modo professor, clique em <a href="mudar_modo.php?modo=professor">Sair do Modo Aluno</a>.';
      }
      ?>
      </small></h2>

      <div class="form-group">
        <!-- Campo para inserção manual do código da prova -->
        <label for="codigo_prova">Digite abaixo o código que você recebeu de seu professor</label>
        <input type="text" name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Digite o Código da Prova" required tabindex="4">
        
        <?php if ($erro_codigo): ?>
            <p style="color: red;"><?php echo $erro_codigo; ?></p>
        <?php endif; ?>

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
ob_end_flush(); // Finalizar e enviar o buffer de saída
?>

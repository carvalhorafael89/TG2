<?php
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

// Verificar se o professor está no "modo aluno"
session_start();
if (isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno') {
    $modo_aluno = true;
} else {
    $modo_aluno = false;
}

// Definir os cookies novamente para manter a sessão ativa
setcookie("Nome", $nome, time() + (3600 * 6));
setcookie("Email", $email, time() + (3600 * 6));
setcookie("Codigo", $codigo, time() + (3600 * 6));
setcookie("Nivel", $nivel, time() + (3600 * 6)); // Não altere o nível

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';
?>

<!-- HTML para alternar entre Modo Professor e Modo Aluno -->
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 d-flex justify-content-between align-items-center">
        <div>
          <!-- Botão para alternar entre modo aluno e modo professor -->
          <?php if ($modo_aluno): ?>
            <a href="mudar_modo.php?modo=professor" class="btn btn-warning">Sair do Modo Aluno</a>
          <?php else: ?>
            <a href="mudar_modo.php?modo=aluno" class="btn btn-info">Entrar no Modo Aluno</a>
          <?php endif; ?>
        </div>
        <div>
          <ul class="breadcrumb d-inline">
            <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
            <?php if ($modo_aluno): ?>
              <li class="active">Modo Aluno - Testando Prova/Simulado</li>
            <?php else: ?>
              <li class="active">Gerenciar Provas / Simulados (Professor)</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-md-7 col-sm-offset-2 col-md-offset-0">
        <form role="form" class="register-form" method="POST" action="fazprova.php">
          <h2>Atenção: <small>
          <?php if ($modo_aluno): ?>
            Você está logado como Aluno "<?php echo $nome; ?>" para testar as provas.<br>
            Para voltar ao modo professor, clique no botão acima.
          <?php else: ?>
            Você está logado como Professor. <br>
            Para testar como aluno, clique no botão "Entrar no Modo Aluno".
          <?php endif; ?>
          </small></h2>

          <div class="form-group">
            <select name="codigo_prova" id="codigo_prova" class="form-control input-lg" placeholder="Código da Prova" tabindex="4" 
            <?php if (!$modo_aluno) echo "disabled"; ?>> <!-- Desabilita o campo se não estiver no modo aluno -->
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

            <input type="hidden" name="codigo_usuario" value="<?php echo $codigo; ?>">
          </div>
          
          <div class="row">
            <div class="col-xs-12 col-md-6">
                <input type="submit" value="Acessar" class="btn btn-primary btn-block btn-lg" tabindex="7" 
                <?php if (!$modo_aluno) echo "disabled"; ?>> <!-- Desabilita o botão se não estiver no modo aluno -->
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

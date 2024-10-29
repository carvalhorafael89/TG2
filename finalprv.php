<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

require_once 'conecta.php';

ob_start();
include 'cabecalho.php';
ob_end_clean();

$nivel = $_COOKIE['Nivel'];
$codigo_aluno = $_COOKIE['Codigo'];

if (isset($_POST['codigo_prova']) && isset($_POST['codigo_aluno'])) {
  $codigo_prova = $_POST['codigo_prova'];
  $codigo_aluno = $_POST['codigo_aluno'];

  // Verificar se a prova já foi finalizada pelo aluno
  $sql_verifica_finalizado = "SELECT Finalizado FROM gabaritos WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova' LIMIT 1";
  $resultado_finalizado = mysqli_query($con, $sql_verifica_finalizado);
  
  if (!$resultado_finalizado) {
      die("Erro na consulta: " . mysqli_error($con));
  }

  $dados_finalizado = mysqli_fetch_assoc($resultado_finalizado);

  if ($dados_finalizado && $dados_finalizado['Finalizado'] === 'Sim') {
      echo "<p style='color: red;'>Esta prova já foi finalizada e não pode ser alterada.</p>";
      echo "<p><a href='index.php'>Voltar à página inicial</a></p>";
  } else {
      $total_questoes = 0;
      $pontos = 0;

      $sql = "SELECT * FROM gabaritos WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
      $data = mysqli_query($con, $sql);

      echo "<table>";
      echo "<tr><td><h4>Questão</h4></td><td><h4>Resposta do Aluno</h4></td><td><h4>Resposta Correta</h4></td><td><h4>Situação</h4></td></tr>";
      while ($dados = mysqli_fetch_array($data)) {
          echo "<tr><td><h4>{$dados['Questao']}</h4></td><td><h4>{$dados['Resposta_Aluno']}</h4></td><td><h4>{$dados['Resposta_Correta']}</h4></td><td><h4>";
          if ($dados['Resposta_Aluno'] == $dados['Resposta_Correta']) {
              echo "<font color='green'>Correta</font>";
              $pontos++;
          } else {
              echo "<font color='red'>Incorreta</font>";
          }
          echo "</h4></td></tr>";
          $total_questoes++;
      }

      echo "</table>";
      echo "<h2>Total de acertos: $pontos</h2>";
      $nota = ($pontos / $total_questoes) * 10;
      echo "<h2>Nota (0 a 10): " . round($nota, 2) . "</h2>";

      // Atualizar o status para "Finalizado"
      $sql_update = "UPDATE gabaritos SET Finalizado = 'Sim' WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
      if (!mysqli_query($con, $sql_update)) {
          die("Erro ao atualizar status de finalização: " . mysqli_error($con));
      } else {
          echo "<p>Status de finalização atualizado com sucesso!</p>";
      }
  }
} else {
  $voltar = "index.php";
  header("Location: $voltar");
  exit();
}

?>
</div>
</div>
</div>
</section>
<?php include 'footer.php'; ?>

<?php
// Iniciar o buffer de saída para evitar problemas com redirecionamento
ob_start();

// Verificar autenticação do usuário
if (!isset($_COOKIE['Nivel']) || $_COOKIE['Nivel'] !== 'Professor') {
    header("Location: login.php?acesso=denied");
    exit();
}

// Conectar ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

$codigo_questao = $_GET['codigo'];
$codigo_prova = $_GET['prova'];

// Verificar se a conexão foi bem-sucedida
if ($con === false) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

// Buscar dados da questão
$sql = "SELECT * FROM cadastro_questoes WHERE Codigo = ?";
$stmt = $con->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if ($stmt) {
    $stmt->bind_param("i", $codigo_questao);
    $stmt->execute();
    $questao = $stmt->get_result()->fetch_assoc();
    $stmt->close();
} else {
    die("Erro ao preparar consulta: " . $con->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remover_imagem'])) {
        // Verificar e remover apenas a imagem associada à questão na coluna Figura
        $sql_remover_imagem = "UPDATE `cadastro_questoes` SET `Figura` = 'figuras/' WHERE Codigo = ?";
        $stmt_remover_imagem = $con->prepare($sql_remover_imagem);
        if ($stmt_remover_imagem) {
            $stmt_remover_imagem->bind_param("i", $codigo_questao);
            if ($stmt_remover_imagem->execute()) {
                echo "<p style='color: green;'>Imagem removida com sucesso.</p>";
                // Atualizar a variável $questao para refletir a mudança
                $questao['Figura'] = 'figuras/';
            } else {
                echo "<p style='color: red;'>Erro ao remover a imagem.</p>";
            }
            $stmt_remover_imagem->close();
        } else {
            die("Erro ao preparar a consulta de remoção de imagem: " . $con->error);
        }
    } else {
        // Coletar dados do formulário para atualização
        $disciplina = $_POST['disciplina'];
        $questao_texto = $_POST['questao'];
        $A = $_POST['A'];
        $B = $_POST['B'];
        $C = $_POST['C'];
        $D = $_POST['D'];
        $E = $_POST['E'];
        $correta = $_POST['correta'];
        $positivo = isset($_POST['positivo']) ? $_POST['positivo'] : '';
        $negativo = isset($_POST['negativo']) ? $_POST['negativo'] : '';
        $professor = $_POST['professor'];
        $nova_figura = '';

        // Verificar se um novo arquivo de figura foi carregado
        if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'figuras/'; // Diretório de upload
            $nova_figura = $upload_dir . basename($_FILES['arquivo']['name']);
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $nova_figura);
        } else {
            // Manter a figura existente se não houver um novo upload
            $nova_figura = $questao['Figura'];
        }

 // Atualizar os dados da questão
 $sql_update = "UPDATE cadastro_questoes SET Disciplina = ?, Questao = ?, RespostaA = ?, RespostaB = ?, RespostaC = ?, RespostaD = ?, RespostaE = ?, Correta = ?, Feedback_Positivo = ?, Feedback_Negativo = ?, Professor_Responsavel = ?, Figura = ? WHERE Codigo = ?";
 $stmt_update = $con->prepare($sql_update);

 if ($stmt_update) {
     $stmt_update->bind_param("ssssssssssssi", $disciplina, $questao_texto, $A, $B, $C, $D, $E, $correta, $positivo, $negativo, $professor, $nova_figura, $codigo_questao);

     if ($stmt_update->execute()) {
         header("Location: inccquestao.php?prova=$codigo_prova&sucesso=alterado");
         exit();
     } else {
         echo "Erro ao atualizar a questão.";
     }
     $stmt_update->close();
 } else {
     die("Erro ao preparar consulta de atualização: " . $con->error);
 }
}
}
?>

<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
          <li class="active">Alterar Questão</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="content">
<div class="container">
<div class="row">
    <div class="col-lg-12">
        <form role="form" class="register-form" method="POST" enctype="multipart/form-data">
             <h2>Alterar Questão:</h2>
             <h2><small>Edite os dados da questão abaixo e clique em "Salvar Alterações".</small></h2>
                    
             <table>
                <tr>
                <td style="font-weight: bold;">Disciplina:</td>
                    <td><input type="text" name="disciplina" size="40" value="<?php echo htmlspecialchars($questao['Disciplina']); ?>"></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Questão:</td>
                    <td><textarea name="questao" rows="5" cols="80"><?php echo htmlspecialchars($questao['Questao']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">A:</td>
                    <td><textarea name="A" rows="3" cols="80"><?php echo htmlspecialchars($questao['RespostaA']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">B:</td>
                    <td><textarea name="B" rows="3" cols="80"><?php echo htmlspecialchars($questao['RespostaB']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">C:</td>
                    <td><textarea name="C" rows="3" cols="80"><?php echo htmlspecialchars($questao['RespostaC']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">D:</td>
                    <td><textarea name="D" rows="3" cols="80"><?php echo htmlspecialchars($questao['RespostaD']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">E:</td>
                    <td><textarea name="E" rows="3" cols="80"><?php echo htmlspecialchars($questao['RespostaE']); ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Correta:</td>
                    <td>
                        <select name="correta">
                            <?php foreach (['A', 'B', 'C', 'D', 'E'] as $alt): ?>
                                <option value="<?php echo $alt; ?>" <?php echo ($questao['Correta'] == $alt) ? 'selected' : ''; ?>><?php echo $alt; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Feedback Positivo:</td>
                    <td><textarea name="positivo" rows="3" cols="80"><?php echo isset($questao['Feedback_Positivo']) ? htmlspecialchars($questao['Feedback_Positivo']) : ''; ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Feedback Negativo:</td>
                    <td><textarea name="negativo" rows="3" cols="80"><?php echo isset($questao['Feedback_Negativo']) ? htmlspecialchars($questao['Feedback_Negativo']) : ''; ?></textarea></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Figura:</td>
<td>
    <?php if (!empty($questao['Figura']) && $questao['Figura'] !== 'figuras/'): ?>
        <p>Figura atual: <a href="<?php echo $questao['Figura']; ?>" target="_blank">Visualizar</a></p>
    <?php else: ?>
        <p>Sem imagem disponível</p>
    <?php endif; ?>
    <div style="display: flex; align-items: center;">
        <input name="arquivo" type="file" style="flex: 1;">
        <!-- Exibir o caminho da imagem ao lado do botão "Browse..." -->
        <?php if (!empty($questao['Figura']) && $questao['Figura'] !== 'figuras/'): ?>
            <span style="margin-left: 10px;"><?php echo htmlspecialchars($questao['Figura']); ?></span>
        <?php endif; ?>
        <div style="margin-left: 10px;">
            <button type="submit" name="remover_imagem" class="btn btn-delete" onclick="return confirm('Tem certeza de que deseja remover a imagem?');">Remover Imagem</button>
        </div>
    </div>
</td>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
                <td style="font-weight: bold;">Professor:</td>
                    <td><input type="text" name="professor" size="40" value="<?php echo htmlspecialchars($questao['Professor_Responsavel']); ?>"></td>
                </tr>
                <tr><td>&nbsp;</td><td></td></tr>
                <tr>
    <td></td>
    <td>
        <div style="display: flex; gap: 10px;">
            <input type="submit" value="Salvar Alterações" class="btn btn-primary btn-lg">
            <button type="submit" name="delete" onclick="return confirm('Tem certeza de que deseja apagar esta questão?');" class="btn btn-danger btn-lg">Apagar Questão</button>
        </div>
    </td>
</tr>
             </table>
        </form>
    </div>
</div>
</div>
</section>

<?php include 'footer.php'; ?>

<?php
// Enviar o conteúdo do buffer e encerrar
ob_end_flush();
?>

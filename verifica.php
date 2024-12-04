<?php
// Inclui cabeçalho
include 'cabecalho.php';

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

// Inicializa variáveis
$erro = '';
$raErrorStyle = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o valor do RA e sanitiza a entrada
    $ra = isset($_POST['ra']) ? filter_var($_POST['ra'], FILTER_SANITIZE_STRING) : '';

    // Valida o campo RA
    if (!empty($ra)) {
        // Prepara a consulta SQL
        $sql = "SELECT * FROM cadastro_alunos WHERE ra = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $ra);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Redireciona para a página de cadastro com RA na URL
            echo "<script>
                window.location.href = 'cadAluno.php?ra=" . htmlspecialchars($ra, ENT_QUOTES, 'UTF-8') . "';
            </script>";
        } else {
            // Exibe mensagem de erro
            echo "<script>
                alert('Aluno não encontrado.');
                window.history.back();
            </script>";
            exit;
        }
    } else {
        // Se o campo não foi preenchido, exibe mensagem de erro
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, insira RA ou CPF.</p>";
        $raErrorStyle = 'border: 2px solid red;';
    }
}
?>

<!-- Página de verificação de RA -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Exibe mensagem de erro -->
                <?php if (!empty($erro)) : ?>
                    <div class="alert alert-danger"><?= $erro; ?></div>
                <?php endif; ?>

                <form role="form" class="register-form" method="POST" action="">
                    <h1>Verificar Cadastro:</h1>
                    <p>Insira seu RA para verificar se você já possui cadastro no sistema.</p>
                    <table>
                        <!-- Campo de RA -->
                        <tr>
                            <td> RA:</td>
                            <td><input type="text" name="ra" size="20" style="<?= $raErrorStyle; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                        
                        <!-- Botão de Enviar -->
                        <tr>
                            <td></td>
                            <td><input type="submit" name="verificar" value="Verificar"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

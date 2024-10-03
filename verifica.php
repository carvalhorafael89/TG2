<?php
// Inclui cabeçalho
include 'cabecalho.php';

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

// Inicializa a variável de erro
$erro = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o valor do RA ou CPF
    $ra_cpf = $_POST['ra_cpf'] ?? '';

    // Verifica se o campo foi preenchido
    if (!empty($ra_cpf)) {
        // Verifica se o valor é RA ou CPF no banco de dados
        $sql = "SELECT * FROM cadastro_alunos WHERE ra = '$ra_cpf' OR cpf = '$ra_cpf'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Se RA ou CPF já existe, redireciona para a página de login
            echo "<script>
                alert('RA ou CPF já cadastrado. Redirecionando para login...');
                window.location.href = 'login.php';
            </script>";
        } else {
            // Se não existe, redireciona para a página de cadastro com o valor de RA ou CPF
            header("Location: cadAluno.php?ra_cpf=" . urlencode($ra_cpf));
            exit;
        }
    } else {
        // Se o campo não foi preenchido, exibe uma mensagem de erro
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, insira RA ou CPF.</p>";
    }
}
?>

<!-- Página de verificação de RA ou CPF -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Exibe a mensagem de erro, se houver -->
                <?php if (!empty($erro)) { echo $erro; } ?>

                <form role="form" class="register-form" method="POST" action="">
                    <h1>Verificar Cadastro:</h1>
                    <p>Insira seu RA ou CPF para verificar se você já possui cadastro no sistema.</p>
                    <table>
                        <!-- Campo de RA ou CPF -->
                        <tr>
                            <td> RA ou CPF:</td>
                            <td><input type="text" name="ra_cpf" size="20"></td>
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
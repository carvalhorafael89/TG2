<?php
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

// Inicializa variáveis para mensagens de erro e estilos de campo
$erro = '';
$raErrorStyle = '';
$cpfErrorStyle = '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o valor do RA e do CPF
    $ra = $_POST['ra'] ?? ''; // Se o campo não existir, atribui uma string vazia
    $cpf = $_POST['cpf'] ?? ''; // O mesmo para o CPF

    // Verifica se RA ou CPF foi preenchido
    if (empty($ra) && empty($cpf)) {
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, preencha RA ou CPF.</p>";
        $raErrorStyle = 'border: 2px solid red;';
        $cpfErrorStyle = 'border: 2px solid red;';
    } else {
        // Verifica se RA ou CPF já existe no banco de dados
        $sql = "SELECT * FROM cadastro_alunos WHERE ra = '$ra' OR cpf = '$cpf'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            // RA ou CPF já existe no banco
            echo "<script>
                alert('RA ou CPF já cadastrado. Redirecionando para login...');
                window.location.href = 'login.php';
            </script>";
        } else {
            // Continua com o cadastro completo
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $confirma_senha = $_POST['confirma_senha'];
                $curso = $_POST['curso'];
                $semestre = $_POST['semestre'];
                $ano = $_POST['ano'];

                // Verificação de senha (pura em PHP)
                if ($senha !== $confirma_senha) {
                    echo "<p style='color:red; font-weight:bold;'>As senhas não coincidem. Tente novamente.</p>";
                } else {
                    // Aqui você pode inserir o código para salvar os dados no banco de dados
                    echo "<p style='color:green;'>Cadastro realizado com sucesso!</p>";
                    // Coloque aqui a sua lógica de inserção no banco de dados.
                }
            }
        }
    }
}
?>

<!-- Formulário de cadastro de alunos -->
<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                // Exibe mensagem de erro, se houver
                if (!empty($erro)) {
                    echo $erro;
                }
                ?>
                <form role="form" class="register-form" method="POST" action="">
                    <h1>Novo Cadastro:</h1>
                    <p>Preencha os dados abaixo e clique em "Cadastrar".</p>
                    <table>
                        <!-- Campo de RA -->
                        <tr>
                            <td> RA:</td>
                            <td><input type="text" name="ra" size="20" value="<?php echo $ra ?? ''; ?>" style="<?php echo $raErrorStyle; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                        
                        <!-- Campo de CPF -->
                        <tr>
                            <td> CPF:</td>
                            <td><input type="text" name="cpf" size="20" value="<?php echo $cpf ?? ''; ?>" style="<?php echo $cpfErrorStyle; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                        
                        <!-- Outros dados do aluno -->
                        <tr>
                            <td> Nome:</td>
                            <td><input type="text" name="nome" size="50"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Senha -->
                        <tr>
                            <td> Senha de acesso:</td>
                            <td><input type="password" name="senha" size="12"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Confirmar Senha -->
                        <tr>
                            <td> Repita a senha:</td>
                            <td><input type="password" name="confirma_senha" size="12"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> E-Mail:</td>
                            <td><input type="text" name="email" size="50"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> Curso:</td>
                            <td><select name="curso">
                                <?php
                                    $sql = "SELECT * FROM cursos";
                                    $r = mysqli_query($con, $sql);
                                    while ($dados = mysqli_fetch_array($r)) {
                                        echo "<option>".$dados['curso']."</option>";
                                    }
                                ?>
                            </select></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> Semestre:</td>
                            <td><select name="semestre">
                                <?php
                                    $i = 1;
                                    do { echo "<option>".$i."o. Semestre</option>"; } while ($i++ < 9);
                                ?>
                            </select></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> Ano:</td>
                            <td><select name="ano">
                                <?php
                                    $i = 2010;
                                    do { echo "<option>$i</option>"; } while ($i++ < 2030);
                                ?>
                            </select></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" name="enviar" value="Cadastrar"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

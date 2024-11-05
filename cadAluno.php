<?php
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

// Inicializa variáveis para mensagens de erro e estilos de campo
$erro = '';
$raErrorStyle = '';
$cpfErrorStyle = '';


// Inicializa a variável $ra como vazia se não estiver definida
$ra = isset($_GET['ra']) ? $_GET['ra'] : '';
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o valor do RA e do CPF
    $ra = isset($_POST['ra']) ? $_POST['ra'] : ''; // Adiciona verificação para a variável $ra
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : ''; //
    
    // Verifica se RA ou CPF foi preenchido
    if (empty($ra) && empty($cpf)) {
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, preencha RA ou CPF.</p>";
        $raErrorStyle = 'border: 2px solid red;';
        $cpfErrorStyle = 'border: 2px solid red;';
    } else {
// Verifica se o RA foi passado como parâmetro na URL ou inicializa como vazio
$ra = isset($_GET['ra']) ? $_GET['ra'] : '';

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
                    // Query de inserção no banco de dados
                    $sql_insert = "INSERT INTO cadastro_alunos (Nome, Senha, RA, CPF, Curso, EMail, Semestre, Ano) 
                                   VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
                    // Preparando a query
                    if ($stmt = $con->prepare($sql_insert)) {
                        // Bind dos parâmetros
                        $stmt->bind_param("ssssssis", $nome, $senha, $ra, $cpf, $curso, $email, $semestre, $ano);
        
                        // Executando a query
                        if ($stmt->execute()) {
                            // Sucesso no cadastro, redireciona para a página de login
                            echo "<script>
                                alert('Cadastro realizado com sucesso!');
                                window.location.href = 'login.php';
                            </script>";
                        } else {
                            // Exibe erro caso não consiga realizar o cadastro
                            echo "<p style='color:red;'>Erro ao realizar o cadastro. Tente novamente.</p>";
                        }
        
                        // Fechando o statement
                        $stmt->close();
                    } else {
                        // Exibe erro de preparação de query
                        echo "<p style='color:red;'>Erro na preparação da query. Tente novamente.</p>";
                    }
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
                            <td><input type="text" name="ra" size="20" value="<?php echo htmlspecialchars($ra); ?>"></td>
                        </tr>
                            <td>&nbsp;</td><td></td></tr>
                            
                        
                        <!-- Campo de CPF -->
                        <tr>
                            <td> CPF:</td>
                            <td><input type="text" name="cpf" size="20" value="<?php echo htmlspecialchars($cpf); ?>"></td>
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

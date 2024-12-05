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
$cpf = '';
$nome = '';
$senha = '';
$email ='';
$curso ='';
$semestre = '';
$ano = '';
$senha = '';


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    
    $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE RA='$ra'";
    $resultadoAlunoData = mysqli_query($con, $queryAlunoData);

    while($aluno = mysqli_fetch_array($resultadoAlunoData)){
        $ra = $aluno['RA'];
        $nome = $aluno['Nome'];
        $email = $aluno['EMail'];
        $curso = $aluno['Curso'];
        $semestre = $aluno['Semestre'];    
        $ano = $aluno['Ano'];
        $senha = $aluno['Senha'];
        
    }

}


// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura o valor do RA e do CPF
    $ra = isset($_POST['ra']) ? $_POST['ra'] : '';
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

    // Verifica se RA ou CPF foi preenchido
    if (empty($ra) && empty($cpf)) {
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, preencha RA ou CPF.</p>";
        $raErrorStyle = 'border: 2px solid red;';
        $cpfErrorStyle = 'border: 2px solid red;';
    } else {
        $queryExistente = "SELECT * FROM cadastro_alunos WHERE RA='$ra'";
        $resultadoExistente = mysqli_query($con, $queryExistente);

        if (mysqli_num_rows($resultadoExistente) > 0) {
            // RA já existe, realizar UPDATE
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirma_senha = $_POST['confirma_senha'];
            $curso = $_POST['curso'];
            $semestre = $_POST['semestre'];
            $ano = $_POST['ano'];

            // Verificação de senha
            if ($senha !== $confirma_senha) {
                echo "<p style='color:red;'>As senhas não coincidem. Tente novamente.</p>";
            } else {
                // Query de atualização no banco de dados
                $sql_update = "UPDATE cadastro_alunos 
                               SET Nome=?, Senha=?, CPF=?, Curso=?, EMail=?, Semestre=?, Ano=? 
                               WHERE RA=?";
                
                if ($stmt = $con->prepare($sql_update)) {
                    // Bind dos parâmetros
                    $stmt->bind_param("sssssssi", $nome, $senha, $cpf, $curso, $email, $semestre, $ano, $ra);
                    
                    // Executando a query
                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Cadastro atualizado com sucesso!');
                            window.location.href = 'login.php';
                        </script>";
                    } else {
                        echo "<p style='color:red;'>Erro ao atualizar os dados. Tente novamente.</p>";
                    }

                    // Fechando o statement
                    $stmt->close();
                } else {
                    echo "<p style='color:red;'>Erro na preparação da query de atualização. Tente novamente.</p>";
                }
            }
        } else {
            // RA não existe, realizar INSERT
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirma_senha = $_POST['confirma_senha'];
            $curso = $_POST['curso'];
            $semestre = $_POST['semestre'];
            $ano = $_POST['ano'];

            // Verificação de senha
            if ($senha !== $confirma_senha) {
                echo "<p style='color:red;'>As senhas não coincidem. Tente novamente.</p>";
            } else {
                // Query de inserção no banco de dados
                $sql_insert = "INSERT INTO cadastro_alunos (Nome, Senha, RA, CPF, Curso, EMail, Semestre, Ano) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                
                if ($stmt = $con->prepare($sql_insert)) {
                    // Bind dos parâmetros
                    $stmt->bind_param("ssssssis", $nome, $senha, $ra, $cpf, $curso, $email, $semestre, $ano);
                    
                    // Executando a query
                    if ($stmt->execute()) {
                        echo "<script>
                            alert('Cadastro realizado com sucesso!');
                            window.location.href = 'login.php';
                        </script>";
                    } else {
                        echo "<p style='color:red;'>Erro ao realizar o cadastro. Tente novamente.</p>";
                    }

                    // Fechando o statement
                    $stmt->close();
                } else {
                    echo "<p style='color:red;'>Erro na preparação da query de inserção. Tente novamente.</p>";
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
                        <td><input type="text" name="cpf" size="20" value="<?php echo htmlspecialchars($cpf); ?>" required></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                        <!-- Outros dados do aluno -->
                        <tr>
                            <td> Nome:</td>
                            <td><input type="text" name="nome" size="50" value="<?=  $nome; ?>"> </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Senha -->
                        <tr>
                            <td> Senha de acesso:</td>
                            <td><input type="password" name="senha" size="12" value="<?= $senha; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Confirmar Senha -->
                        <tr>
                            <td> Repita a senha:</td>
                            <td><input type="password" name="confirma_senha" size="12" value="<?= $senha; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> E-Mail:</td>
                            <td><input type="email" name="email" size="50" value="<?= $email; ?>"></td>
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
                                    do { 
                                        $selected = $semestre == $i ? "selected" : "";
                                        echo "<option " . $selected. ">".$i."o. Semestre</option>"; 
                                    } while ($i++ < 9);
                                ?>
                            </select></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <tr>
                            <td> Ano:</td>
                            <td><select name="ano">
                                <?php
                                    $i = 2024;
                                    do { 
                                        $selected = $ano == $i ? "selected" : "";
                                        echo "<option " . $selected. ">$i</option>"; 
                                    } while ($i++ < 2030);
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

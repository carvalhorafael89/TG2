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
$email = '';
$curso = '';
$semestre = '';
$ano = '';

// Se o método for GET, tenta carregar os dados do aluno
if ($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($ra)) {
    $queryAlunoData = "SELECT * FROM cadastro_alunos WHERE RA='$ra'";
    $resultadoAlunoData = mysqli_query($con, $queryAlunoData);

    if ($aluno = mysqli_fetch_array($resultadoAlunoData)) {
        // Preenche as variáveis com os dados encontrados
        $ra = $aluno['RA'];
        $nome = $aluno['Nome'];
        $email = $aluno['EMail'];
        $curso = $aluno['Curso'];
        $semestre = $aluno['Semestre'];    
        $ano = $aluno['Ano'];
        $senha = $aluno['Senha'];
    }
}

// Se o método for POST, tenta salvar ou validar os dados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ra = isset($_POST['ra']) ? $_POST['ra'] : ''; 
    $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : ''; 
    
    // Verifica se RA ou CPF foi preenchido
    if (empty($ra) && empty($cpf)) {
        $erro = "<p style='color:red; font-weight:bold;'>Por favor, preencha RA ou CPF.</p>";
        $raErrorStyle = 'border: 2px solid red;';
        $cpfErrorStyle = 'border: 2px solid red;';
    } else {
        // Verifica se o RA ou CPF já existe no banco
        $queryCheck = "SELECT * FROM cadastro_alunos WHERE RA='$ra' OR CPF='$cpf'";
        $result = mysqli_query($con, $queryCheck);
        
        if (mysqli_num_rows($result) > 0) {
            // RA ou CPF já existe no banco
            echo "<script>
                alert('RA ou CPF já cadastrado. Redirecionando para login...');
                window.location.href = 'login.php';
            </script>";
        } else {
            // Continua com o cadastro completo
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confirma_senha = $_POST['confirma_senha'];
            $curso = $_POST['curso'];
            $semestre = $_POST['semestre'];
            $ano = $_POST['ano'];

            // Verificação de senha
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
                    $stmt->execute();
                    echo "<p style='color:green;'>Cadastro realizado com sucesso!</p>";
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
                            <td><input type="text" name="ra" size="20" value="<?php echo htmlspecialchars($ra); ?>" style="<?php echo $raErrorStyle; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                            
                        <!-- Campo de CPF -->
                        <tr>
                            <td> CPF:</td>
                            <td><input type="text" name="cpf" size="20" value="<?php echo htmlspecialchars($cpf); ?>" required style="<?php echo $cpfErrorStyle; ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>
                        
                        <!-- Outros dados do aluno -->
                        <tr>
                            <td> Nome:</td>
                            <td><input type="text" name="nome" size="50" value="<?php echo htmlspecialchars($nome); ?>"> </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Senha -->
                        <tr>
                            <td> Senha de acesso:</td>
                            <td><input type="password" name="senha" size="12" value=""></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Confirmar Senha -->
                        <tr>
                            <td> Repita a senha:</td>
                            <td><input type="password" name="confirma_senha" size="12" value=""></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- E-Mail -->
                        <tr>
                            <td> E-Mail:</td>
                            <td><input type="email" name="email" size="50" value="<?php echo htmlspecialchars($email); ?>"></td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Curso -->
                        <tr>
                            <td> Curso:</td>
                            <td>
                                <select name="curso">
                                    <option value="" <?php echo empty($curso) ? 'selected' : ''; ?>>Selecione</option>
                                    <?php
                                        $sql = "SELECT * FROM cursos";
                                        $r = mysqli_query($con, $sql);
                                        while ($dados = mysqli_fetch_array($r)) {
                                            $cursoOption = htmlspecialchars($dados['curso']);
                                            $selected = ($curso === $cursoOption) ? 'selected' : '';
                                            echo "<option value=\"$cursoOption\" $selected>$cursoOption</option>";
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Semestre -->
                        <tr>
                            <td> Semestre:</td>
                            <td>
                                <select name="semestre">
                                    <option value="" <?php echo empty($semestre) ? 'selected' : ''; ?>>Selecione</option>
                                    <?php
                                        for ($i = 1; $i <= 9; $i++) { 
                                            $selected = ($semestre == $i) ? "selected" : "";
                                            echo "<option value=\"$i\" $selected>".$i."º Semestre</option>"; 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Ano -->
                        <tr>
                            <td> Ano:</td>
                            <td>
                                <select name="ano">
                                    <option value="" <?php echo empty($ano) ? 'selected' : ''; ?>>Selecione</option>
                                    <?php
                                        for ($i = 2024; $i <= 2030; $i++) { 
                                            $selected = ($ano == $i) ? "selected" : "";
                                            echo "<option value=\"$i\" $selected>$i</option>"; 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr><td>&nbsp;</td><td></td></tr>

                        <!-- Botão de Envio -->
                        <tr>
                            <td></td>
                            <td><input type="submit" name="enviar" value="Cadastrar" style="background-color: red; color: white; padding: 10px 20px; border: none; cursor: pointer;"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

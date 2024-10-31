<?php

require_once 'conecta.php';

// Realiza login e grava nível de acesso
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    // Consulta para verificar se o usuário é aluno
    $sql = "SELECT * FROM cadastro_alunos WHERE EMail = ? AND Senha = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $data = $stmt->get_result();

    $existe = 0;

    if ($dados = $data->fetch_assoc()) {
        // Verifica se é um aluno ou um professor (código 0)
        if ($dados['Codigo'] == '0') {
            // Se código é "0", trata como professor e busca o nome na tabela de professores
            $nivel = "Professor";
            
            // Busca o nome correto do professor com base no email na tabela de professores
            $sql_professor = "SELECT Nome FROM cadastro_professor WHERE Email = ?";
            $stmt_prof = $con->prepare($sql_professor);
            $stmt_prof->bind_param("s", $email);
            $stmt_prof->execute();
            $result_prof = $stmt_prof->get_result();
            
            if ($professor = $result_prof->fetch_assoc()) {
                $nome = $professor['Nome'];  // Nome obtido da tabela de professores
            } else {
                // Se não encontrar o professor, utiliza o nome padrão do cadastro_alunos
                $nome = $dados['Nome'];
            }

            $codigo = '0';  // Definindo o código como "0" para professores logados como aluno
        } else {
            // Caso contrário, trata como aluno
            $nivel = "Aluno";
            $nome = $dados['Nome'];
            $codigo = $dados['Codigo'];
        }

        $Email = $dados['EMail'];

        // Cria cookies de sessão para o usuário
        setcookie("Nivel", $nivel, time() + (3600 * 6));
        setcookie("Nome", $nome, time() + (3600 * 6));
        setcookie("Email", $email, time() + (3600 * 6));
        setcookie("Codigo", $codigo, time() + (3600 * 6));

        $existe = 1;
        header("Location: index.php");
        exit();
    }

    // Se não encontrou como aluno, verificar se é professor diretamente
    if ($existe == 0) {
        $sql = "SELECT * FROM cadastro_professor WHERE Email = ? AND Senha = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $email, $senha);
        $stmt->execute();
        $data = $stmt->get_result();

        if ($dados = $data->fetch_assoc()) {
            $nivel = "Professor";
            $nome = $dados['Nome'];
            $Email = $dados['Email'];
            $codigo = $dados['Codigo'];

            setcookie("Nivel", $nivel, time() + (3600 * 6));
            setcookie("Nome", $nome, time() + (3600 * 6));
            setcookie("Email", $email, time() + (3600 * 6));
            setcookie("Codigo", $codigo, time() + (3600 * 6));

            header("Location: index.php");
            exit();
        }
    }

    // Se não encontrou nem como aluno nem como professor, redireciona com erro
    if ($existe == 0) {
        header("Location: login.php?acesso=denied");
        exit();
    }
}
?>

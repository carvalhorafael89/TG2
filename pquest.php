<?php
require_once 'conecta.php';

// Verifique se os dados foram enviados corretamente
if (isset($_POST['codigo_prova'], $_POST['codigo_aluno'], $_POST['numero'], $_POST['resposta'])) {
    $codigo_prova = $_POST['codigo_prova'];
    $codigo_aluno = $_POST['codigo_aluno'];
    $numero = $_POST['numero'];
    $resposta = $_POST['resposta'];

    // Atualiza a resposta do aluno na questão atual
    $sql = "UPDATE gabaritos SET Resposta_Aluno = ? WHERE Aluno = ? AND Prova = ? AND Numero = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param('sisi', $resposta, $codigo_aluno, $codigo_prova, $numero);
        $stmt->execute();
        $stmt->close();

        // Verifica se foi solicitado finalizar a prova
        if (isset($_POST['finaliza_prova'])) {
            // Redireciona para a página de finalização da prova
            header("Location: finalprv.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno");
            exit();
        } else {
            // Redireciona para a próxima questão
            $proxima_questao = $numero + 1;
            header("Location: comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$proxima_questao");
            exit();
        }
    } else {
        echo "Erro ao preparar a consulta.";
    }
} else {
    echo "Dados inválidos. Tente novamente.";
}
?>

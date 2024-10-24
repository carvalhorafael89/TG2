<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se as questões foram enviadas
    if (isset($_POST['questoes']) && !empty($_POST['questoes'])) {
        $codigo_prova = $_POST['codigo_prova'];
        $questoes = $_POST['questoes'];

        foreach ($questoes as $codigo_questao) {
            // Verifica se o código da questão não está vazio
            if (!empty($codigo_questao)) {
                // Insere cada questão selecionada na tabela de questões associadas à prova
                $sql = "INSERT INTO tabela_questoes (Codigo_Prova, Questao) VALUES ('$codigo_prova', '$codigo_questao')";
                
                if (mysqli_query($con, $sql)) {
                    echo "Questão $codigo_questao incluída com sucesso!<br>";
                } else {
                    echo "Erro ao incluir a questão $codigo_questao: " . mysqli_error($con) . "<br>";
                }
            } else {
                echo "Código da questão inválido. Operação cancelada.<br>";
            }
        }

        // Redireciona de volta para a página de inclusão de questões
        header("Location: inccquestao.php?prova=$codigo_prova");
        exit();
    } else {
        // Se nenhuma questão foi selecionada, exibe um erro
        echo "Nenhuma questão foi selecionada para inclusão.";
    }
} else {
    // Se o método da requisição não for POST, redireciona
    header("Location: inccquestao.php");
    exit();
}
?>

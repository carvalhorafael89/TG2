<?php
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codigo_prova = $_POST['codigo_prova'];
    $questoes_selecionadas = isset($_POST['questoes']) ? $_POST['questoes'] : [];

    // Obter o total de questões que já estão associadas à prova
    $sql_total_questoes_prova = "SELECT COUNT(*) AS total FROM tabela_questoes WHERE Codigo_Prova = ?";
    if ($stmt_total = $con->prepare($sql_total_questoes_prova)) {
        $stmt_total->bind_param("s", $codigo_prova);
        $stmt_total->execute();
        $stmt_total->bind_result($total_questoes_prova);
        $stmt_total->fetch();
        $stmt_total->close();
    }

    // Obter o número máximo de questões permitidas para a prova
    $sql_total_max = "SELECT Numero_Questoes FROM cadastro_provas WHERE Codigo_prova = ?";
    if ($stmt_max = $con->prepare($sql_total_max)) {
        $stmt_max->bind_param("s", $codigo_prova);
        $stmt_max->execute();
        $stmt_max->bind_result($total_max_questoes);
        $stmt_max->fetch();
        $stmt_max->close();
    }

    // Verificar se o limite será atingido com as questões selecionadas
    //$quantidade_disponivel = $total_max_questoes - $total_questoes_prova;

   // if ($quantidade_disponivel <= 0) {
        // Limite já foi atingido, nenhuma questão pode ser adicionada
   //     header("Location: inccquestao.php?prova=$codigo_prova&limite_atingido=1");
   //     exit();
   // } else {
        // Verificar quantas questões podem ser adicionadas sem ultrapassar o limite
    //    $questoes_a_adicionar = array_slice($questoes_selecionadas, 0, $quantidade_disponivel);
    //    $questoes_extra = array_slice($questoes_selecionadas, $quantidade_disponivel);

        // Inserir as questões permitidas
        foreach ($questoes_a_adicionar as $questao) {
            // Usa prepared statements para evitar SQL injection
            $sql = "INSERT INTO tabela_questoes (Codigo_Prova, Questao) VALUES (?, ?)";
            if ($stmt_inserir = $con->prepare($sql)) {
                $stmt_inserir->bind_param("si", $codigo_prova, $questao);
                $stmt_inserir->execute();
                $stmt_inserir->close();
            }
        }

        // Redirecionar de volta para inccquestao.php com as questões extras não marcadas
        $extra_string = implode(",", $questoes_extra);
        header("Location: inccquestao.php?prova=$codigo_prova&limite_atingido=1&questoes_extra=$extra_string");
        exit();
    }
//}

?>

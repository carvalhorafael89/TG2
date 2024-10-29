<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

header('Content-Type: text/html; charset=utf-8');
require_once 'conecta.php';

// Verifica se o código da prova e o código do aluno foram recebidos via POST ou GET
if (isset($_POST['codigo_prova']) || isset($_GET['codigo_prova'])) {
    $codigo_prova = isset($_POST['codigo_prova']) ? $_POST['codigo_prova'] : $_GET['codigo_prova'];
    $codigo_aluno = isset($_POST['codigo_aluno']) ? $_POST['codigo_aluno'] : $_GET['codigo_aluno'];

    // Verifica se o código da prova existe no banco de dados
    $sql_verifica_prova = "SELECT * FROM cadastro_provas WHERE Codigo_prova = ?";
    $stmt = $con->prepare($sql_verifica_prova);
    $stmt->bind_param("s", $codigo_prova);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        // Redireciona para a página de entrada de código com mensagem de erro se o código não existir
        header("Location: realiza.php?erro=codigo_invalido");
        exit();
    }

    // Verifica se o aluno já tem gabarito para a prova
    $sql = "SELECT * FROM gabaritos WHERE Aluno = " . $codigo_aluno . " AND Prova = '" . $codigo_prova . "'";
    $r = mysqli_query($con, $sql);
    $existe = 0;
    while ($dados = mysqli_fetch_array($r)) {
        $existe = 1;
    }

    // Se o aluno não tem gabarito, cria um novo
    if ($existe == 0) {
        $sql = "SELECT * FROM tabela_questoes WHERE Codigo_Prova = '" . $codigo_prova . "'";
        $r = mysqli_query($con, $sql);
        $numero = 1;

        while ($dados = mysqli_fetch_array($r)) {
            $vsql = "INSERT INTO gabaritos (Aluno, Prova, Questao, Resposta_Aluno, Resposta_Correta, Numero, Finalizado) 
                     VALUES ('$codigo_aluno', '$codigo_prova', '" . $dados['Questao'] . "', 'Z', '";
            
            // Buscando a resposta correta
            $qsql = "SELECT * FROM cadastro_questoes WHERE codigo = " . $dados['Questao'];
            $qr = mysqli_query($con, $qsql);
            $qdados = mysqli_fetch_array($qr);
            $correta = $qdados['Correta'];

            // Finalizando a query de inserção
            $vsql .= "$correta', '$numero', 'Nao')";
            mysqli_query($con, $vsql);
            $numero++;
        }
    }

    // Redireciona para a página de início da prova
    $voltar = "comeca.php?codigo_prova=" . $codigo_prova . "&codigo_aluno=" . $codigo_aluno;
    header("Location: $voltar");
    exit();
} 
?>

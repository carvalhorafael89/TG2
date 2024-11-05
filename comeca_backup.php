<?php
// Iniciar buffer de saída
ob_start();

// Iniciar sessão para verificar o modo
session_start();

if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Conectar ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

$nivel = $_COOKIE['Nivel'];
$nome = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];
$codigo_aluno = $codigo;

$modo_aluno = isset($_SESSION['modo']) && $_SESSION['modo'] === 'aluno';
$is_professor_em_modo_aluno = $modo_aluno && $nivel === 'Professor';

$finalizado = isset($_GET['finalizado']) && $_GET['finalizado'] === 'Sim';

if (isset($_GET['codigo_prova']) && isset($_GET['codigo_aluno'])) {
    $codigo_prova = $_GET['codigo_prova'];
    $codigo_aluno = $_GET['codigo_aluno'];
    $numero = isset($_GET['numero']) ? $_GET['numero'] : 1;

    // Obter a lista de IDs das questões da prova
    $sql_questao_ids = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = '$codigo_prova' ORDER BY Questao";
    $data_questao_ids = mysqli_query($con, $sql_questao_ids);
    $questao_ids = [];

    if ($data_questao_ids) {
        while ($row = mysqli_fetch_assoc($data_questao_ids)) {
            $questao_ids[] = $row['Questao'];
        }
    }

    // Ajusta $numero para exibição e para obter a questão correta
    $numero_exibido = max(1, min($numero, count($questao_ids))); // Para exibição, começa em 1
    $numero_index = $numero_exibido - 1; // Ajuste do índice (0 baseado)
    $numero_para_busca = $questao_ids[$numero_index]; // ID real da questão para busca

    // Se a resposta for enviada, atualize ou insira no banco de dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
        $resposta_aluno = $_POST['resposta'];

        // Se a resposta for enviada e a prova não estiver finalizada, atualize ou insira no banco de dados
    if (!$finalizado && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
        $resposta_aluno = $_POST['resposta'];

        // Verificar se já existe um registro para essa questão no gabarito
        $sql_verifica_existente = "SELECT * FROM gabaritos WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova' AND Numero = $numero_exibido";
        $resultado_existente = mysqli_query($con, $sql_verifica_existente);

        if (mysqli_num_rows($resultado_existente) > 0) {
            // Atualiza a resposta se já existir um registro
            $sql_update_resposta = "UPDATE gabaritos SET Resposta_Aluno = '$resposta_aluno'
                                    WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova' AND Numero = $numero_exibido";
            mysqli_query($con, $sql_update_resposta);
        } else {
            // Insere uma nova resposta se não existir um registro
            $sql_insert_resposta = "INSERT INTO gabaritos (Aluno, Prova, Numero, Resposta_Aluno)
                                    VALUES ($codigo_aluno, '$codigo_prova', $numero_exibido, '$resposta_aluno')";
            mysqli_query($con, $sql_insert_resposta);
        }
    }

        // Redirecionar para a próxima pergunta ou finalizar a prova se for a última
        if ($numero_exibido < count($questao_ids)) {
            $numero_exibido++;
            header("Location: comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$numero_exibido");
        } else {
            // Atualizar o status de finalização na última pergunta antes de redirecionar
            $sql_update_finalizado = "UPDATE gabaritos SET Finaliza = 'Sim'
                                      WHERE Aluno = $codigo_aluno AND Prova = '$codigo_prova'";
            mysqli_query($con, $sql_update_finalizado);

            // Pausar por 3 segundos antes de redirecionar
            sleep(3);

            // Redirecionar para a página de finalização
            header("Location: finalprv.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno");
        }
        exit();
    }

    // Obter o número total de questões da prova
    $sql_total_questoes = "SELECT COUNT(*) as total FROM tabela_questoes WHERE Codigo_Prova = '$codigo_prova'";
    $data_total = mysqli_query($con, $sql_total_questoes);

    if ($data_total && $row_total = mysqli_fetch_assoc($data_total)) {
        $total_questoes = $row_total['total'];
    } else {
        // Exibir uma mensagem de erro se a consulta falhar
        echo "<p style='color: red;'>Erro ao buscar o total de questões: " . mysqli_error($con) . "</p>";
        exit();
    }

    // Buscar a questão atual usando o ID real da questão
    $sql_questao_atual = "SELECT * FROM tabela_questoes WHERE Questao = $numero_para_busca AND Codigo_Prova = '$codigo_prova'";
    $data_questao = mysqli_query($con, $sql_questao_atual);

    if ($data_questao && $dados_questao = mysqli_fetch_assoc($data_questao)) {
        $resposta = isset($dados_questao['Resposta_Aluno']) ? $dados_questao['Resposta_Aluno'] : '';
        // Continue a exibir a questão e alternativas conforme necessário
    } else {
        echo "<p style='color: red;'>Erro ao buscar a questão atual: " . mysqli_error($con) . "</p>";
        exit();
    }

    // Verificar se o usuário é um professor em modo aluno e ajustar as variáveis
if ($modo_aluno && $nivel === 'Professor') {
    $finalizado = false; // Desliga a finalização para simular a experiência de um aluno
}

// Exibir a questão e as alternativas, se existir
if ($dados_questao) {
    $resposta = isset($dados_questao['Resposta_Aluno']) ? $dados_questao['Resposta_Aluno'] : '';
    $rcorreta = isset($dados_questao['Resposta_Correta']) ? $dados_questao['Resposta_Correta'] : '';

    // Busca o texto da questão e as alternativas
    $questao_id = $dados_questao['Questao'];
    $sql_questao = "SELECT * FROM cadastro_questoes WHERE Codigo = $questao_id";
    $data_questao_texto = mysqli_query($con, $sql_questao);
    $questao_texto = mysqli_fetch_assoc($data_questao_texto);

    if ($questao_texto) {
        echo "<form method='POST'>";
        echo "<div style='margin-left: 200px;'>";
        echo "<div style='margin-right: 200px;'>";
        echo "<h2><small>Questão $numero_exibido de $total_questoes</small></h2>";
        echo "<h3><small>Disciplina: " . htmlspecialchars($questao_texto['Disciplina']) . "</small></h3><br>";
        echo "<h3><small>" . htmlspecialchars($questao_texto['Questao']) . "</small></h3><br>";

        if (!empty($questao_texto['Figura']) && $questao_texto['Figura'] != 'figuras/') {
            echo "<a href=\"" . htmlspecialchars($questao_texto['Figura']) . "\" target=\"_blank\"><img src=\"" . htmlspecialchars($questao_texto['Figura']) . "\" width=\"800\"></a>";
            echo "<br><small>Clique na figura para ver no tamanho original.</small><br>";
        }

        // Exibir alternativas, bloqueadas caso finalizado, exceto para professor em modo aluno
        $alternativas = ['A', 'B', 'C', 'D', 'E'];
        foreach ($alternativas as $alt) {
            echo "<table><tr><td>";
            echo "<h4><input type='radio' name='resposta' value='$alt' ";
            if ($resposta == $alt) {
                echo " checked";
            }
            // Bloquear a edição se finalizado, exceto para professor em modo aluno
            echo ($finalizado && !($modo_aluno && $nivel === 'Professor')) ? " disabled" : "";
            echo "> $alt </h4>";
            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";

            $resposta_texto = isset($questao_texto['Resposta' . $alt]) ? htmlspecialchars($questao_texto['Resposta' . $alt]) : 'Resposta não disponível';
            echo '<font color="black">' . $resposta_texto . '</font>';
            echo "</small></h4></td></tr></table>";
        }

        // Botão de resposta e navegação
        echo "<div style='margin-top: 20px;'>";
        if (!$finalizado || ($modo_aluno && $nivel === 'Professor')) {
            if ($numero_exibido < $total_questoes) {
                echo "<button type='submit' class='btn btn-success'>Responder e Avançar</button>";
            } else {
                echo "<button type='submit' formaction='finalprv.php' class='btn btn-success'>Finalizar Prova</button>";
            }
        } else {
            // Mostrar seletor de perguntas se a prova estiver finalizada
            echo "<div style='text-align: center;'>";
            echo "<label for='navegacao'>Ir para a pergunta:</label><br>";
            for ($i = 1; $i <= $total_questoes; $i++) {
                $style = $i == $numero_exibido 
                    ? "background-color: red; color: white; border: none; padding: 10px 15px; margin: 2px; cursor: pointer;" 
                    : "background-color: gray; color: white; border: none; padding: 10px 15px; margin: 2px; cursor: pointer;";
                echo "<button style='$style' onclick='window.location.href=\"comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$i\";'>$i</button>";
            }
            echo "</div>";
        }
        echo "</div>";

        echo "</div>";
        echo "</form>";
    } else {
        echo "<p style='color: red;'>Questão não encontrada.</p>";
    }
} else {
    echo "<p style='color: red;'>Questão não encontrada no banco de dados.</p>";
}
} else {
    $final = "finalprv.php";
    header("Location: $final");
    exit();
}

// Enviar o buffer de saída e encerrar
ob_end_flush();
?>

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


// Ajuste para o professor em modo aluno: simular como aluno
if ($is_professor_em_modo_aluno) {
    $finalizado = false; // Desliga a finalização para permitir interação
} else {
    $finalizado = isset($_GET['finalizado']) && $_GET['finalizado'] === 'Sim';
}

    if (isset($_GET['codigo_prova']) && isset($_GET['codigo_aluno'])) {
        $codigo_prova = $_GET['codigo_prova'];
        $codigo_aluno = $_GET['codigo_aluno'];
        $numero = isset($_GET['numero']) ? (int)$_GET['numero'] : 1;

        // Buscar duração da prova no banco de dados
    $sql_duracao = "SELECT Duracao_Horas, Duracao_Minutos FROM cadastro_provas WHERE Codigo_Prova = '$codigo_prova'";
    $resultado_duracao = mysqli_query($con, $sql_duracao);
    $duracao_horas = 0;
    $duracao_minutos = 0;

    if ($resultado_duracao && $dados_duracao = mysqli_fetch_assoc($resultado_duracao)) {
        $duracao_horas = (int)$dados_duracao['Duracao_Horas'];
        $duracao_minutos = (int)$dados_duracao['Duracao_Minutos'];
    }

    // Calcular o tempo total em segundos
    $tempo_total_segundos = ($duracao_horas * 3600) + ($duracao_minutos * 60);

    


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
    $numero_index = $numero_exibido -1; // Ajuste do índice (0 baseado)
    $numero_para_busca = $questao_ids[$numero_index]; // ID real da questão para busca

    // Se a resposta for enviada, atualize ou insira no banco de dados
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resposta'])) {
    $resposta_aluno = $_POST['resposta'];

    // Se a prova não estiver finalizada ou for um professor em modo aluno, permitir gravação
    if (!$finalizado || $is_professor_em_modo_aluno) {
        // Obter a resposta correta para a questão atual
$sql_obter_resposta_correta = "SELECT Correta FROM cadastro_questoes WHERE Codigo = $numero_para_busca";
$resultado_resposta_correta = mysqli_query($con, $sql_obter_resposta_correta);
$resposta_correta = '';

if ($resultado_resposta_correta && $resposta_dados = mysqli_fetch_assoc($resultado_resposta_correta)) {
    $resposta_correta = $resposta_dados['Correta']; // Certifique-se de que a chave corresponda ao nome da coluna na tabela
}


        // Verificar se já existe um registro para essa questão no gabarito
        $sql_verifica_existente = "SELECT * FROM gabaritos WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova' AND Numero = $numero_exibido";
        $resultado_existente = mysqli_query($con, $sql_verifica_existente);

        if (mysqli_num_rows($resultado_existente) > 0) {
            // Atualiza a resposta se já existir um registro
            $sql_update_resposta = "UPDATE gabaritos SET Resposta_Aluno = '$resposta_aluno', Resposta_Correta = '$resposta_correta', Questao = $numero_para_busca,
                                    WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova' AND Numero = $numero_exibido";
            mysqli_query($con, $sql_update_resposta);
        } else {
            // Insere uma nova resposta se não existir um registro
            $sql_insert_resposta = "INSERT INTO gabaritos (Aluno, codprova, Questao, Resposta_Aluno, Resposta_Correta, Numero, Finalizado)
                                    VALUES ($codigo_aluno, '$codigo_prova', $numero_para_busca, '$resposta_aluno', '$resposta_correta', $numero_exibido,  'Nao')";
            mysqli_query($con, $sql_insert_resposta);
        }
    }

    // Redirecionar para a próxima pergunta ou finalizar a prova se for a última
    if ($numero_exibido < count($questao_ids)) {
        $numero_exibido++;
        header("Location: comeca.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno&numero=$numero_exibido");
    } else {
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

    // Exibir cronômetro
// Exibir cronômetro
        // Exibir cronômetro
        echo "<div id='cronometro' style='font-size: 24px; color: red; text-align: center; margin-bottom: 20px;'></div>";

        echo "<script>
            let tempoRestante = $tempo_total_segundos;

            function formatarTempo(tempo) {
                const horas = Math.floor(tempo / 3600);
                const minutos = Math.floor((tempo % 3600) / 60);
                const segundos = tempo % 60;

                return 'Tempo Restante: ' + 
                    String(horas).padStart(2, '0') + ':' + 
                    String(minutos).padStart(2, '0') + ':' + 
                    String(segundos).padStart(2, '0');
            }

            function atualizarCronometro() {
                const cronometro = document.getElementById('cronometro');
                cronometro.innerText = formatarTempo(tempoRestante);

                if (tempoRestante <= 0) {
                    clearInterval(intervaloCronometro);
                    window.location.href = 'finalprv.php?codigo_prova=$codigo_prova&codigo_aluno=$codigo_aluno';
                }

                tempoRestante--;
            }

            // Exibir o tempo inicial imediatamente
            document.getElementById('cronometro').innerText = formatarTempo(tempoRestante);

            // Atualizar o cronômetro a cada segundo
            const intervaloCronometro = setInterval(atualizarCronometro, 1000);
        </script>";


    if ($data_questao && $dados_questao = mysqli_fetch_assoc($data_questao)) {
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
            echo "<h3><small>" . nl2br(htmlspecialchars($questao_texto['Questao'])) . "</small></h3><br>";

            if (!empty($questao_texto['Figura']) && $questao_texto['Figura'] != 'figuras/') {
                echo "<a href=\"" . htmlspecialchars($questao_texto['Figura']) . "\" target=\"_blank\"><img src=\"" . htmlspecialchars($questao_texto['Figura']) . "\" width=\"800\"></a>";
                echo "<br><small>Clique na figura para ver no tamanho original.</small><br>";
            }

            // Inicializar a variável para evitar notices
$resposta_selecionada = '';

// Carregar a resposta selecionada para a questão atual se a prova estiver finalizada
if ($finalizado) {
    $sql_resposta_aluno = "SELECT Resposta_Aluno FROM gabaritos WHERE Aluno = $codigo_aluno AND codprova = '$codigo_prova' AND Numero = $numero_exibido";
    $resultado_resposta = mysqli_query($con, $sql_resposta_aluno);

    if ($resultado_resposta && $resposta_dados = mysqli_fetch_assoc($resultado_resposta)) {
        $resposta_selecionada = $resposta_dados['Resposta_Aluno']; // Resposta armazenada
    }
}

// Exibir a questão e as alternativas com a resposta selecionada destacada
if ($dados_questao) {
    $alternativas = ['A', 'B', 'C', 'D', 'E'];
    foreach ($alternativas as $alt) {
        echo "<table><tr><td>";
        echo "<h4><input type='radio' name='resposta' value='$alt' ";
        if ($resposta_selecionada == $alt) {
            echo " checked"; // Marca a alternativa se for a resposta selecionada
        }
        echo ($finalizado && !$is_professor_em_modo_aluno) ? " disabled" : ""; // Bloqueia a edição se finalizado e não for professor em modo aluno
        echo "> $alt </h4>";
        echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";

        $resposta_texto = isset($questao_texto['Resposta' . $alt]) ? htmlspecialchars($questao_texto['Resposta' . $alt]) : 'Resposta não disponível';
        echo '<font color="black">' . $resposta_texto . '</font>';
        echo "</small></h4></td></tr></table>";
    }
}
            // Botão de resposta e navegação
            echo "<div style='margin-top: 20px; display: flex; justify-content: space-between;'>";

            // Botão "Voltar", habilitado apenas se não for a primeira questão
            if ($numero_exibido > 1) {
                echo "<a href='comeca.php?codigo_prova=" . htmlspecialchars($codigo_prova) . "&codigo_aluno=" . htmlspecialchars($codigo_aluno) . "&numero=" . ($numero_exibido - 1) . "' class='btn btn-secondary' style='width: 150px;'>Voltar</a>";
            } else {
                // Botão invisível para manter alinhamento
                echo "<span style='width: 150px;'></span>";
            }

            // Botão "Avançar" ou "Finalizar Prova"
            if ($numero_exibido < $total_questoes) {
                // Botão "Avançar"
                echo "<button type='submit' name='proxima' class='btn btn-success' style='width: 150px;'>Avançar</button>";
            } else {
                // Botão "Finalizar Prova"
                echo "<form method='POST' action='finalprv.php' style='display:inline;'>";
                echo "<input type='hidden' name='codigo_prova' value='" . htmlspecialchars($codigo_prova) . "'>";
                echo "<input type='hidden' name='codigo_aluno' value='" . htmlspecialchars($codigo_aluno) . "'>";
                echo "<button type='submit' class='btn btn-success' style='width: 150px;'>Finalizar Prova</button>";
                echo "</form>";
            }

            echo "</div>";

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

<?php
if (!isset($_COOKIE['Nivel'])) {
    header("Location: login.php?acesso=denied");
    exit();
}

// Define o fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Verifica o nível e o código do aluno
$nivel = isset($_COOKIE['Nivel']) ? $_COOKIE['Nivel'] : '';
$codigo_aluno = isset($_COOKIE['Codigo']) ? $_COOKIE['Codigo'] : '';
$codigo_prova = isset($_GET['codigo_prova']) ? $_GET['codigo_prova'] : '';

// Conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

// Função para obter questões e disciplinas organizadas
function getQuestoesDisciplinas($con, $codigo_prova) {
    $sql = "SELECT tq.Questao, cq.Disciplina, cq.Correta 
            FROM tabela_questoes tq
            JOIN cadastro_questoes cq ON tq.Questao = cq.Codigo
            WHERE tq.Codigo_Prova = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $codigo_prova);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $disciplinas = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $disciplinas[$row['Disciplina']][] = [
            'questao' => $row['Questao'],
            'correta' => $row['Correta']
        ];
    }
    return $disciplinas;
}

// Função para obter gabaritos dos alunos
function getGabaritos($con, $codigo_prova) {
    $sql = "SELECT DISTINCT Aluno FROM gabaritos WHERE codprova = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "s", $codigo_prova);
    mysqli_stmt_execute($stmt);
    return mysqli_stmt_get_result($stmt);
}

// Função para obter respostas dos alunos
function getRespostasAluno($con, $codigo_aluno, $codigo_prova) {
    $sql = "SELECT Questao, Resposta_Aluno FROM gabaritos WHERE Aluno = ? AND codprova = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "is", $codigo_aluno, $codigo_prova);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $respostas = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $respostas[$row['Questao']] = $row['Resposta_Aluno'];
    }
    return $respostas;
}

// Função para obter dados do aluno
function getAlunoDados($con, $codigo_aluno) {
    $sql = "SELECT Nome, RA FROM cadastro_alunos WHERE Codigo = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $codigo_aluno);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

// Gera os dados do relatório
$disciplinas = getQuestoesDisciplinas($con, $codigo_prova);
$gabaritos = getGabaritos($con, $codigo_prova);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Disciplinas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        .text-center {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td.yellow {
            background-color: lightyellow;
        }
        td.lightblue {
            background-color: lightblue;
        }
        h3 {
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <section id="content">
        <div class="container">
            <h2 class="text-center">Relatório da Prova</h2>
            <p class="text-center">Data: <?= date("d/m/Y"); ?></p>
            <p class="text-center">Código da Prova: <?= htmlspecialchars($codigo_prova); ?></p>

            <?php foreach ($disciplinas as $disciplina => $questoes): ?>
                <h3><?= htmlspecialchars($disciplina); ?></h3>
                <?php
                $chunked_questoes = array_chunk($questoes, 15); // Divide as questões em grupos de 15
                foreach ($chunked_questoes as $index => $questoes_parciais): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>RA</th>
                                <th>Nome</th>
                                <?php foreach ($questoes_parciais as $q): ?>
                                    <th>Questão <?= htmlspecialchars($q['questao']); ?></th>
                                <?php endforeach; ?>
                                <?php if ($index === count($chunked_questoes) - 1): // Apenas na última tabela ?>
                                    <th>Acertos</th>
                                    <th>% Acertos</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="2"><strong>Gabarito</strong></td>
                                <?php foreach ($questoes_parciais as $q): ?>
                                    <td class="yellow"><?= htmlspecialchars($q['correta']); ?></td>
                                <?php endforeach; ?>
                                <?php if ($index === count($chunked_questoes) - 1): ?>
                                    <td colspan="2"></td>
                                <?php endif; ?>
                            </tr>

                            <?php
                            mysqli_data_seek($gabaritos, 0); // Reinicia o ponteiro dos resultados de alunos para cada tabela
                            while ($gabarito = mysqli_fetch_assoc($gabaritos)):
                                $codigo_aluno = $gabarito['Aluno'];
                                $aluno_dados = getAlunoDados($con, $codigo_aluno);
                                $nome_aluno = isset($aluno_dados['Nome']) ? $aluno_dados['Nome'] : 'Desconhecido';
                                $ra_aluno = isset($aluno_dados['RA']) ? $aluno_dados['RA'] : 'Desconhecido';
                                $respostas = getRespostasAluno($con, $codigo_aluno, $codigo_prova);

                                $acertos = 0;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($ra_aluno); ?></td>
                                    <td><?= htmlspecialchars($nome_aluno); ?></td>
                                    <?php foreach ($questoes_parciais as $q): ?>
                                        <?php
                                        $resposta = isset($respostas[$q['questao']]) ? $respostas[$q['questao']] : '';
                                        $correta = $q['correta'];
                                        $cor = ($resposta === $correta) ? 'lightgreen' : 'transparent';
                                        if ($resposta === $correta) {
                                            $acertos++;
                                        }
                                        ?>
                                        <td style="background-color: <?= $cor; ?>;"><?= htmlspecialchars($resposta); ?></td>
                                    <?php endforeach; ?>
                                    <?php if ($index === count($chunked_questoes) - 1): ?>
                                        <td><?= $acertos; ?></td>
                                        <td><?= round($acertos / count($questoes) * 100, 2); ?>%</td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>

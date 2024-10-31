<?php
// Verifique se o cookie existe e o nível do usuário
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

require_once 'conecta.php';
$button_style = "background-color: red; color: white; font-weight: bold; margin-top: 8px; padding: 4px 10px; border: none; cursor: pointer;";

// Dados do usuário
$nivel = $_COOKIE['Nivel'];
$nome  = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];

// Verificar o parâmetro 'modo' na URL para definir o layout
$modo = isset($_GET['modo']) ? $_GET['modo'] : 'alterar';
$is_adicionar_remover = $modo === 'inserir';
$codigo_prova = $is_adicionar_remover && isset($_GET['prova']) ? $_GET['prova'] : null;

if ($codigo_prova) {

    

    // Obter as questões já associadas à prova antes da atualização
$questoes_incluidas = [];
$sql_questoes_incluidas = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = ?";
$stmt_incluidas = $con->prepare($sql_questoes_incluidas);
$stmt_incluidas->bind_param("s", $codigo_prova);
$stmt_incluidas->execute();
$result_incluidas = $stmt_incluidas->get_result();
while ($row = $result_incluidas->fetch_assoc()) {
    $questoes_incluidas[] = $row['Questao'];
}
$stmt_incluidas->close();

    // Obter o número de questões já incluídas na prova e o limite permitido
    $sql_total_questoes_prova = "SELECT COUNT(*) AS total FROM tabela_questoes WHERE Codigo_Prova = ?";
    $stmt_total = $con->prepare($sql_total_questoes_prova);
    $stmt_total->bind_param("s", $codigo_prova);
    $stmt_total->execute();
    $stmt_total->bind_result($total_questoes_prova);
    $stmt_total->fetch();
    $stmt_total->close();

    $sql_total_max = "SELECT Numero_Questoes FROM cadastro_provas WHERE Codigo_prova = ?";
    $stmt_max = $con->prepare($sql_total_max);
    $stmt_max->bind_param("s", $codigo_prova);
    $stmt_max->execute();
    $stmt_max->bind_result($total_max_questoes);
    $stmt_max->fetch();
    $stmt_max->close();

    // Verifica o limite de questões ao inserir novas questões (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $is_adicionar_remover) {
        // Questões selecionadas pelo usuário no formulário
        $questoes_selecionadas = isset($_POST['questoes']) ? $_POST['questoes'] : [];
    
        // Identificar as questões a adicionar (novas seleções) e a remover (desmarcadas)
        $questoes_a_adicionar = array_diff($questoes_selecionadas, $questoes_incluidas);
        $questoes_a_remover = array_diff($questoes_incluidas, $questoes_selecionadas);
    
        // Inserir novas questões selecionadas
        foreach ($questoes_a_adicionar as $questao) {
            $sql_inserir_questao = "INSERT INTO tabela_questoes (Codigo_Prova, Questao) VALUES (?, ?)";
            $stmt_inserir = $con->prepare($sql_inserir_questao);
            $stmt_inserir->bind_param("si", $codigo_prova, $questao);
            $stmt_inserir->execute();
            $stmt_inserir->close();
        }
    
        // Remover as questões desmarcadas que já estão no banco de dados
        foreach ($questoes_a_remover as $questao) {
            $sql_remover_questao = "DELETE FROM tabela_questoes WHERE Codigo_Prova = ? AND Questao = ?";
            $stmt_remover = $con->prepare($sql_remover_questao);
            $stmt_remover->bind_param("si", $codigo_prova, $questao);
            $stmt_remover->execute();
            $stmt_remover->close();
        }
    
        // Redirecionar para manter os parâmetros de filtro
        header("Location: inccquestao.php?modo=inserir&prova=$codigo_prova&sucesso=atualizado");
        exit();
    }

    
}

include 'cabecalho.php';
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
                    <li class="active"><?php echo $is_adicionar_remover ? "Adicionar Questões à Prova" : "Alterar Questões"; ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo $is_adicionar_remover ? "Adicionar ou Remover Questões da Prova:" : "Alterar Questões"; ?></h1>

                <?php
                // Mensagens de sucesso ou erro
                if (isset($_GET['erro']) && $_GET['erro'] == 'limite') {
                    echo "<p style='color: red;'>O limite de questões para esta prova foi atingido. Novas questões não foram incluídas.</p>";
                }

                if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'atualizado') {
                    echo "<p style='color: green;'>Questões atualizadas com sucesso.</p>";
                }

                // Obter as questões já associadas à prova, se estiver no modo de adicionar/remover
                $questoes_incluidas = [];
                if ($is_adicionar_remover && $codigo_prova) {
                    $sql_questoes_incluidas = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = ?";
                    if ($stmt_incluidas = $con->prepare($sql_questoes_incluidas)) {
                        $stmt_incluidas->bind_param("s", $codigo_prova);
                        $stmt_incluidas->execute();
                        $result_incluidas = $stmt_incluidas->get_result();
                        while ($row = $result_incluidas->fetch_assoc()) {
                            $questoes_incluidas[] = $row['Questao'];
                        }
                        $stmt_incluidas->close();
                    }
                }

                // Configurações de filtro e exibição
                $disciplina = isset($_GET['disciplina']) ? $_GET['disciplina'] : 'Todas';
                $professor = isset($_GET['professor']) ? $_GET['professor'] : 'Todos';
                echo "<form method=\"GET\" action=\"inccquestao.php\">";
                echo "Filtrar por disciplina: ";
                echo "<select name=\"disciplina\">";
                $sql = "SELECT DISTINCT Disciplina FROM cadastro_questoes";
                $r = mysqli_query($con, $sql);
                echo "<option>Todas</option>";
                while ($dados = mysqli_fetch_array($r)) {
                    echo "<option value=\"" . $dados['Disciplina'] . "\" " . ($disciplina == $dados['Disciplina'] ? "selected" : "") . ">" . $dados['Disciplina'] . "</option>";
                }
                echo "</select> Por Professor: ";
                echo "<select name=\"professor\">";
                $sql = "SELECT DISTINCT Professor_Responsavel FROM cadastro_questoes";
                $r = mysqli_query($con, $sql);
                echo "<option>Todos</option>";
                while ($dados = mysqli_fetch_array($r)) {
                    echo "<option value=\"" . $dados['Professor_Responsavel'] . "\" " . ($professor == $dados['Professor_Responsavel'] ? "selected" : "") . ">" . $dados['Professor_Responsavel'] . "</option>";
                }
                echo "</select>";
                echo " <input type=\"submit\" name=\"enviar\" value=\"Filtrar\">";
                echo "<input type=\"hidden\" name=\"modo\" value=\"$modo\">";
                echo "<input type=\"hidden\" name=\"prova\" value=\"$codigo_prova\">"; // Preserva `prova` no filtro
                echo "</form><br>";

                // Configura o número de questões por página e a paginação (mínimo 50)
                $por_pagina = 50;
                $qi = isset($_GET['qi']) ? $_GET['qi'] : 0;

                $sql = "SELECT * FROM cadastro_questoes WHERE 1=1";
                if ($disciplina != 'Todas') {
                    $sql .= " AND Disciplina = '" . $disciplina . "'";
                }
                if ($professor != 'Todos' && !empty($professor)) {
                    $sql .= " AND Professor_Responsavel = '" . $professor . "'";
                }

                $sql .= " LIMIT $qi, $por_pagina";
                $r = mysqli_query($con, $sql);
                $total_questoes = mysqli_num_rows($r);

                echo "<form method=\"POST\" action=\"inccquestao.php?modo=$modo&prova=$codigo_prova\">";
                echo "<div style='display: flex;'>";

                // Lista de questões à esquerda
                echo "<div style='width: 30%;'>";
                echo "<ul>";
                while ($dados = mysqli_fetch_array($r)) {
                    $highlight_class = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? "highlight" : "";
                    $checked = in_array($dados['Codigo'], $questoes_incluidas) ? "checked" : "";
                    $button_style_conditional = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? $button_style : "";

                    echo "<li><span class=\"$highlight_class\">";

                    // Exibir caixas de seleção apenas no modo adicionar/remover
                    if ($is_adicionar_remover) {
                        echo "<input type=\"checkbox\" name=\"questoes[]\" value=\"" . $dados['Codigo'] . "\" $checked> ";
                    }

                    // Botão "Ver Questão" com estilo condicional e número da questão
                    echo "<a href=\"inccquestao.php?modo=$modo&prova=$codigo_prova&codigo=" . $dados['Codigo'] . "&por_pagina=$por_pagina&qi=$qi&disciplina=$disciplina&professor=$professor\" style='$button_style_conditional; margin-right: 10px;'>Questão " . $dados['Codigo'] . "</a>";

                    // Botão "Alterar" sempre aparece
                    echo "<a href=\"altquestao.php?codigo=" . $dados['Codigo'] . "&prova=" . $codigo_prova . "\" style='$button_style_conditional;'>Alterar</a>";

                    echo "</span></li>";
                }
                echo "</ul>";
                echo "</div>";

                // Área de visualização da questão à direita
                echo "<div style='width: 70%; padding-left: 20px;'>";
                if (isset($_GET['codigo'])) {
                    $codigo_questao = $_GET['codigo'];
                    include 'mostraq.php'; // Inclui o arquivo que mostra a questão selecionada
                } else {
                    echo "<p>Selecione uma questão à esquerda para visualizar.</p>";
                }
                echo "</div>";
                echo "</div>";

                // Exibir o botão "Atualizar questões" apenas no modo "inserir"
                if ($is_adicionar_remover) {
                    echo "<br><input type=\"submit\" value=\"Atualizar questões\" class=\"btn btn-primary\">";
                    echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"$codigo_prova\">";
                    echo "<input type=\"hidden\" name=\"modo\" value=\"$modo\">"; // Inclui o modo para manter na URL
                }
                echo "</form>";
                ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

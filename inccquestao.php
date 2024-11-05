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

// Inicializa a variável como um array vazio para evitar erros
$questoes_incluidas = [];

if ($codigo_prova) {
    // Inicializa a variável de questões incluídas como um array vazio
    $questoes_incluidas = [];

    // Obter as questões já associadas à prova antes da atualização
    $sql_questoes_incluidas = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = ?";
    $stmt_incluidas = $con->prepare($sql_questoes_incluidas);
    $stmt_incluidas->bind_param("s", $codigo_prova);
    $stmt_incluidas->execute();
    $result_incluidas = $stmt_incluidas->get_result();
    if ($result_incluidas) {
        while ($row = $result_incluidas->fetch_assoc()) {
            $questoes_incluidas[] = $row['Questao'];
        }
    }
    $stmt_incluidas->close();

    // Obter o número de questões já incluídas e o limite máximo
    $total_questoes_prova = count($questoes_incluidas);
    $sql_total_max = "SELECT Numero_Questoes FROM cadastro_provas WHERE Codigo_prova = ?";
    $stmt_max = $con->prepare($sql_total_max);
    $stmt_max->bind_param("s", $codigo_prova);
    $stmt_max->execute();
    $stmt_max->bind_result($total_max_questoes);
    $stmt_max->fetch();
    $stmt_max->close();

    // Verifica se o limite foi atingido
    $limite_atingido = $total_questoes_prova >= $total_max_questoes;

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $is_adicionar_remover) {
        $questoes_selecionadas = isset($_POST['questoes']) ? $_POST['questoes'] : [];
        $questoes_a_adicionar = array_diff($questoes_selecionadas, $questoes_incluidas);
        $questoes_a_remover = array_diff($questoes_incluidas, $questoes_selecionadas);

        foreach ($questoes_a_adicionar as $questao) {
            // Verifica se o limite já foi atingido antes de inserir
            if ($total_questoes_prova < $total_max_questoes) {
                $sql_inserir_questao = "INSERT INTO tabela_questoes (Codigo_Prova, Questao) VALUES (?, ?)";
                $stmt_inserir = $con->prepare($sql_inserir_questao);
                $stmt_inserir->bind_param("si", $codigo_prova, $questao);
                $stmt_inserir->execute();
                $stmt_inserir->close();
                $total_questoes_prova++; // Incrementa o contador de questões
            } else {
                // Redireciona com mensagem de erro se o limite for atingido durante a submissão
                header("Location: inccquestao.php?modo=inserir&prova=$codigo_prova&erro=limite_atingido");
                exit();
            }
        }

        foreach ($questoes_a_remover as $questao) {
            $sql_remover_questao = "DELETE FROM tabela_questoes WHERE Codigo_Prova = ? AND Questao = ?";
            $stmt_remover = $con->prepare($sql_remover_questao);
            $stmt_remover->bind_param("si", $codigo_prova, $questao);
            $stmt_remover->execute();
            $stmt_remover->close();
        }

        header("Location: inccquestao.php?modo=inserir&prova=$codigo_prova&sucesso=atualizado");
        exit();
    }
}

include 'cabecalho.php';

// Configura o número de questões por página e a paginação (mínimo 50)
$por_pagina = 30;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_atual - 1) * $por_pagina;

// Calcular o total de páginas com base no número total de questões
$sql_total_questoes = "SELECT COUNT(*) AS total FROM cadastro_questoes";
$resultado_total = mysqli_query($con, $sql_total_questoes);
$total_questoes = mysqli_fetch_assoc($resultado_total)['total'];
$total_paginas = ceil($total_questoes / $por_pagina);

function exibir_paginacao($total_paginas, $pagina_atual, $modo, $codigo_prova, $disciplina, $professor) {
    echo '<div class="pagination">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        $estilo = $i == $pagina_atual ? 'font-weight: bold;' : '';
        echo "<a href=\"inccquestao.php?pagina=$i&modo=$modo&prova=$codigo_prova&disciplina=$disciplina&professor=$professor\" style='$estilo'>$i</a> ";
    }
    echo '</div>';
}

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
            
            <?php
            // Mensagens de sucesso ou erro
                if (isset($_GET['erro']) && $_GET['erro'] == 'limite_atingido') {
                    echo "<p style='color: red;'>Não é possível adicionar mais questões.</p>";
                }

                if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'atualizado') {
                    echo "<p style='color: green;'>Questões atualizadas com sucesso.</p>";
                }
            ?>

                <h1><?php echo $is_adicionar_remover ? "Adicionar ou Remover Questões da Prova:" : "Alterar Questões"; ?></h1>

                <?php
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
                echo "<input type=\"hidden\" name=\"prova\" value=\"$codigo_prova\">";
                echo "<input type=\"hidden\" name=\"pagina\" value=\"$pagina_atual\">";
                echo "</form><br>";

echo "<div style='text-align: center; margin-top: 20px;'>";

echo "</div>";


                $sql = "SELECT * FROM cadastro_questoes WHERE 1=1";
                if ($disciplina != 'Todas') {
                    $sql .= " AND Disciplina = '" . $disciplina . "'";
                }
                if ($professor != 'Todos' && !empty($professor)) {
                    $sql .= " AND Professor_Responsavel = '" . $professor . "'";
                }
                //$sql .= " LIMIT $inicio, $por_pagina";
                $r = mysqli_query($con, $sql);
                
                echo "<form method=\"POST\" action=\"inccquestao.php?modo=$modo&prova=$codigo_prova\">";
                echo "<div style='display: flex;'>";

                echo "<div style='width: 30%; height: 700px; overflow-y: scroll;'>";
echo "<ul>";

while ($dados = mysqli_fetch_array($r)) {
    $highlight_class = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? "highlight" : "";
    $checked = in_array($dados['Codigo'], $questoes_incluidas) ? "checked" : "";
    $button_style_conditional = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? $button_style : "";

    echo "<li><span class=\"$highlight_class\">";
    if ($is_adicionar_remover) {
        echo "<input type=\"checkbox\" name=\"questoes[]\" value=\"" . $dados['Codigo'] . "\" $checked> ";
    }
    echo "<a href=\"inccquestao.php?modo=$modo&prova=$codigo_prova&codigo=" . $dados['Codigo'] . "&pagina=$pagina_atual&disciplina=$disciplina&professor=$professor\" style='$button_style_conditional; margin-right: 10px;'>Questão " . $dados['Codigo'] . "</a>";
    
    // Verifica se o modo não é "inserir" para mostrar o botão "Alterar"
    if ($modo !== 'inserir') {
        echo "<a href=\"altquestao.php?codigo=" . $dados['Codigo'] . "&prova=" . $codigo_prova . "\" style='$button_style_conditional;'>Alterar</a>";
    }

    echo "</span></li>";
}

echo "</ul>";
echo "</div>";

                echo "<div style='width: 70%; padding-left: 00px;'>";
                if (isset($_GET['codigo'])) {
                    $codigo_questao = $_GET['codigo'];
                    include 'mostraq.php';
                } else {
                    echo "<p>Selecione uma questão à esquerda para visualizar.</p>";
                }
                echo "</div>";
                echo "</div>";

                if ($is_adicionar_remover) {
                    echo "<br><input type=\"submit\" value=\"Atualizar questões\" class=\"btn btn-primary\">";
                    echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"$codigo_prova\">";
                    echo "<input type=\"hidden\" name=\"modo\" value=\"$modo\">";
                }
                echo "</form>";

echo "<div style='text-align: center; margin-top: 20px;'>";


echo "</div>";

                ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>
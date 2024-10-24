<?php
// Verifique se o cookie existe e o nível do usuário
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

// Realize as verificações e redirecionamentos antes de qualquer saída HTML
if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome  = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;

    if ($nivel == 'Professor') {
        // Obter o total de questões que já estão associadas à prova
        if (isset($_GET['prova'])) {
            $codigo_prova = $_GET['prova'];

            // Número de questões já incluídas
            $sql_total_questoes_prova = "SELECT COUNT(*) AS total FROM tabela_questoes WHERE Codigo_Prova = ?";
            $stmt_total = $con->prepare($sql_total_questoes_prova);
            $stmt_total->bind_param("s", $codigo_prova);
            $stmt_total->execute();
            $stmt_total->bind_result($total_questoes_prova);
            $stmt_total->fetch();
            $stmt_total->close();

            // Número máximo de questões permitidas
            $sql_total_max = "SELECT Numero_Questoes FROM cadastro_provas WHERE Codigo_prova = ?";
            $stmt_max = $con->prepare($sql_total_max);
            $stmt_max->bind_param("s", $codigo_prova);
            $stmt_max->execute();
            $stmt_max->bind_result($total_max_questoes);
            $stmt_max->fetch();
            $stmt_max->close();

            // Verifica se o limite foi atingido ou ultrapassado
            if ($total_questoes_prova >= $total_max_questoes) {
                // Redireciona com erro se o limite foi atingido, mas com uma verificação se o erro já foi mostrado
                if (!isset($_GET['erro']) || $_GET['erro'] !== 'limite') {
                    header("Location: inccquestao.php?prova=$codigo_prova&erro=limite");
                    exit();
                }
            }
        }

        // Se houver POST (submissão de questões)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo_prova = $_POST['codigo_prova'];
            $questoes_selecionadas = isset($_POST['questoes']) ? $_POST['questoes'] : [];

            // Número de questões já incluídas
            $sql_total_questoes_prova = "SELECT COUNT(*) AS total FROM tabela_questoes WHERE Codigo_Prova = ?";
            $stmt_total = $con->prepare($sql_total_questoes_prova);
            $stmt_total->bind_param("s", $codigo_prova);
            $stmt_total->execute();
            $stmt_total->bind_result($total_questoes_prova);
            $stmt_total->fetch();
            $stmt_total->close();

            // Número máximo de questões permitidas
            $sql_total_max = "SELECT Numero_Questoes FROM cadastro_provas WHERE Codigo_prova = ?";
            $stmt_max = $con->prepare($sql_total_max);
            $stmt_max->bind_param("s", $codigo_prova);
            $stmt_max->execute();
            $stmt_max->bind_result($total_max_questoes);
            $stmt_max->fetch();
            $stmt_max->close();

            // Verifica se a inclusão ultrapassará o limite
            $questoes_disponiveis = $total_max_questoes - $total_questoes_prova; // Questões que ainda podem ser adicionadas
            $atingiu_limite = count($questoes_selecionadas) > $total_max_questoes;

            if ($atingiu_limite) {
                // Redireciona sem incluir novas questões, se o limite for atingido, verificando se o erro já foi mostrado
                header("Location: inccquestao.php?prova=$codigo_prova&erro=limite");
                exit();
            } else {
                // Obtenha as questões já associadas à prova antes da atualização
                $sql_questoes_incluidas = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = ?";
                $questoes_incluidas = [];
                $stmt_incluidas = $con->prepare($sql_questoes_incluidas);
                $stmt_incluidas->bind_param("s", $codigo_prova);
                $stmt_incluidas->execute();
                $result_incluidas = $stmt_incluidas->get_result();
                while ($row = $result_incluidas->fetch_assoc()) {
                    $questoes_incluidas[] = $row['Questao'];
                }
                $stmt_incluidas->close();

                // Inclua as novas questões selecionadas, se houver
                foreach ($questoes_selecionadas as $questao) {
                    if (!in_array($questao, $questoes_incluidas)) {
                        $sql_incluir_questao = "INSERT INTO tabela_questoes (Codigo_Prova, Questao) VALUES (?, ?)";
                        $stmt_incluir = $con->prepare($sql_incluir_questao);
                        $stmt_incluir->bind_param("si", $codigo_prova, $questao);
                        $stmt_incluir->execute();
                        $stmt_incluir->close();
                    }
                }

                // Remova as questões que foram desmarcadas
                foreach ($questoes_incluidas as $questao_incluida) {
                    if (!in_array($questao_incluida, $questoes_selecionadas)) {
                        $sql_remover_questao = "DELETE FROM tabela_questoes WHERE Codigo_Prova = ? AND Questao = ?";
                        $stmt_remover = $con->prepare($sql_remover_questao);
                        $stmt_remover->bind_param("si", $codigo_prova, $questao_incluida);
                        $stmt_remover->execute();
                        $stmt_remover->close();
                    }
                }

                // Redireciona após inclusão ou remoção bem-sucedida
                header("Location: inccquestao.php?prova=$codigo_prova&sucesso=atualizado");
                exit();
            }
        }
    }
}

// Inclua o HTML e qualquer outro conteúdo após todas as verificações e redirecionamentos
include 'cabecalho.php';
?>

<!-- Todo o conteúdo HTML aqui -->
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
                    <li class="active">Incluir e Alterar Prova</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Clique em incluir para adicionar ou remover as questões:</h1>
                <?php
                if (isset($_GET['prova'])) {
                    $codigo_prova = $_GET['prova'];

                    // Mensagens de sucesso ou erro
                    if (isset($_GET['erro']) && $_GET['erro'] == 'limite') {
                        echo "<p style='color: red;'>O limite de questões para esta prova foi atingido. Novas questões não foram incluídas.</p>";
                    }

                    if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'atualizado') {
                        echo "<p style='color: green;'>Questões atualizadas com sucesso.</p>";
                    }

                    // Obter as questões que já estão associadas à prova
                    $sql_questoes_incluidas = "SELECT Questao FROM tabela_questoes WHERE Codigo_Prova = ?";
                    $questoes_incluidas = [];
                    if ($stmt_incluidas = $con->prepare($sql_questoes_incluidas)) {
                        $stmt_incluidas->bind_param("s", $codigo_prova);
                        $stmt_incluidas->execute();
                        $result_incluidas = $stmt_incluidas->get_result();
                        while ($row = $result_incluidas->fetch_assoc()) {
                            $questoes_incluidas[] = $row['Questao']; // Armazena as questões já incluídas
                        }
                        $stmt_incluidas->close();
                    }

                    // Definir valores padrão para os filtros se não forem fornecidos
                    $disciplina = isset($_GET['disciplina']) ? $_GET['disciplina'] : 'Todas';
                    $professor = isset($_GET['professor']) ? $_GET['professor'] : 'Todos';

                    // Mostrar formulário de filtro e exibição de questões
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

                    echo " Questões por página: ";
                    echo "<select name=\"por_pagina\">";
                    $opcoes_por_pagina = [10, 20, 30, 50, 100];
                    foreach ($opcoes_por_pagina as $opcao) {
                        echo "<option value=\"$opcao\" " . (isset($_GET['por_pagina']) && $_GET['por_pagina'] == $opcao ? "selected" : "") . ">$opcao</option>";
                    }
                    echo "</select>";

                    echo "<input type=\"hidden\" name=\"prova\" value=\"" . $codigo_prova . "\">";
                    echo " <input type=\"submit\" name=\"enviar\" value=\"Filtrar\">";
                    echo "</form><br>";

                    // Configurando o número de questões por página
                    $por_pagina = isset($_GET['por_pagina']) ? $_GET['por_pagina'] : 30;

                    // Paginação e exibição das questões
                    $qi = isset($_GET['qi']) ? $_GET['qi'] : 0;

                    // Monta o SQL com os filtros de disciplina e professor
                    $sql = "SELECT * FROM cadastro_questoes WHERE 1=1";

                    if ($disciplina != 'Todas') {
                        $sql .= " AND Disciplina = '" . $disciplina . "'";
                    }

                    if ($professor != 'Todos' && !empty($professor)) {
                        $sql .= " AND Professor_Responsavel = '" . $professor . "'";
                    }

                    $r = mysqli_query($con, $sql);
                    $total_questoes = mysqli_num_rows($r);

                    // Paginação
                    echo "Páginas: ";
                    for ($p = 1; $p <= ceil($total_questoes / $por_pagina); $p++) {
                        $pg = ($p - 1) * $por_pagina;
                        echo "<a href=\"inccquestao.php?prova=$codigo_prova&qi=$pg&por_pagina=$por_pagina&disciplina=$disciplina&professor=$professor\">" . ($p == ceil($qi / $por_pagina) + 1 ? "<span class='highlight'>$p</span>" : "$p") . "</a>&nbsp;";
                    }
                    echo "<br><br>";

                    // Exibição das questões em formato de lista com checkboxes
                    echo "<form method=\"POST\" action=\"inccquestao.php\">";
                    echo "<div style='display: flex;'>";

                    // Lista de questões à esquerda
                    echo "<div style='width: 30%;'>";
                    echo "<ul>";
                    $sql .= " LIMIT $qi, $por_pagina";
                    $r = mysqli_query($con, $sql);
                    while ($dados = mysqli_fetch_array($r)) {
                        $highlight_class = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? "highlight" : "";
                        $checked = in_array($dados['Codigo'], $questoes_incluidas) ? "checked" : ""; // Marca as questões já incluídas
                        echo "<li><span class=\"$highlight_class\">";
                        echo "<input type=\"checkbox\" name=\"questoes[]\" value=\"" . $dados['Codigo'] . "\" $checked> ";
                        echo "<a href=\"inccquestao.php?prova=$codigo_prova&codigo=" . $dados['Codigo'] . "&por_pagina=$por_pagina&qi=$qi&disciplina=$disciplina&professor=$professor\">Questão " . $dados['Codigo'] . "</a>";
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
                    echo "<br><input type=\"submit\" value=\"Atualizar questões\" class=\"btn btn-primary\">";
                    echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"$codigo_prova\">";
                    echo "</form>";
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

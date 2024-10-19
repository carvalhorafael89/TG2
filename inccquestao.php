<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
    exit();
}

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome  = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;

    if ($nivel == 'Professor') {
?>

<!-- end header -->
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
                <h1>Clique em incluir para adicionar as questões:</h1>

                <?php
                if (isset($_GET['prova'])) {
                    $codigo_prova = $_GET['prova'];

                    // Formulário para filtro por disciplina, professor e quantidade de questões por página
                    echo "<form method=\"GET\" action=\"inccquestao.php\">";
                    echo "Filtrar por disciplina: ";
                    echo "<select name=\"disciplina\">";
                    $sql = "SELECT DISTINCT Disciplina FROM cadastro_questoes";
                    $r = mysqli_query($con, $sql);
                    echo "<option>Todas</option>";
                    while ($dados = mysqli_fetch_array($r)) {
                        echo "<option value=\"" . $dados['Disciplina'] . "\" " . (isset($_GET['disciplina']) && $_GET['disciplina'] == $dados['Disciplina'] ? "selected" : "") . ">" . $dados['Disciplina'] . "</option>";
                    }
                    echo "</select> Por Professor: ";
                    echo "<select name=\"professor\">";
                    $sql = "SELECT DISTINCT Professor_Responsavel FROM cadastro_questoes";
                    $r = mysqli_query($con, $sql);
                    echo "<option>Todos</option>";
                    while ($dados = mysqli_fetch_array($r)) {
                        echo "<option value=\"" . $dados['Professor_Responsavel'] . "\" " . (isset($_GET['professor']) && $_GET['professor'] == $dados['Professor_Responsavel'] ? "selected" : "") . ">" . $dados['Professor_Responsavel'] . "</option>";
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

                    if (isset($_GET['disciplina']) && $_GET['disciplina'] != 'Todas') {
                        $sql .= " AND Disciplina = '" . $_GET['disciplina'] . "'";
                    }

                    if (isset($_GET['professor']) && $_GET['professor'] != 'Todos' && !empty($_GET['professor'])) {
                        $sql .= " AND Professor_Responsavel = '" . $_GET['professor'] . "'";
                    }
                    
                    $r = mysqli_query($con, $sql);
                    $total_questoes = mysqli_num_rows($r);

                    // Paginação
                    echo "Páginas: ";
                    for ($p = 1; $p <= ceil($total_questoes / $por_pagina); $p++) {
                        $pg = ($p - 1) * $por_pagina;
                        echo "<a href=\"inccquestao.php?prova=$codigo_prova&qi=$pg&por_pagina=$por_pagina&disciplina=" . $_GET['disciplina'] . "&professor=" . $_GET['professor'] . "\">" . ($p == ceil($qi / $por_pagina) + 1 ? "<span class='highlight'>$p</span>" : "$p") . "</a>&nbsp;";
                    }
                    echo "<br><br>";

                    // Exibição das questões em formato de lista com checkboxes
                    echo "<form method=\"POST\" action=\"incqbd.php\">";
                    echo "<div style='display: flex;'>";

                    // Lista de questões à esquerda
                    echo "<div style='width: 30%;'>";
                    echo "<ul>";
                    $sql .= " LIMIT $qi, $por_pagina";
                    $r = mysqli_query($con, $sql);
                    while ($dados = mysqli_fetch_array($r)) {
                        $highlight_class = (isset($_GET['codigo']) && $_GET['codigo'] == $dados['Codigo']) ? "highlight" : "";
                        echo "<li><span class=\"$highlight_class\">";
                        echo "<input type=\"checkbox\" name=\"questoes[]\" value=\"" . $dados['Codigo'] . "\"> ";
                        echo "<a href=\"inccquestao.php?prova=$codigo_prova&codigo=" . $dados['Codigo'] . "&por_pagina=$por_pagina&qi=$qi&disciplina=" . $_GET['disciplina'] . "&professor=" . $_GET['professor'] . "\">Questão " . $dados['Codigo'] . "</a>";
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
                    echo "<br><input type=\"submit\" value=\"Incluir questões\" class=\"btn btn-primary\">";
                    echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"$codigo_prova\">";
                    echo "</form>";

                } else {
                    echo "Erro: Código da prova não especificado.";
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
    }
}
include 'footer.php';
?>

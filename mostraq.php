<?php
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome  = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];

    if (isset($_GET['codigo'])) {
        $codquestao = $_GET['codigo'];

        $bqsql = "SELECT * FROM cadastro_questoes WHERE Codigo = '$codquestao'";
        $resp1 = mysqli_query($con, $bqsql);
        
        while ($bqdados = mysqli_fetch_array($resp1)) {
            // Exibe a disciplina
            echo "<p><small>Esta questão refere-se à disciplina: " . $bqdados['Disciplina'] . "</small></p>";
            echo "<br>";
            
            // Mostra o texto da questão
            echo "<p><small>" . $bqdados['Questao'] . "</small></p>";
            echo "<br>";
            
            if ($bqdados['Figura'] && $bqdados['Figura'] != 'figuras/') {
                echo "<a href=\"" . $bqdados['Figura'] . "\" target=\"_blank\"><img src=\"" . $bqdados['Figura'] . "\" width=\"800\"></a>";
                echo "<br><small>Clique na figura para ver no tamanho original.</small><br>";
            }

            // Exibe as respostas e destaca a correta em verde
            $alternativas = ['A', 'B', 'C', 'D', 'E'];
            foreach ($alternativas as $alt) {
                $resposta = $bqdados["Resposta$alt"];
                if ($bqdados['Correta'] == $alt) {
                    echo "<br><span style='color:green;'>$alt - $resposta</span>";
                } else {
                    echo "<br>$alt - $resposta";
                }
            }

            echo "<br>";
        }
    }
}
?>
<?php
// Iniciar buffer de saída
ob_start();

// Iniciar sessão
session_start();

// Incluir verificação de nível de acesso e conectar ao banco de dados, se necessário
require_once 'conecta.php';
include 'cabecalho.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados da questão enviados pelo formulário
    $disciplina = htmlspecialchars($_POST['disciplina']);
    $questao = htmlspecialchars($_POST['questao']);
    $alternativas = [
        'A' => htmlspecialchars($_POST['A']),
        'B' => htmlspecialchars($_POST['B']),
        'C' => htmlspecialchars($_POST['C']),
        'D' => htmlspecialchars($_POST['D']),
        'E' => htmlspecialchars($_POST['E'])
    ];
    $correta = htmlspecialchars($_POST['correta']);
    $positivo = htmlspecialchars($_POST['positivo']);
    $negativo = htmlspecialchars($_POST['negativo']);
}
?>

<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="text-center">Pré-visualização da Questão</h2>
                <p class="text-center text-muted">Esta é apenas uma pré-visualização. A questão não foi gravada ainda.</p>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3>Disciplina: <?= $disciplina ?></h3>
                <p><strong>Questão:</strong> <?= $questao ?></p>

                <div>
                    <h4>Alternativas:</h4>
                    <?php foreach ($alternativas as $letra => $texto): ?>
                        <p><strong><?= $letra ?>:</strong> <?= $texto ?></p>
                    <?php endforeach; ?>
                </div>

                <h4>Resposta Correta: <?= $correta ?></h4>
                <h4>Feedback Positivo: <?= $positivo ?></h4>
                <h4>Feedback Negativo: <?= $negativo ?></h4>

                <form action="cadquestao.php" method="post">
                    <!-- Retornar dados preenchidos para `cadquestao.php` -->
                    <input type="hidden" name="disciplina" value="<?= $disciplina ?>">
                    <input type="hidden" name="questao" value="<?= $questao ?>">
                    <input type="hidden" name="A" value="<?= $alternativas['A'] ?>">
                    <input type="hidden" name="B" value="<?= $alternativas['B'] ?>">
                    <input type="hidden" name="C" value="<?= $alternativas['C'] ?>">
                    <input type="hidden" name="D" value="<?= $alternativas['D'] ?>">
                    <input type="hidden" name="E" value="<?= $alternativas['E'] ?>">
                    <input type="hidden" name="correta" value="<?= $correta ?>">
                    <input type="hidden" name="positivo" value="<?= $positivo ?>">
                    <input type="hidden" name="negativo" value="<?= $negativo ?>">
                    
                    <form action="cadquestao.php" method="post">
    <button type="submit" class="btn btn-warning">Voltar e Editar</button>
</form>
                    <button type="submit" formaction="procquestao.php" class="btn btn-success">Gravar Questão</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

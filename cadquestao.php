<!-- Página estilizada -->
<?php
if (!isset($_COOKIE['Nivel'])) {
    $voltar = "login.php?acesso=denied";
    header("Location: $voltar");
}
require_once 'conecta.php';
include 'cabecalho.php';

if (isset($_COOKIE['Nivel'])) {
    $nivel = $_COOKIE['Nivel'];
    $nome = $_COOKIE['Nome'];
    $Email = $_COOKIE['Email'];
    $codigo = $_COOKIE['Codigo'];
    $codigo_aluno = $codigo;    

    if ($nivel == 'Professor') {
?>
<section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="breadcrumb">
                    <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
                    <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
                    <li class="active">Cadastrar Questão</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card p-4 shadow-sm mb-4">
                    <form role="form" class="register-form" method="POST" enctype="multipart/form-data" action="procquestao.php">
                        <h2 class="text-primary">Cadastrar nova questão</h2>
                        <p class="mb-4 text-muted">Para cadastrar uma nova questão, preencha os dados abaixo e clique no botão <strong>INCLUIR</strong>.</p>

                        <div class="mb-3">
                            <label for="disciplina" class="form-label">Disciplina:</label>
                            
                            <input type="text" name="disciplina" class="form-control" id="disciplina" placeholder="Digite a disciplina">
                        </div>

                        <div class="mb-3">
                            <label for="questao" class="form-label">Questão:</label>
                            <textarea name="questao" class="form-control" id="questao" rows="5" placeholder="Digite a questão"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alternativas:</label>
                            <textarea name="A" class="form-control mb-2" rows="3" placeholder="Alternativa A"></textarea>
                            <textarea name="B" class="form-control mb-2" rows="3" placeholder="Alternativa B"></textarea>
                            <textarea name="C" class="form-control mb-2" rows="3" placeholder="Alternativa C"></textarea>
                            <textarea name="D" class="form-control mb-2" rows="3" placeholder="Alternativa D"></textarea>
                            <textarea name="E" class="form-control mb-2" rows="3" placeholder="Alternativa E"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="correta" class="form-label">Correta:</label>
                            <select name="correta" class="form-select" id="correta">
                                <option>A</option>
                                <option>B</option>
                                <option>C</option>
                                <option>D</option>
                                <option>E</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="positivo" class="form-label">Feedback Positivo:</label>
                            <textarea name="positivo" class="form-control" id="positivo" rows="3" placeholder="Digite o feedback positivo"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="negativo" class="form-label">Feedback Negativo:</label>
                            <textarea name="negativo" class="form-control" id="negativo" rows="3" placeholder="Digite o feedback negativo"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="arquivo" class="form-label">Figura:</label>
                            <input name="arquivo" type="file" class="form-control" id="arquivo">
                        </div>

                        <div class="mb-4">
                            <label for="professor" class="form-label">Professor: </label>
                            <input type="text" name="professor" class="form-control" id="professor" value="<?php echo $nome; ?>" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">Gravar Questão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    } else {
        echo "<p class='text-danger text-center'>Acesso negado.</p>";
    }
}
include 'footer.php';
?>

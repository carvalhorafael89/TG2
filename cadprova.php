<?php
// Verifica se o usuário tem o cookie 'Nivel'
if (!isset($_COOKIE['Nivel'])) {
    header("Location: login.php?acesso=denied");
    exit();
}

// Conecta ao banco de dados
require_once 'conecta.php';
include 'cabecalho.php';

$nivel = $_COOKIE['Nivel'];
$nome = $_COOKIE['Nome'];
$email = $_COOKIE['Email'];
$codigo = $_COOKIE['Codigo'];
$codigo_aluno = $codigo;

if ($nivel === 'Professor') {
?>
<!-- Cabeçalho -->
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Professor</a><i class="icon-angle-right"></i></li>
          <li class="active">Cadastrar Prova</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- Formulário de Cadastro -->
<section id="content">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <h2>Cadastrar nova prova:</h2>
        <p>Para criar uma nova prova, preencha os dados abaixo e clique em "Criar" para selecionar as questões.</p>

        <form role="form" method="POST" enctype="multipart/form-data" action="procprova.php">
          <table>
            <tr>
              <td><label for="titulo">Título:</label></td>
              <td><input type="text" name="titulo" id="titulo" size="50" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="codigo">Código da Prova:</label></td>
              <td><input type="text" name="codigo" id="codigo" size="10" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="disciplina">Disciplina:</label></td>
              <td><input type="text" name="disciplina" id="disciplina" size="30" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="professor">Professor:</label></td>
              <td><input type="text" name="professor" id="professor" size="50" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="horas">Duração (Horas):</label></td>
              <td><input type="number" name="horas" id="horas" size="3" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="minutos">Duração (Minutos):</label></td>
              <td><input type="number" name="minutos" id="minutos" size="3" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="codigoacesso">Código de Acesso:</label></td>
              <td><input type="text" name="codigoacesso" id="codigoacesso" size="20" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="quantidade">Quantidade de Questões:</label></td>
              <td><input type="number" name="quantidade" id="quantidade" size="3" required></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td><label for="descricao">Descrição da Prova:</label></td>
              <td><textarea name="descricao" id="descricao" cols="60" rows="10" required></textarea></td>
            </tr>
            <tr><td>&nbsp;</td><td></td></tr>
            <tr>
              <td></td>
              <td><input type="submit" name="enviar" value="Criar"></td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
} else {
    echo "<h1>Você não tem permissão para acessar esta página.</h1>";
}
include 'footer.php';
?>

<?php
if (!isset($_COOKIE['Nivel']))
{
    
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
}  
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';

if (isset($_COOKIE['Nivel']))
{
    
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
    $codigo_aluno=$codigo;
                    
    if ($nivel=='Professor')
    {
        
    
?>
<!-- end header -->
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
        
<section id="content">
<div class="container">

<div class="row">
    <div class="col-lg-12">
                        <h2>Cadastrar nova prova:</h2>
                        <p>Para criar uma nova prova, preencha os dados abaixo e clique em enviar para selecionar as questões.</p>
                    
                    <form role="form" class="register-form" method="POST" enctype="multipart/form-data" action="procprova.php">
                    <table>
                    <tr>
                        <td> Título:</td>
                        <td><input type="text" name="titulo" size="50"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Código da Prova:</td>
                        <td><input type="text" name="codigo" size="10"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Disciplina:</td>
                        <td><input type="text" name="disciplina" size="30"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Professor:</td>
                        <td><input type="text" name="professor" size="50"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Duração (hs):</td>
                        <td><input type="text" name="horas" size="3"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Minutos:</td>
                        <td><input type="text" name="minutos" size="3"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Código de Acesso:</td>
                        <td> <input type="text" name="codigoacesso" size="20"></td>
                            
                     
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Quantidade de questões:</td>
                        <td><input type="text" name="quantidade" size="3"></td>
                    </tr>
                       <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Descrição da prova:</td>
                        <td><textarea name="descricao" cols="60" rows="10">
                          </textarea></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="enviar" value="Criar"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
 
                </table>
               
            </form>
  </div>
  </div>
  </div>
</section>

 <?php
    }
    else
    {
        
    }
}
    else
    {
        
    }
?>
<?php
                  include 'footer.php';
    
            ?>             
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
        <form role="form" class="register-form" method="POST" enctype="multipart/form-data" action="procquestao.php">
       
             <h2>Cadastrar nova questão:</h2>
             <h2><Small>Para cadastrar uma nova questão, preencha os dados abaixo e clique no botão INCLUIR.</small></h2>
                    
                 
                    <table>
                    <tr>
                        <td>Disciplina:</td>
                        <td><input type="text" name="disciplina" size="40"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Questão:</td>
                        <td><textarea name="questao" rows="5" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>A:</td>
                        <td><textarea name="A" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>B:</td>
                        <td><textarea name="B" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>C:</td>
                        <td><textarea name="C" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>D:</td>
                        <td><textarea name="D" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>E:</td>
                        <td><textarea name="E" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>Correta:</td>
                                <td><select name="correta">
                                        <option>A</option>
                                        <option>B</option>
                                        <option>C</option>
                                        <option>D</option>
                                        <option>E</option>
                            </select> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>Feedback Positivo:</td>
                        <td><textarea name="positivo" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>Feedback Negativo:</td>
                        <td><textarea name="negativo" rows="3" cols="80"></textarea> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>Figura:</td>
                        <td>
                            <input name="arquivo" type="file"> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td>Professor:</td>
                        <td><input type="text" name="professor" size="40" value="<?php echo $nome; ?>"> </td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" value="Gravar Questão" class="btn btn-primary btn-block btn-lg" tabindex="7"></td>
                    </tr>
                    
 
                </table>
               
            </form>
            
                    
    </div></div></div></section>
   

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
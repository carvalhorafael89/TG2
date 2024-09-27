<?php

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';


        
    
?>
<!-- end header -->
  <section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Log-in</a><i class="icon-angle-right"></i></li>
          <li class="active">Cadastrar Aluno</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">
<div class="container">

<div class="row">
    <div class="col-lg-12">
        <form role="form" class="register-form" method="POST" action="procadaluno.php">
                        <h1>Cadastrar novo aluno:</h1>
                        <p>Para cadastrar, digite os dados abaixo e clique no botão INCLUIR.</p>
                   
                    <table>
                    <tr>
                        <td> Nome do aluno:</td>
                        <td><input type="text" name="nome" size="50"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Senha de acesso:</td>
                        <td><input type="password" name="senha" size="12"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> RA (Se disponível):</td>
                        <td><input type="text" name="ra" size="16"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> CPF:</td>
                        <td><input type="text" name="cpf" size="20"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> E-Mail:</td>
                        <td><input type="text" name="email" size="50"></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Curso:</td>
                        <td><select name="curso">
                        <?php
                        
                        $sql="select * from cursos";
                        $r=mysqli_query($con, $sql);
                        while ($dados=mysqli_fetch_array($r)){
                            echo "<option>".$dados['curso']."</option>";
                            
                        }
                        
                        ?>
                        </select></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Semestre:</td>
                                <td><select name="semestre">
                            <?php
                                // Gera o número (ano)
                                $i=1;
                                do { echo "<option>".$i."o. Semestre</option>"; } while ($i++<9);
                                
                            
                            ?>
                                  </select></td>
                            
                     
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td> Ano:</td>
                                <td><select name="ano">
                            <?php
                                // Gera o número (ano)
                                $i=2010;
                                do { echo "<option>$i</option>"; } while ($i++<2030);
                                
                            
                            ?>
                            </select></td>
                    </tr>
                    <tr><td>&nbsp;</td><td></td></tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="enviar" value="Incluir"></td>
                    </tr>
                    
 
                </table>
               
            </form>
            
            </div> <!-- #main -->
        </div> <!-- #main-container -->
</div>
</session>
        <?php
                  include 'footer.php';
    
            ?>    

        
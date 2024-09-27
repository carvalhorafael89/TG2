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
                        <h1>Clique em incluir para adicionar a questão:</h1>
                        <p>...</p>
      
                        
                    <?php
                    if(isset($_GET['prova']))
                    {
                      $codigo_prova=$_GET['prova'];
                      
                     echo "<form method=\"GET\" action=\"inccquestao.php\">";
                      echo "Filtrar por disciplina: ";
                      echo "<select name=\"disciplina\">";
                      $sql="select DISTINCT Disciplina from cadastro_questoes";
                      $r=mysqli_query($con, $sql);
                      echo "<option>Todas</option>";
                      while ($dados=mysqli_fetch_array($r))
                      {
                        echo "<option>".$dados['Disciplina']."</option>";
                      }
                      echo "</select> Por Professor: "; 
                      echo "<select name=\"professor\">";
                      $sql="select DISTINCT Professor_Responsavel from cadastro_questoes";
                      $r=mysqli_query($con, $sql);
                      echo "<option>Todos</option>";
                      while ($dados=mysqli_fetch_array($r))
                      {
                        echo "<option>".$dados['Professor_Responsavel']."</option>";
                      }
                      echo "</select>";
                      
                      echo "<input type=\"hidden\" name=\"prova\" value=\"".$codigo_prova."\">";
                      echo " <input type=\"Submit\" name=\"enviar\" value=\"Filtrar\">";
                      echo "</form>";
                      
                      if(isset($_GET['qi']))
                      {
                        $qi=$_GET[qi];
                      }
                      else
                      { $qi=0; }
                      $sql="select * from cadastro_questoes";
                      
                      if (isset($_GET['disciplina']))
                      { if ($_GET['disciplina']!='Todas') {$sql=$sql." where Disciplina='".$_GET['disciplina']."'";}}
                      
                      
                      
                      $r=mysqli_query($con, $sql);
                      $total_questoes=0;
                      while ($dados=mysqli_fetch_array($r))
                      {
                        $total_questoes=$total_questoes+1;
                      }
                      $p=1; 
                      echo "Páginas: ";
                      do {
                        $pg=($p-1)*30;
                        echo "<a href=\"inccquestao.php?prova=".$codigo_prova."&qi=".$pg."\">".$p."</a>&nbsp;";
                        $p=$p+1;
                      } while ($p*30<=$total_questoes+30);
                      echo "<br><br>";
                      echo "<table><tr><td valign=\"top\">";
                      $sql="select * from cadastro_questoes";
                      if (isset($_GET['disciplina']))
                      { 
                        if ($_GET['disciplina']!='Todas') {$sql=$sql." where Disciplina='".$_GET['disciplina']."'";}}
                      
                        $sql=$sql." limit ".$qi.",30";
 
  
                    $r=mysqli_query($con, $sql);
                    
                    // Acrescentar filtros e mudanças de páginas 
                    //
                    
                    while ($dados=mysqli_fetch_array($r))
                    {
                        $vsql="select * from tabela_questoes where Questao=".$dados['Codigo']." and Codigo_Prova='".$codigo_prova."'";
                        $jaexiste=0;
                        $vr=mysqli_query($con,$vsql);
                        while ($vdados=mysqli_fetch_array($vr))
                        {  
                             
                                      $jaexiste=1;
                                 
                        }
                        
                        if ($jaexiste==0) {
                        echo "<p><form method=\"POST\" action=\"incqbd.php\">";
                        }
                        else
                            {
                        echo "<p><form method=\"POST\" action=\"remqbd.php\">";
                        }
                        echo "<table><tr><td>";
                        echo $dados['Codigo'];
                        echo "&nbsp;&nbsp;&nbsp; ";
                      echo "<a href=\"mostraq.php?codigo=".$dados['Codigo']."\" target=\"questao\">Exibir questão</a> </td>";
                      //echo $dados['Questao'];
                        echo "<td>&nbsp;&nbsp;<input type=\"hidden\" name=\"codigo_questao\" value=\"".$dados['Codigo']."\">";
                        echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"".$codigo_prova."\">";
                        
                        if ($jaexiste==0) {
                        echo "<input type=\"submit\" name=\"incluir\" value=\"Incluir\"></td></tr></table>";
                        }
                        else
                            {
                        echo "<input type=\"submit\" name=\"excluir\" value=\"Remover\"></td></tr></table>";
                        }
                        echo "</form></p><hr>";
                    }
                      echo "</td><td width=\"800\">";
                      echo "<iframe name=\"questao\" width=799 height=1024 src=\"mostraq.php\"></iframe>";
                      echo "</td></tr></table>";
                    }
                    else
                    {
                    echo "erro!";
                    }
                    
    }
}
                       ?>
           

                 
 

            </div> <!-- #main -->
        </div> <!-- #main-container -->
</div>
</section>

        <?php
                  include 'footer.php';
    
        ?>  
        

        
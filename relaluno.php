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
                    

?>
<!-- end header -->
  <section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Relatórios</a><i class="icon-angle-right"></i></li>
          <li class="active">Relatório Geral</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">

<?php
  

               
  
  // Listagem por aluno
  
  
                    
  

             if (isset($_GET['codigo_prova']))
                {
                    $codigo_aluno=0;
                    $codigo_prova=$_GET['codigo_prova'];
                    $linha=1;
          
          $nq="select * from cadastro_provas where Codigo_prova='".$codigo_prova."'";
                    $lq=mysqli_query($con,$nq);
                    $nq=1;
                    while ($lqc=mysqli_fetch_array($lq))
                    {
                      echo "<center><table width=\"800\">
                      <caption><h2>".$lqc['Titulo']."</h2></caption>";
                      echo "<tr><td>Data do relatório:".date("d/m/y")."</td><td>&nbsp;&nbsp;&nbsp;</td>";
                      echo "<td>Código:".$codigo_prova."</td>";
                      echo "</tr>";
                        
                    }
                  echo "</table><br><br></center>";
                  echo "<center><table border=1";
                  echo "<caption><h2>Desempenho dos alunos</h2></caption>";
                  echo "<tr>
                      <td>&nbsp;Cód.&nbsp;</td>
                      <td>&nbsp;RA&nbsp;</td>
                      <td width=\"200\">&nbsp;Nome do Aluno&nbsp;</td>";
                  
                  echo "<td>Desempenho</td><td></td><td>Pontos</td><td>%</td></tr>";
                    
                    
                  
                  
                    $lista="select DISTINCT Aluno from gabaritos where Prova='".$codigo_prova."'";
                    $l=mysqli_query($con,$lista);
                    while ($lc=mysqli_fetch_array($l))
                    {
                        $codigo_aluno=$lc['Aluno'];
                        //echo $codigo_aluno;
                    
                    
                    
                    
                    $temp="select * from cadastro_alunos where Codigo=".$codigo_aluno;
                    $temp2=mysqli_query($con,$temp);
                    
                    while ($temp3=mysqli_fetch_array($temp2))
                    {
                        $nome_aluno=$temp3['Nome'];
                        $ra_aluno=$temp3['RA'];
                    }
                    echo "<tr>
                      <td>&nbsp;<a href=\"verifprv.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."\" target=\"blank\">$codigo_aluno</a>&nbsp;</td>
                      <td>&nbsp;<a href=\"verifprv.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."\" target=\"blank\">$ra_aluno</a>&nbsp;</td>
                      <td>&nbsp;<a href=\"verifprv.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."\" target=\"blank\">$nome_aluno</a>&nbsp;</td>";
                    
                                   
                    $total_questoes=0;
                    $pontos=0;
                    
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    // echo "<table>";
                    //echo "<tr><td><h4>Questão</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta do Aluno</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta Correta</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Situação</h4></td></tr>";
                    while ($dados=mysqli_fetch_array($data))
                    {
                       $matriz[$linha][$total_questoes]=0;
                       if ($dados['Resposta_Aluno']==$dados['Resposta_Correta'])
                        {  
                          //echo "<td bgcolor=\"lightgreen\">&nbsp;";
                          //echo $dados['Resposta_Aluno'];
                          //echo "&nbsp;</td>";
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes]=1;
                        }
                        else
                        {
                          // echo "<td>&nbsp;";
                          // echo $dados['Resposta_Aluno'];
                          //echo "&nbsp;</td>";
                        }
                       
                     
                       
                        //echo "</h4></td></tr>";
                       $total_questoes=$total_questoes+1;
                      
                    }
                    
                      echo "<td width=\"800\"><div class=\"progress\">
              <div class=\"progress-bar progress-bar-info progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"20\" aria-valuemin=\"0\" aria-valuemax=\"100\" 
                        style=\"width: ".round ($pontos/($total_questoes)*100,1)."%\">";
                echo round ($pontos/($total_questoes)*100,1)."%";
                      echo "
              </div>
            </div></td><td>";
                     
                    $linha=$linha+1; 
                    echo "</td>";
                    echo "<td>&nbsp;&nbsp;";
                      echo round ($pontos/($total_questoes)*10,2);
                      echo "&nbsp;</td>";
                      echo "<td>&nbsp;&nbsp;";
                      echo round ($pontos/($total_questoes)*100,1);
                      echo "%";
                      echo "&nbsp;</td>";
                    
                    echo "</tr>";
                      
                    
                   
                    }
                    
                 
                  
                  
                  
                  
                   
                }
  echo "</table></center>";

  
}

  
?>
 
</section>
<?php include 'footer.php'; ?>
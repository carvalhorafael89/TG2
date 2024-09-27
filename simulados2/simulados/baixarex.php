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
          <li class="active">Relatório Geral para Excel</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">

<?php
  $f = fopen("rel_geral.xls","w");
  if (!$f){
echo "Erro ao abrir a URL.<br>";
exit;
} else{

                if (isset($_GET['codigo_prova']))
                {
                    $codigo_aluno=0;
                    $codigo_prova=$_GET['codigo_prova'];
                    $linha=1;
                  
                    
                  fputs ($f, "</table><br><br></center>");
                  fputs ($f, "<center><table border=1>");
                  fputs ($f, "<caption><h2>PLANILHA GERAL</h2></caption>");
                  fputs ($f, "<tr>
                       <td>&nbsp;Cód.&nbsp;</td>
                      <td>&nbsp;RA&nbsp;</td>
                      <td width=\"200\">&nbsp;Nome do Aluno&nbsp;</td>");
                  
                  $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lq=mysqli_query($con,$nq);
                    $nq=1;
                    while ($lqc=mysqli_fetch_array($lq))
                    {
                      fputs ($f, "<td>$nq</td>");
                      $nq=$nq+1;
                    }
                  fputs ($f, "<td></td><td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>");
                  fputs ($f, "</tr>");
                  
                  fputs ($f, "<tr>
                      <td> </td>
                      <td> </td>
                      <td>&nbsp;Gabarito:&nbsp;</td>");
                  
                    $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lqa=mysqli_query($con,$nq);
                    
                    while ($lqc=mysqli_fetch_array($lqa))
                    {
                      $tempn=$lqc['Questao'];
                      $qcor="select * from cadastro_questoes where Codigo='".$tempn."'";
                      $lqcor=mysqli_query($con,$qcor);
                 
                      while ($wlqcor=mysqli_fetch_array($lqcor))
                      {
                        fputs ($f, "<td bgcolor=\"yellow\">&nbsp;<b>".$wlqcor['Correta']."</b>&nbsp;</td>");
                        
                      }
                    }
                  fputs ($f, "<td></td><td></td><td></td><td></td>");
                  fputs ($f, "</tr>");
                    
                    
                  
                  
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
                    fputs ($f, "<tr>
                      <td>&nbsp;$codigo_aluno&nbsp;</td>
                      <td>&nbsp;$ra_aluno&nbsp;</td>
                      <td>&nbsp;$nome_aluno&nbsp;</td>");
                    
                                   
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
                          fputs ($f, "<td bgcolor=\"lightgreen\">&nbsp;");
                          fputs ($f, $dados['Resposta_Aluno']);
                          fputs ($f, "&nbsp;</td>");
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes]=1;
                        }
                        else
                        {
                            fputs ($f, "<td>&nbsp;");
                            fputs ($f, $dados['Resposta_Aluno']);
                            fputs ($f, "&nbsp;</td>");
                        }
                       
                     
                       
                        //echo "</h4></td></tr>";
                       $total_questoes=$total_questoes+1;
                      
                    }
                    
                      fputs ($f, "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>");
                    fputs ($f, $pontos); 
                    $linha=$linha+1; 
                     fputs ($f, "</td>");
                     fputs ($f, "<td>&nbsp;&nbsp;");
                       fputs ($f, round ($pontos/($total_questoes)*10,2));
                       fputs ($f, "&nbsp;</td>");
                       fputs ($f, "<td>&nbsp;&nbsp;");
                       fputs ($f, round ($pontos/($total_questoes)*100,1));
                       fputs ($f, "%");
                       fputs ($f, "&nbsp;</td>");
                    
                     fputs ($f, "</tr>");
                      
                    
                   
                    }
                    
                  /* echo "<tr><td>&nbsp;</td><td>&nbsp</td><td>Questão:</td>";
                    $i=0;
                  do {
                    echo "<td>";
                    
                    echo $i+1;
                    echo "</td>";
                  } while ($i++<=$total_questoes-2);
                     echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
               
                  echo "</tr>"; */
                  
                   fputs ($f, "<tr><td>&nbsp;</td><td width=\"10\">&nbsp</td><td>&nbsp;Acertos:&nbsp;</td>");
                    $i=0;
                  do {
                     fputs ($f, "<td>&nbsp;");
                    $j=1;
                    $somamatriz=0;
                    do {
                     $somamatriz=$somamatriz+$matriz[$j][$i];
                    } while($j++<=$linha);
                    
                   fputs ($f, $somamatriz);
                     fputs ($f, "&nbsp;</td>");
                  } while ($i++<=$total_questoes-2);
                  
                   fputs ($f, "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>");
                   fputs ($f, "</tr>");
                  
                  
                   fputs ($f, "<tr><td>&nbsp;</td><td>&nbsp</td><td>&nbsp;%Acertos:&nbsp;</td>");
                    $i=0;
                  do {
                     fputs ($f, "<td>&nbsp;");
                    $j=1;
                    $somamatriz=0;
                    do {
                     $somamatriz=$somamatriz+$matriz[$j][$i];
                    } while($j++<=$linha);
                    
                     fputs ($f, round($somamatriz/($linha-1)*100,0));
                     fputs ($f, "%");
                     fputs ($f, "&nbsp;</td>");
                  } while ($i++<=$total_questoes-2);
                   fputs ($f, "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>");
               
                   fputs ($f, "</tr>");
                  
                  
                  
                  
                   
                }
   fputs ($f, "</table>");
   fclose($f);
  echo "<center><h2>Para baixar o relatório, clique <a href=\"rel_geral.xls\">aqui</a>.</h2></center>";
}
}            

else
{
    $voltar="login.php";
    header("Location: $voltar");
}
  
  
  
  
 
?>
 
</section>
<?php include 'footer.php'; ?>
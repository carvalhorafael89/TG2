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
          <li class="active">Relatório por disciplinas</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">

<?php
  

               
  
  // Por disciplina
  if (isset($_COOKIE['Nivel']))
{
    
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
    $codigo_aluno=$codigo;
                    

    if (isset($_GET['codigo_prova']))
                {
          
                  
                  
                    $codigo_aluno=0;
                    $codigo_prova=$_GET['codigo_prova'];
          
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
                    $qdis=1;
                    $disciplinas[0]="";
                    $questdis[0]=0;
                    $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lqa=mysqli_query($con,$nq);
                    
                    while ($lqc=mysqli_fetch_array($lqa))
                    {
                      $tempn=$lqc['Questao'];
                      
                      $qcor="select * from cadastro_questoes where Codigo='".$tempn."'";
                      $lqcor=mysqli_query($con,$qcor);
                 
                      while ($wlqcor=mysqli_fetch_array($lqcor))
                      { 
                        
                        $disciplinas[$qdis]=$wlqcor['Disciplina'];  
                        
                         
                      }
                     $questdis[$qdis]= $tempn;
                     $qdis=$qdis+1;
                    }
                      
                  
                  
                  
                  /*   $o=1;
                        do {
                          echo $questdis[$o]." ".$disciplinas[$o]; 
                              
                          
                } while ($o++<=$qdis); */
                  
                  
                  $tempdisc=array_unique($disciplinas);
                  //print_r($tempdisc);
                  $contdisc=0;
                  foreach ($tempdisc as $value) {
                    
                    $nomesdisciplinas[$contdisc]=$value;
                      $contdisc++;
                  } 
                  
                  /* print_r($nomesdisciplinas);
                   $o=0;
                  do {
                    echo $nomesdisciplinas[$o];
                    echo "<br>";
                  } while($o++<=$contdisc);
                  */
                  $contdisc=0;
                  foreach ($nomesdisciplinas as $value) {
                   
                    if ($value=="" || $value==NULL)
                    {
                      continue;
                    }
                    
                  
                  $linha=1;
                  echo "<center><br><table border=1>";
                    echo "<caption><h2>$value</h2></caption>";
                  echo "<tr>
                      <td>&nbsp;Cód.&nbsp;</td>
                      <td>&nbsp;RA&nbsp;</td>
                      <td width=\"200\">&nbsp;Nome do Aluno&nbsp;</td>";
                  
                    $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lq=mysqli_query($con,$nq);
                    $nq=1;
                    $contdisc=1;
                    while ($lqc=mysqli_fetch_array($lq))
                    {
                      if ($value==$disciplinas[$nq]){
                      
                        echo "<td>$nq</td>"; }
                      $nq=$nq+1;
                    }
                  echo "<td></td><td>&nbsp;Acertos&nbsp;</td><td>Nota</td><td>&nbsp;%Acertos&nbsp;</td>";
                  echo "</tr>";
                  
                  echo "<tr>
                      <td> </td>
                      <td> </td>
                      <td>&nbsp;Gabarito:&nbsp;</td>";
                  
                    $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lqa=mysqli_query($con,$nq);
                    $nq=1;
                    while ($lqc=mysqli_fetch_array($lqa))
                    {
                      $tempn=$lqc['Questao'];
                      $qcor="select * from cadastro_questoes where Codigo='".$tempn."'";
                      $lqcor=mysqli_query($con,$qcor);
                      
                 
                      while ($wlqcor=mysqli_fetch_array($lqcor))
                      {
                        if ($disciplinas[$nq]==$value && $questdis[$nq]==$tempn){
                          echo "<td bgcolor=\"yellow\">&nbsp;<b>".$wlqcor['Correta']."</b>&nbsp;</td>"; }
                        
                      }
                      $nq=$nq+1;
                    }
                  echo "<td></td><td></td><td></td><td></td>";
                  echo "</tr>";
                    
                    
                  
                  
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
                      <td>&nbsp;$codigo_aluno&nbsp;</td>
                      <td>&nbsp;$ra_aluno&nbsp;</td>
                      <td>&nbsp;$nome_aluno&nbsp;</td>";
                    
                                   
                    $total_questoes=0;
                      $totdisto=0;
                    $pontos=0;
                      $pdisto=0;
                    
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    // echo "<table>";
                    //echo "<tr><td><h4>Questão</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta do Aluno</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta Correta</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Situação</h4></td></tr>";
                    $nq=1;
                      while ($dados=mysqli_fetch_array($data))
                    {
                       $matriz[$linha][$total_questoes]=0;
                      
                       if ($dados['Resposta_Aluno']==$dados['Resposta_Correta'])
                        {  
                           if ($disciplinas[$nq]==$value && $questdis[$nq]==$dados['Questao']){
                          echo "<td bgcolor=\"lightblue\">&nbsp;";
                          echo $dados['Resposta_Aluno'];
                             echo "&nbsp;</td>";
                          
                           $pdisto=$pdisto+1;}
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes]=1;
                        }
                        else
                        {
                            
                           if ($disciplinas[$nq]==$value && $questdis[$nq]==$dados['Questao']){
                             echo "<td>&nbsp;";
                            echo $dados['Resposta_Aluno'];
                             echo "&nbsp;</td>";}
                        }
                        if ($disciplinas[$nq]==$value && $questdis[$nq]==$dados['Questao']){
                        $totdisto=$totdisto+1;
                        }
                       
                        //echo "</h4></td></tr>";
                       $total_questoes=$total_questoes+1;
                       $nq=$nq+1;
                      
                    }
                    
                      echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
                    echo $pdisto; 
                      
                    $linha=$linha+1; 
                    echo "</td>";
                    echo "<td>&nbsp;&nbsp;";
                      if ($totdisto>0) {
                      echo round ($pdisto/($totdisto)*10,2);
                      echo "&nbsp;</td>";
                      echo "<td>&nbsp;&nbsp;";
                      echo round ($pdisto/($totdisto)*100,1);
                      echo "%";
                      echo "&nbsp;</td>"; }
                    else{
                      echo "0";
                      echo "&nbsp;</td>";
                      echo "<td>&nbsp;&nbsp;";
                      echo "0";
                      echo "%";
                      echo "&nbsp;</td>";
                    }
                    
                    echo "</tr>";
                      
                    
                   
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
                  
                  echo "<tr><td>&nbsp;</td><td width=\"10\">&nbsp</td><td>&nbsp;Acertos:&nbsp;</td>";
                    $i=0;
                  do {
                    
                    $j=1;
                    $somamatriz=0;
                    do {
                     $somamatriz=$somamatriz+$matriz[$j][$i];
                    } while($j++<=$linha);
                    
                  if ($value==$disciplinas[$i]){
                    echo "<td>&nbsp;";
                    echo $somamatriz;
                    echo "&nbsp;</td>"; }
                  } while ($i++<=$total_questoes-2);
                  
                  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
                  echo "</tr>";
                  
                  
                  echo "<tr><td>&nbsp;</td><td>&nbsp</td><td>&nbsp;%Acertos:&nbsp;</td>";
                    $i=0;
                  do {
                    
                    $j=1;
                    $somamatriz=0;
                    do {
                     $somamatriz=$somamatriz+$matriz[$j][$i];
                    } while($j++<=$linha);
                    if ($value==$disciplinas[$i]){
                    echo "<td>&nbsp;";
                    echo round($somamatriz/($linha-1)*100,0);
                    echo "%";
                    echo "&nbsp;</td>"; }
                  } while ($i++<=$total_questoes-2);
                  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
               
                  echo "</tr>";
                  
                  
                  
                  
                   
                }
  echo "</table></center><br><br>";
                } // fecha o for da disciplina
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
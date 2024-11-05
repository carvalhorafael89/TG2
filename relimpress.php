<?php
if (!isset($_COOKIE['Nivel']))
{
    
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
}  
// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';

include 'cabecalho.php';


?>

<?php
  // Verifica e o usuário realizou o LogIN e o nível de acesso do mesmo.
  
  if (isset($_COOKIE['Nivel']))
  {
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
                
  }
else
{
    $nivel ="Visitante";
    
}
    
echo '
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
       
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Sistema para a realização de simulados e provas on-lineplate" />
        <title>Sistema para a realização de simulados e provas on-line</title>
        <meta name="author" content="Renato Luiz Cardoso, professor" />
        
        <!-- css -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="plugins/flexslider/flexslider.css" rel="stylesheet" media="screen" />  
        <link href="css/cubeportfolio.min.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <!-- Theme skin -->
        <link id="t-colors" href="skins/default.css" rel="stylesheet" />

        <!-- boxed bg -->
        <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
  
  
        <!-- O bloco a seguir corrige uma falha de bullet no template/design. Não remover -->
  
        <style type"text/css">
            <!--
                li {  list-style: none; }
                ul {  list-style: none; }
            -->
        </style>
 

    </head>
    <body>';

if (isset($_COOKIE['Nivel']))
{
    
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
    $codigo_aluno=$codigo;
                    

?>
<!-- 
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
-->

<?php
  

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
                      echo "<center><table border=1 width=\"800\" style=\"page-break-after: always\">
                      <caption><h2>".$lqc['Titulo']."</h2><br>Data do relatório:";
                      date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário
                      echo date("d/m/y")." ";
                      echo "Código:".$codigo_prova;
                      echo "<br>";
                        
                    }
                  
                  echo "<h2>PLANILHA GERAL</h2></caption>";
                  echo "<tr>
                      <td>&nbsp;Cód.&nbsp;</td>
                      <td>&nbsp;RA&nbsp;</td>
                      <td width=\"200\">&nbsp;Nome do Aluno&nbsp;</td>";
                  
                  $nq="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                    $lq=mysqli_query($con,$nq);
                    $nq=1;
                    while ($lqc=mysqli_fetch_array($lq))
                    {
                      echo "<td>$nq</td>";
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
                    
                    while ($lqc=mysqli_fetch_array($lqa))
                    {
                      $tempn=$lqc['Questao'];
                      $qcor="select * from cadastro_questoes where Codigo='".$tempn."'";
                      $lqcor=mysqli_query($con,$qcor);
                 
                      while ($wlqcor=mysqli_fetch_array($lqcor))
                      {
                        echo "<td bgcolor=\"yellow\">&nbsp;<b>".$wlqcor['Correta']."</b>&nbsp;</td>";
                        
                      }
                    }
                  echo "<td></td><td></td><td></td><td></td>";
                  echo "</tr>";
                    
                    
                  
                  
                    $lista="select DISTINCT Aluno from gabaritos where codprova='".$codigo_prova."'";
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
                    $pontos=0;
                    
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and codprova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    // echo "<table>";
                    //echo "<tr><td><h4>Questão</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta do Aluno</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta Correta</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Situação</h4></td></tr>";
                    while ($dados=mysqli_fetch_array($data))
                    {
                       $matriz[$linha][$total_questoes]=0;
                       if ($dados['Resposta_Aluno']==$dados['Resposta_Correta'])
                        {  
                          echo "<td bgcolor=\"lightgreen\">&nbsp;<b>";
                          echo $dados['Resposta_Aluno'];
                          echo "</b>&nbsp;</td>";
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes]=1;
                        }
                        else
                        {
                          
                          if ($dados['Resposta_Aluno'] == 'Z' || empty($dados['Resposta_Aluno'])) {
                            echo "<td bgcolor=\"#f8d7da\"><b>";
                            echo "";
                            echo "</td>";
                        } else {
                          echo "<td bgcolor=\"#f8d7da\"><b>";
                          echo $dados['Resposta_Aluno']; // Exibe a resposta do aluno normalmente
                          echo "</td>";
                        }
                        }
                       
                     
                       
                        //echo "</h4></td></tr>";
                       $total_questoes=$total_questoes+1;
                      
                    }
                    
                      echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
                    echo $pontos; 
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
                    echo "<td>&nbsp;";
                    $j=1;
                    $somamatriz=0;
                    do {
                      $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 0;
                    } while($j++<=$linha);
                    
                  echo $somamatriz;
                    echo "  &nbsp;</td>";
                  } while ($i++<=$total_questoes-2);
                  
                  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
                  echo "</tr>";
                  
                  
                  echo "<tr><td>&nbsp;</td><td>&nbsp</td><td>&nbsp;%Acertos:&nbsp;</td>";
                    $i=0;
                  do {
                    echo "<td>&nbsp;";
                    $j=1;
                    $somamatriz=0;
                    do {
                      $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 0;
                    } while($j++<=$linha);
                    
                    echo round($somamatriz/($linha-1)*100,0);
                    echo "%";
                    echo "&nbsp;</td>";
                  } while ($i++<=$total_questoes-2);
                  echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td></td><td>&nbsp</td>";
               
                  echo "</tr>";
                  
                  
                  
                  
                   
                }
  echo "</table></center>";
}
                

else
{
    $voltar="login.php";
    header("Location: $voltar");
}
  
  
  
  
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
                  echo "<center><br><table border=1 style=\"page-break-after: always\">";
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
                    
                    
                  
                  
                    $lista="select DISTINCT Aluno from gabaritos where codprova='".$codigo_prova."'";
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
                    
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and codprova='".$codigo_prova."'";
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
                          echo "<td bgcolor=\"lightblue\">&nbsp;<b>";
                          echo $dados['Resposta_Aluno'];
                             echo "</b>&nbsp;</td>";
                          
                           $pdisto=$pdisto+1;}
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 1;
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
                      $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 0;
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
                      $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 0;
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
                

else
{
    $voltar="login.php";
    header("Location: $voltar");
}
  
  
  ///////////////////////////////////////////  
  
  
  
  // Listagem por aluno
  
  
                    
  

             if (isset($_GET['codigo_prova']))
                {
                    $codigo_aluno=0;
                    $codigo_prova=$_GET['codigo_prova'];
                    $linha=1;
                  echo "<center><table border=1 style=\"page-break-after: always\">";
                  echo "<caption><h2>Desempenho dos alunos</h2></caption>";
                  echo "<tr>
                      <td>&nbsp;Cód.&nbsp;</td>
                      <td>&nbsp;RA&nbsp;</td>
                      <td width=\"200\">&nbsp;Nome do Aluno&nbsp;</td>";
                  
                  echo "<td>Desempenho</td><td></td><td>Pontos</td><td>%</td></tr>";
                    
                    
                  
                  
                    $lista="select DISTINCT Aluno from gabaritos where codprova='".$codigo_prova."'";
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
                    $pontos=0;
                    
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and codprova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    // echo "<table>";
                    //echo "<tr><td><h4>Questão</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta do Aluno</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Resposta Correta</h4></td><td>&nbsp;&nbsp;&nbsp;</td><td><h4>Situação</h4></td></tr>";
                    while ($dados=mysqli_fetch_array($data))
                    {
                      $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 0;
                       if ($dados['Resposta_Aluno']==$dados['Resposta_Correta'])
                        {  
                          //echo "<td bgcolor=\"lightgreen\">&nbsp;";
                          //echo $dados['Resposta_Aluno'];
                          //echo "&nbsp;</td>";
                          //echo $dados['Resposta_Correta'];
                         
                            $pontos=$pontos+1;
                            $matriz[$linha][$total_questoes] = isset($matriz[$linha][$total_questoes]) ? $matriz[$linha][$total_questoes] : 1;
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

  
  

  
?>
 
</section>
<!-- Botão de impressão -->
<div style="text-align: center; margin: 20px;">
    <button onclick="window.print()" class="btn btn-primary">Imprimir</button>
</div>

<?php // include 'footer.php'; ?>

</body>
</html>
<?php include 'footer.php'; ?>
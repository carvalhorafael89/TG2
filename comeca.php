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
          <li><a href="index.php">Alunos</a><i class="icon-angle-right"></i></li>
          <li class="active">Realizar Prova/Simulados</li>
        </ul>
      </div>
    </div>
  </div>
  </section>
        
<section id="content">
<div class="container">
<div class="row">
  <div class="col-lg-12">
        
    <?php

                if (isset($_GET['codigo_prova']))
                {
                    if (isset($_GET['codigo_aluno']))  
                    {
                    $codigo_prova=$_GET['codigo_prova'];
                    $codigo_aluno=$_GET['codigo_aluno'];
                    if (isset($_GET['numero']))
                    {
                        $numero=$_GET['numero'];
                        
                    }
                    else
                    {
                        $numero=1;
                    }
                 
                    $total_questoes=0;
                    $sql="SELECT * from gabaritos where Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                    $data=mysqli_query($con,$sql);
                    while ($dados=mysqli_fetch_array($data))
                    {
                        $total_questoes=$total_questoes+1;
                    }
                    
                    
                    if ($numero>$total_questoes)
                    {
                        $numero=$total_questoes;
                    }
                    if ($numero<1)
                    {
                        $numero=1;
                    }

                    $sql="select * from gabaritos where Numero='".$numero."' and Aluno='".$codigo_aluno."' and Prova='".$codigo_prova."'";
                    $r=mysqli_query($con,$sql);
                    echo "<h2><small>Questão $numero de $total_questoes</small></h2>";
                    echo "<form role=\"form\" class=\"register-form\" method=\"POST\" action=\"pquest.php\">";
                    $qatual=$numero;
                    $jarespondida=0;
                    while ($dados=mysqli_fetch_array($r))
                    {
                        $resposta=$dados['Resposta_Aluno'];
                        $jarespondida=0;
                        if ($resposta!='Z')
                        {
                            echo "<h3><small><font color=red>Resposta gravada.</font></small></h3>";
                            $jarespondida=1;
                        }
                        $finalizado=$dados['Finalizado'];
                        $rcorreta=$dados['Resposta_Correta'];
                        $bqsql="select * from cadastro_questoes where Codigo='".$dados['Questao']."'";
                        //echo $bqsql;
                        
                        
                        
                        $resp1=mysqli_query($con,$bqsql);
                        
                        
                        
                        
                        while ($bqdados=mysqli_fetch_array($resp1))
                        {
                            // Exibe a disciplina
                            
                            echo "<h3><small>Esta questão refere-se à disciplina: ".$bqdados['Disciplina']."</small></h3>";
                            echo "<br>";
                          
                            // Mostra o texto da questão
                            echo "<h3><small>".$bqdados['Questao']."</small></h3>";
                            echo "<br>";
                            
                            if ($bqdados['Figura']=='' || $bqdados['Figura']=='figuras/') {
                               }
                             else
                            {
                              // Exibe a figura
                              echo "<a href=\"".$bqdados['Figura']."\" targer=\"BLANK\" border=0><img src=\"".$bqdados['Figura']."\" width=\"800\"></a>";
                          
                              echo "<br><small>Clique na figura para ver no tamanho original.</small><br>"; }
                          
                            
                          // Alternativa A
                            echo "<br>";                            
                            echo "<table><tr><td>";
                            echo "<h4><input type=\"radio\" name=\"resposta\" value=\"A\" ";
                            if ($resposta=='A') {  echo " checked>"; } else { echo ">"; }
                            
                            echo " A </h4>";
                            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                            if($finalizado=="Sim" && $rcorreta=='A') { echo '<font color="red" >'; } else { 
                              if ($resposta=='A') { echo '<font color="green" >'; }
                              else { echo '<font color="black">';  }
                            }
                            echo $bqdados['RespostaA'];
                            echo '</font>';
                            echo "</small></h4></td></tr></table>";
                            
                          
                          // Alternativa B
                            echo "<table><tr><td>";
                            echo "<h4><input type=\"radio\" name=\"resposta\" value=\"B\" ";
                            if ($resposta=='B') {  echo " checked>"; } else { echo ">"; }
                            
                            echo " B </h4>";
                            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                            if($finalizado=="Sim" && $rcorreta=='B') { echo '<font color="red" >'; } else { 
                            if ($resposta=='B') { echo '<font color="green" >'; }
                              else { echo '<font color="black">';  }
                            }
                            echo $bqdados['RespostaB'];
                            echo '</font>';
                            echo "</small></h4></td></tr></table>";
                            
                          
                          // Alternativa C
                            echo "<table><tr><td>";
                            echo "<h4><input type=\"radio\" name=\"resposta\" value=\"C\" ";
                            if ($resposta=='C') {  echo " checked>"; } else { echo ">"; }
                            
                            echo " C </h4>";
                            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                           if($finalizado=="Sim" && $rcorreta=='C') { echo '<font color="red" >'; } else { 
                           if ($resposta=='C') { echo '<font color="green" >'; }
                              else { echo '<font color="black">';  }
                           }
                            echo $bqdados['RespostaC'];
                            echo '</font>';
                            echo "</small></h4></td></tr></table>";
                            
                          
                          // Alternativa D
                            echo "<table><tr><td>";
                            echo "<h4><input type=\"radio\" name=\"resposta\" value=\"D\" ";
                            if ($resposta=='D') {  echo " checked>"; } else { echo ">"; }
                            
                            echo " D </h4>";
                            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                            if($finalizado=="Sim" && $rcorreta=='D') { echo '<font color="red" >'; } else {  
                              if ($resposta=='D') { echo '<font color="green" >'; }
                              else { echo '<font color="black">';  }
                            }
                            echo $bqdados['RespostaD'];
                            echo '</font>';
                            echo "</small></h4></td></tr></table>";
                            
                            
                          // Alternativa E
                            echo "<table><tr><td>";
                            echo "<h4><input type=\"radio\" name=\"resposta\" value=\"E\" ";
                            if ($resposta=='E') {  echo " checked>"; } else { echo ">"; }
                            
                            echo " E </h4>";
                            echo "</td><td>&nbsp;&nbsp;&nbsp;&nbsp;<td><h4><small>";
                            if($finalizado=="Sim" && $rcorreta=='E') { echo '<font color="red" >'; } else { 
                            if ($resposta=='E') { echo '<font color="green" >'; }
                              else { echo '<font color="black">';  }
                            }
                            echo $bqdados['RespostaE'];
                            echo '</font>';
                            echo "</small></h4></td></tr></table>";
                            
                            echo "<br>";                              
                        }
                        
                    }
                      
                    // Campos ocultos
                    echo "<input type=\"hidden\" name=\"codigo_prova\" value=\"".$codigo_prova."\">";
                    echo "<input type=\"hidden\" name=\"codigo_aluno\" value=\"".$codigo_aluno."\">";
                    echo "<input type=\"hidden\" name=\"numero\" value=\"".$numero."\">";
                    
                    // Gera botão para gravar a resposta
                    if ($finalizado!='Sim') {
                    echo '
                        
                       <input type="submit" value="Gravar Resposta">
        
                        
                        ';
                    }
                    echo "</form>";
                    echo "<br><br>";
                      
                    echo "<h4><small>
                    <table><tr>";
                    $anterior=1;
                    echo "<td><center><a href=comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$anterior." border=0>
                      [ Primeira questão ]</a>&nbsp;&nbsp;</center></td>";
                    $anterior=$numero-1;
                    if ($anterior>=1)
                    {
                        
                        echo "<td><center><a href=comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$anterior." border=0>
                          [ Questão Anterior ]</a>&nbsp;&nbsp;</center></td>";
                    }
                      echo "</tr></table>";
                      echo "<br><table><tr><td width=800>";
                      $anterior=1;
                      do {
                          echo "&nbsp;<a href=comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$anterior." border=0>";
                        
                        //if ($jarespondida==0) { echo "<font color=\"red\">"; } else { echo "<font color=\"green\">"; }
                        
                          if ($qatual==$anterior) { echo "[$anterior]"; }  else{ echo "$anterior";}
                        if ($anterior%35==0) { echo "<br>"; }
                          echo "&nbsp;</a>"; 
                         } while ($anterior++<=$total_questoes-1);
                        
                      echo "</td></tr></table>";
                      
                      echo "<table><tr>";
                    $posterior=$numero+1;
                    if ($posterior<=$total_questoes)
                    {
                        echo "<td><center><a href=comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$posterior." border=0 >
                          [ Próxima Questão ]</a>&nbsp;&nbsp;</center></td>";
                    }
                      
                    $posterior=$total_questoes;
                     echo "<td><center><a href=comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$posterior." border=0 >
                          [ Última Questão ]</a>&nbsp;&nbsp;</center></td>";
                   
                    echo "</tr></table></small></h4>";
                    echo "<br>";
                      
                    echo "<center><table width=\"800\"><tr>";
                    if ($finalizado=='Sim')
                    {
                    
                    echo "<td><center><a href=verifprv.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno." border=0 >
                      <img src=\"verificar.png\" width=\"32\"><br>Verificar Resultados</a></center></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Ao verificar os resultados, seu gabarito será mostrado a você, assim como, sua nota.</td>";
                     
                    }
                    else
                    {
                      if ($numero==$total_questoes) {
                        echo "<td><center><a href=finalprv.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno." border=0 >
                          <img src=\"verificar.png\" width=\"32\"><br>Finaliza Prova</a></center></td>
                          <td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td><b>Atenção:</b> Após concluir a prova, clique em finalizar a prova. Esta operação não pderá ser desfeita";
                        echo "Somente clique neste link se você tiver certeza de que a completou a prova e não deseja mais nenhuma alteração.</td>";
                      }
                    }
                      echo "</tr></table></center>";
                    }
                }
}        

else
{
    $voltar="login.php";
    header("Location: $voltar");
}
?>
  </div>
</div>
</div>
</section>
<?php include 'footer.php'; ?>

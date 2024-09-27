<?php

// Ativa o bloco que conecta ao banco de dados
require_once 'conecta.php';


if (isset($_COOKIE['Nivel']))
{
    
    $nivel =$_COOKIE['Nivel'];
    $nome  =$_COOKIE['Nome'];
    $Email =$_COOKIE['Email'];
    $codigo=$_COOKIE['Codigo'];
    $codigo_aluno=$codigo;
                    

?>

    <?php

                if (isset($_GET['codigo']))
                {
            $codquestao=$_GET['codigo'];

                        $bqsql="select * from cadastro_questoes where Codigo='".$codquestao."'";
                        $resp1=mysqli_query($con,$bqsql);
                        
                        while ($bqdados=mysqli_fetch_array($resp1))
                        {
                            // Exibe a disciplina
                            
                            echo "<p><small>Esta questão refere-se à disciplina: ".$bqdados['Disciplina']."</small></p>";
                            echo "<br>";
                          
                            // Mostra o texto da questão
                            echo "<p><small>".$bqdados['Questao']."</small></p>";
                            echo "<br>";
                            
                            if ($bqdados['Figura']=='' || $bqdados['Figura']=='figuras/') {
                               }
                             else
                            {
                              // Exibe a figura
                              echo "<a href=\"".$bqdados['Figura']."\" targer=\"BLANK\" border=0><img src=\"".$bqdados['Figura']."\" width=\"800\"></a>";
                          
                              echo "<br><small>Clique na figura para ver no tamanho original.</small><br>"; }
                          
                            
                          
                            echo "<br> A - ";                            
                            echo $bqdados['RespostaA'];
                            
                            
                            echo "<br> B - ";                            
                            echo $bqdados['RespostaB'];
              
              
                            echo "<br> C - ";                            
                            echo $bqdados['RespostaC'];
                            
                            
                            echo "<br> D - ";                            
                            echo $bqdados['RespostaD'];
                          
              
                echo "<br> E - ";                            
                            echo $bqdados['RespostaE']; 
              
                            echo "<br>";                              
                        }
        }
}
  ?>
                        
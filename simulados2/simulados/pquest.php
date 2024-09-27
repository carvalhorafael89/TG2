<?php
if (!isset($_COOKIE['Nivel']))
{
    
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
}  
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header('Content-Type: text/html; charset=utf-8');
require_once 'conecta.php';


if (isset($_POST['codigo_prova']))
{
    if (isset($_POST['codigo_aluno']))
    {
        if (isset($_POST['numero']))
        {
        
            
                $codigo_prova=$_POST['codigo_prova'];
                $codigo_aluno=$_POST['codigo_aluno'];
                $numero=$_POST['numero'];
             if (isset($_POST['resposta']))
               {
                $resposta=$_POST['resposta'];
                }
          else
            {
              $resposta="Z";
              }
                $sql= "UPDATE gabaritos SET Resposta_Aluno='".$resposta."' WHERE Numero=".$numero." and Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                //echo $sql;
                
                   //echo $sql;
                   //mysqli_query($con, "insert into cursos (curso) values ('Eletr. Automotiva')");
                   mysqli_query($con, $sql);
                   
                   $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$numero;
                header("Location: $voltar");
                
            }
          else
          {
                $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$numero;
                header("Location: $voltar");
          }
        }
      else
          {
                $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$numero;
                header("Location: $voltar");
          }
        
    
    
    
    
}
  else
          {
                $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno."&numero=".$numero;
                header("Location: $voltar");
          }
?>
Processando gravação...
Sua conexão com a Internet apresenta-se muito lenta. Tente retornar para a página anterior e pressionar F5 (Atualizar)

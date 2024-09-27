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
                    $codigo_prova=$_POST['codigo_prova'];
                    $codigo=$_POST['codigo_questao'];
                                      
                   $sql= "delete from tabela_questoes where Codigo_Prova='".$codigo_prova."' and Questao=".$codigo." ";
                   //echo $sql;
                   //mysqli_query($con, "insert into cursos (curso) values ('Eletr. Automotiva')");
                   mysqli_query($con, $sql);
                   
                   $voltar="inccquestao.php?prova=".$codigo_prova;
                   header("Location: $voltar");
                   
                    
                }
                else
                {
                    echo "Erro!";
                }
                
                ?>
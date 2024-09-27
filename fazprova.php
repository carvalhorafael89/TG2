<?php

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
                    $codigo_prova=$_POST['codigo_prova'];
                    $codigo_aluno=$_POST['codigo_aluno'];
                    $sql="select * from gabaritos where Aluno=".$codigo_aluno." and Prova='".$codigo_prova."'";
                    //echo $sql;
                    $r=mysqli_query($con,$sql);
                    $existe=0;
                    while ($dados=mysqli_fetch_array($r))
                    {
                        $existe=1;
                        
                    }
                    if ($existe==0)
                    {
                        $sql="select * from tabela_questoes where Codigo_Prova='".$codigo_prova."'";
                        
                        $r=mysqli_query($con,$sql);
                        $numero=1;
                        while ($dados=mysqli_fetch_array($r))
                        {
                            $vsql="insert into gabaritos (Aluno, Prova, Questao, Resposta_Aluno, Resposta_Correta, Numero, Finalizado) values ('".$codigo_aluno."','".$codigo_prova."','".$dados['Questao']."'";
                            $qsql="select * from cadastro_questoes where codigo=".$dados['Questao'];
                            $qr=mysqli_query($con,$qsql);
                            $qdados=mysqli_fetch_array($qr);
                            $correta=$qdados['Correta'];
                            $vsql=$vsql.",'Z','".$correta."','".$numero."','Nao')";
                            mysqli_query($con, $vsql);
                            $numero=$numero+1;
                            
                        }    
                      
                         
                      
                        $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno;
                        header("Location: $voltar");
                    }
                    else
                    {
                        $voltar="comeca.php?codigo_prova=".$codigo_prova."&codigo_aluno=".$codigo_aluno;
                        header("Location: $voltar");
                    }
                    
                    
                    } // Fecha if
                    
                    
                    
                } // Fecha if
                
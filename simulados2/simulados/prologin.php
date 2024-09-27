<?php

require_once 'conecta.php';

// Realiza log-in e grava nível de acesso
// Se aluno ou professor
//
if(isset($_POST['email']))
{
    $email=$_POST['email'];
    $senha=$_POST['senha'];
    
    //echo $email;
    //echo $senha;
    
    $sql="select * from cadastro_alunos";
    $existe=0;
    $data=mysqli_query($con,$sql);
    while ($dados=mysqli_fetch_array($data))
       {
           if ($dados['EMail']==$email)
           {
            if ($dados['Senha']==$senha)
            {
                $nivel="Aluno";
                $nome=$dados['Nome'];
                $Email=$dados['EMail'];
                $codigo=$dados['Codigo'];
                setcookie ("Nivel","Aluno",time()+(3600*6));
                setcookie ("Nome",$nome,time()+(3600*6));
                setcookie ("Email",$email,time()+(3600*6));
                setcookie ("Codigo",$codigo,time()+(3600*6));
                $existe=1;
                $voltar="index.php";
                //header("Location: $voltar");
            }
            
        }
        
       }
    if ($existe==1)
    {
        $voltar="index.php";
        //echo "encontrei";
        header("Location: $voltar");
    }
    else
    {
    $sql="select * from cadastro_professor";
    $existe=0;
    $data=mysqli_query($con,$sql);
    while ($dados=mysqli_fetch_array($data))
       {
           if ($dados['Email']==$email)
           {
            if ($dados['Senha']==$senha)
            {
                $nivel="Professor";
                $nome=$dados['Nome'];
                $Email=$dados['Email'];
                $codigo=$dados['Codigo'];
                setcookie ("Nivel","Professor",time()+(3600*6));
                setcookie ("Nome",$nome,time()+(3600*6));
                setcookie ("Email",$email,time()+(3600*6));
                setcookie ("Codigo",$codigo,time()+(3600*6));
                $existe=1;
                $voltar="index.php";
                //header("Location: $voltar");
            }
            
            }
        
       }
       if ($existe==1)
        {
         $voltar="index.php";
         header("Location: $voltar");
        }
       
       
       
    }
    if ($existe==0) {
        $voltar="login.php?acesso=denied";
        header("Location: $voltar");
    }
}
?>
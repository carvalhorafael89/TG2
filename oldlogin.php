<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
 
<html>
    <meta charset="utf-8">
    <head>
        <title>Sistema para a realização de provas e simulados</title>
        <meta name="description" content="Sistema para a realização de provas e simulados">

    <style>
        <!--
        #login {
            width:480px;
            background-color:silver;
            
        }
        
        -->
    </style>
    </head>
    <body>
    <center>
        <div id="login">
            <form method="POST" action="prologin.php">
                
                <br>
                <br>
                <table>
                    <tr>
                        <td> Usuário (e-mail):</td>
                        <td><input type="text" name="usuario"></td>
                    </tr>
                    <tr>
                        <td> Senha:</td>
                        <td><input type="password" name="senha"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" name="enviar" value="Acessar"></td>
                    </tr>
                    <tr>
                        <td>Novo usuário</td>
                        <td>Esqueci minha senha</td>
                    </tr>
 
                </table>
               
            </form>
        </div>
    </center>
</html>
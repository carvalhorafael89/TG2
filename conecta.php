<?php
// Programa para a realização de simulados on-line
// Professor Renato Luiz Cardoso
// Set/2018
// Conexão com o banco de dados SIMULADOS

// Dados necessários para conexão
// renatocardoso.mysql.dbaas.com.br
  
$servidor="localhost";
$udb="root";
$senha="@bodieles89";
$bdados="tg2";

/*
  Define o número de segundos durante os quais é permitido a execução do script. 
  Se este limite é atingido, o script retorna um erro fatal.
  O limite padrão é de 30 segundos, ou se existir o valor definido o valor max_execution_time definido no php.ini. 
  Se seconds for definido como zero, não é imposto nenhum limite. 
  Quando utilizada, set_time_limit() reinicia o contador do limite do tempo a partir de zero. 
  Em outras palavras, se o limite for 30 segundos, e 25 segundos depois 
  do inicio da execução do script for utilizada a função com por exemplo, set_time_limit(20), 
  o script será executado por 45 segundos até acabar o tempo.
  
*/
  
set_time_limit(60);
  
// Criando a conexão com a base de dados
$con = mysqli_connect($servidor,$udb,$senha,$bdados);

// Define a acentuação/tabela de caracteres na origem dos dados
mysqli_query($con,"SET NAMES utf8");

// Caso ocorra um erro, emite uma mensagem de falha
if (mysqli_connect_errno()) {
  echo "Falha na conexão com o mySQL: " . mysqli_connect_error();
    }
    
 // FIM

echo "
<!--\n 
Programa para a realização de provas e simulados on-line\n
Desenvolvido pelo Professor Renato Luiz Cardoso\n
Licença Creative Commons, uso livre desde que mantido o este cabeçalho.
Set/2018\n
\n
-->\n";
?>































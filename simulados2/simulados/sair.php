<?php

// Realiza log-off 
//
setcookie ("Nivel","",time()-3600);
setcookie ("Nome","",time()-3600);
setcookie ("Email",$email,time()-3600);
setcookie ("Codigo",$codigo,time()-3600);

$voltar="index.php";;
header("Location: $voltar");
?>
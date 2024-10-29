<?php
session_start();

if (isset($_GET['modo'])) {
    if ($_GET['modo'] === 'aluno') {
        // Muda para o modo aluno
        $_SESSION['modo'] = 'aluno';
    } else {
        // Muda para o modo professor
        $_SESSION['modo'] = 'professor';
    }
}

// Redireciona de volta para a página principal
header("Location: index.php");
exit();
?>

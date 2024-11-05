<?php
session_start();

// Verifica se a solicitação é para mudar o modo ou desativá-lo
if (isset($_GET['modo'])) {
    if ($_GET['modo'] === 'aluno') {
        // Ativa o modo aluno
        $_SESSION['modo'] = 'aluno';
    } elseif ($_GET['modo'] === 'professor') {
        // Retorna ao modo professor
        $_SESSION['modo'] = 'professor';
    } elseif ($_GET['modo'] === 'sair_modo_aluno') {
        // Desativa o modo aluno antes de realizar o logout
        unset($_SESSION['modo']);
    }
}

// Redireciona de volta para a página principal ou para o logout
$redirect_url = isset($_GET['redirect']) && $_GET['redirect'] === 'logout' ? 'sair.php' : 'index.php';
header("Location: $redirect_url");
exit();
?>

<?php
// Verificar se a sessão já foi iniciada antes de chamar session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar se a solicitação é para sair do modo aluno
if (isset($_POST['sair_modo_aluno'])) {
    // Sair do modo aluno
    unset($_SESSION['modo']);
}

// Limpar cookies de login e finalizar a sessão
setcookie("Nivel", "", time() - 3600, "/");
setcookie("Nome", "", time() - 3600, "/");
setcookie("Email", "", time() - 3600, "/");
setcookie("Codigo", "", time() - 3600, "/");

session_destroy();

// Redirecionar para a página de login
header("Location: login.php");
exit();
?>

<?php

require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';
require 'mailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'conecta.php';
include 'cabecalho.php';

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    
    // Consulta no banco de dados para verificar o e-mail
    $sql = "SELECT * FROM cadastro_alunos WHERE EMail = '$email'";
    $data = mysqli_query($con, $sql);

    // Verifica se o e-mail existe
    if (mysqli_num_rows($data) > 0) {
        $dados = mysqli_fetch_array($data);
        $nome = $dados['Nome'];
        $Email = $dados['EMail'];
        $senha = $dados['Senha'];
        
        // Cria uma nova instância do PHPMailer
        $mail = new PHPMailer(true);
        
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP(); // Enviar via SMTP
            $mail->Host = 'smtp.gmail.com'; // Servidor SMTP do Gmail
            $mail->SMTPAuth = true; // Autenticação habilitada
            $mail->Username = 'phpmailercarvalho@gmail.com'; // Usuário SMTP (e-mail do remetente)
            $mail->Password = 'dluw tvlv hvwb ckji'; // Senha SMTP criado pelo Google mail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS para criptografia
            $mail->Port = 587; // Porta TCP

            // Remetente
            $mail->setFrom('phpmailercarvalho@gmail.com', 'Suporte ENADE FATEC ITU');
            // Destinatário
            $mail->addAddress($Email, $nome);

            // Conteúdo do e-mail
            $mail->isHTML(true); // Define que o e-mail será enviado em formato HTML
            $mail->Subject = 'Lembrar Senha de Acesso';
            $mail->Body    = "Olá, $nome.<br><br>Segundo solicitado, sua senha de acesso é: <b>$senha</b><br><br>Obrigado!";
            $mail->AltBody = "Olá, $nome.\n\nSegundo solicitado, sua senha de acesso é: $senha\n\nObrigado!"; // Versão em texto simples

            // Envia o e-mail
            $mail->send();
            echo "<script>alert('Senha enviada para seu e-mail.'); window.location.href = 'login.php';</script>";
        } catch (Exception $e) {
            echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
        }
    } else {
        // Se o e-mail não foi encontrado
        echo "<script>alert('E-mail não encontrado!'); window.location.href = 'esqsenha.php';</script>";
    }
}
?>

<!-- Código HTML permanece inalterado -->
<section id="inner-headline">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
          <li><a href="#"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i></li>
          <li><a href="index.php">Home</a><i class="icon-angle-right"></i></li>
          <li class="active">Lembrar a senha</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<section id="content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
                <form role="form" class="register-form" method="POST" action="prosenha.php">
                    <h2>Esqueceu a Senha: <small>Digite seu e-mail cadastrado</small></h2>
                    <hr class="colorgraph">
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Endereço de E-Mail" tabindex="4" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <input type="submit" value="Enviar Senha" class="btn btn-primary btn-block btn-lg" tabindex="6">
                        </div>
                        <div class="col-xs-12 col-md-6">Não possui Acesso ? <a href="cadAluno.php">Cadastre-se aqui!</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>

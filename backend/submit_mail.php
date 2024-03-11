<?php
session_start();

require 'connect.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_autor = mysqli_real_escape_string($mysqli, $_POST['nome']);
    $email_autor = mysqli_real_escape_string($mysqli, $_POST['email']);
    $assunto_autor = mysqli_real_escape_string($mysqli, $_POST['assunto']);
    $mensagem_autor = mysqli_real_escape_string($mysqli, $_POST['mensagem']);

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_LOWLEVEL;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ciberbrasilblog@gmail.com';
        $mail->Password = 'ifae hims mgth svao';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->Debugoutput = function ($str, $level) {
            file_put_contents('../jorge.log', $str, FILE_APPEND);
        };

        $mail->setFrom($email_autor, $nome_autor);
        $mail->addAddress('ciberbrasilblog@gmail.com', 'CiberBrasil');

        $mail->isHTML(true);
        $mail->Subject = $assunto_autor;
        $mail->Body = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    .container {
                        border-radius: 15px;
                        background-color: #f2f2f2;
                        padding: 20px;
                    }

                    .profile-img {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        margin-bottom: 10px;
                    }
                </style>
            </head>

            <body>
                <div class='container'>
                    <h2>Mensagem de Contato</h2>
                    <p><strong>Nome:</strong> $nome_autor</p>
                    <p><strong>Email:</strong> $email_autor</p>
                    <p><strong>Assunto:</strong> $assunto_autor</p>
                    <p><strong>Mensagem:</strong> $mensagem_autor</p>
                    <p>Esta mensagem foi enviada em: " . date('d/m/Y H:i:s') . "</p>
                </div>
            </body>
            </html>
        ";

        $mail->send();

        header('Location: http://www.ciberbrasil.byethost18.com/index.php');
    } catch (Exception $e) {
        // $mail->Debugoutput = function ($str, $level) {
        //     file_put_contents('../jorge.log', $str, FILE_APPEND);
        // };

        echo 'Erro ao enviar o email: ' . $mail->ErrorInfo;
        exit();
    }

    mysqli_close($mysqli);
}

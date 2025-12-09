<?php
require_once 'env.php';

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer-master/PHPMailer-master/src/Exception.php';
require_once 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

function enviarCorreoPedido($destinatarioRestaurante, $destinatarioDept, $detallesHTML) {
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('EMAIL_REMITENTE');
        $mail->Password   = getenv('EMAIL_PASSWORD');                            //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = (int)getenv('EMAIL_PORT');  

        // Recipients
        $mail->setFrom(getenv('EMAIL_REMITENTE'), getenv('EMAIL_NOMBRE')); // -- 
        $mail->addAddress($destinatarioRestaurante);
        $mail->addCC($destinatarioDept);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de pedido';
        $mail->Body    = $detallesHTML;

        $mail->send();

    } catch (Exception $e){
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
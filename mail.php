<?php
require_once 'util.php';
require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';


function sendMail($email, $subject, $msg) {
    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
        ->setUsername('ajax.simple.mailer')
        ->setPassword('4eDDR1nh1lst7uoUP0kD');

    $mailer = Swift_Mailer::newInstance($transport);

    $message = Swift_Message::newInstance($subject)
        ->setFrom(array('ajax@chat.com' => 'chat'))
        ->setTo(array($email))
        ->setBody($msg);

    $result = $mailer->send($message);
    return $result;
}

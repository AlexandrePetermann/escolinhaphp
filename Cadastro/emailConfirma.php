<?php

function emailConfirma($email, $link) {
    // multiple recipients
    $to = 'xandy.bq@gmail.com'; //. ', '; // note the comma
    // $to .= 'wez@example.com';
// subject
    $subject = 'Confirmaçãp de cadastro [Nome do Site]';

// message
    $message = " 
    <html>
        <head>
            <title>COnfirmação de cadastro no site</title>
        </head>
        <body>
            <h1>Confirmação de e-mail</h1>
            <p>Recentemente o e-mail $email foi cadastrado</p>
            </br>
            <p>$link</p>
            </table>
        </body>
    </html>
    ";

// To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
    $headers .= "To: $email <$email>" . "\r\n";
    $headers .= "From: Site do Alexandre <xandy.bq@gmail.com>" . "\r\n";
    //$headers .= "Cc: birthdayarchive@example.com"" . "\r\n";
    //$headers .= "Bcc: birthdaycheck@example.com" . "\r\n";

// Mail it
    mail($to, $subject, $message, $headers);
}

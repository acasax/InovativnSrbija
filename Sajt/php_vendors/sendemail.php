<?php
include "class.user.php";
$user_class = new USER();
  
if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['message'])) {

    $email_to = "info@inovativnasrbija.com";
    $email_subject = "Poruka sa sajta";

    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $message    = $_POST['message'];

    function clean_string($string){
        $bad = array("content-type", "bcc:", "to:", "cc:", "href");
        return str_replace($bad, "", $string);
    }

    $email_message = "Name: " . clean_string($name) . "\n";
    $email_message .= "E-mail: " . clean_string($email) . "\n";

    $email_message .= "Message: " . clean_string($message) . "\n";

    $headers = 'From: ' . $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    if (@mail($email_to, $email_subject, $email_message, $headers)) {
        $user_class->returnJSON("OK","Poruka poslata");
        return;
    } else {
        $user_class->returnJSON("ERROR","Poruka nije poslata.");
        return;
    };
} else {
//echo "nije sve setovanoi";
    $user_class->returnJSON("ERROR","Popunite sva polja.");
    return;
}

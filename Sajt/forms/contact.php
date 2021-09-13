<?php
include "class.user.php";
$user_class = new USER();



    //if (isset($_REQUEST['recaptcha_response'])) {

        // // Build POST request:
        // $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
        // $recaptcha_secret = '6LcA-KoaAAAAAO90EfGBnbOFvRyxtcgkFmFmzjrs';
        // $recaptcha_response = $_POST['recaptcha_response'];

        // // Make and decode POST request:
        // $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        // // echo $recaptcha;
        // $recaptcha = json_decode($recaptcha);


        // Take action based on the score returned:
        // if ($recaptcha->score >= 0.5) {
            if (isset($_REQUEST['name']) && isset($_REQUEST['email']) && isset($_REQUEST['subject']) && isset($_REQUEST['message'])) {

                $email_to = "info@inovativnasrbija.com";
                $email_subject = "Poruka sa sajta";


                $name       = $_POST['name'];
                $email      = $_POST['email'];
                $subject      = $_POST['subject'];
                $message    = $_POST['message'];



                function clean_string($string)
                {
                    $bad = array("content-type", "bcc:", "to:", "cc:", "href");
                    return str_replace($bad, "", $string);
                }

                $email_message = "Ime: " . clean_string($name) . "\n";
                $email_message .= "E-mail: " . clean_string($email) . "\n";
                $email_message .= "Naslov: " . clean_string($subject) . "\n";
                //$email_message .= "Usluga: " . clean_string($service) . "\n";
                $email_message .= "Poruka: " . clean_string($message) . "\n";



                $headers = 'From: ' . $email . "\r\n" .
                    'Reply-To: ' . $email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                if (@mail($email_to, $email_subject, $email_message, $headers)) {
                    $user_class->returnJSON("OK","Message sent.");
                    echo "PORUKA POSLATA";
                    return;
                } else {
                     $user_class->returnJSON("ERROR","Message not sent. Please try again.");
                    return;
                };
            } else {
                //echo "nije sve setovanoi";
                $user_class->returnJSON("ERROR","FIll all required fields.");
                return;
            }
        // } else {
        //     // echo "error with recaptcha";
        //      $user_class->returnJSON("ERROR",
        //       "Problem with recaptcha");
        //     return;
        // }
    // //} else {
    //     //echo "error with recaptcha_response";
    //      $user_class->returnJSON("ERROR",
    //      "Problem with recaptcha_response");
    //     return;
    // }


?>
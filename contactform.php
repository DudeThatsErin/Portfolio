<?php

if (isset($_POST['submit'])) { // did the user click the submit button?
    // variables - data from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    
    if(empty($name) || empty($email) || empty($subject) || empty($message)) {
            $response = array(
                "status" => "alert-danger",
                "message" => "All the fields are required."
            );
    } else {
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secretAPIkey = '6Lf2vV0jAAAAACnf5veftndUkV0iupYGBwvY0Jay';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
            $response = json_decode($verifyResponse);
                    if($response->success){
                        $toMail = "dudethatserin@icloud.com";
                        $header = "From: " . $name . "<". $email .">\r\n";
                        mail($toMail, $subject, $message, $header);
                        $response = array(
                            "status" => "alert-success",
                            "message" => "Your mail have been sent."
                        );
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "Robot verification failed, please try again."
                        );
                    }       
            } else{ 
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Plese check on the reCAPTCHA box."
                );
            } 
        } 
    }  

?>
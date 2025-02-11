<?php
// Initialize response array
$response = array();

if (isset($_POST['submit'])) {
    // Sanitize and validate input data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);
    
    // Validate input data
    $errors = array();
    
    // Name validation
    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (!preg_match("/^[A-Za-z ]{2,50}$/", $name)) {
        $errors[] = "Name must be 2-50 characters long and contain only letters.";
    }
    
    // Email validation
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }
    
    // Subject validation
    if (empty($subject)) {
        $errors[] = "Subject is required.";
    } elseif (strlen($subject) < 2 || strlen($subject) > 100) {
        $errors[] = "Subject must be between 2 and 100 characters.";
    }
    
    // Message validation
    if (empty($message)) {
        $errors[] = "Message is required.";
    } elseif (strlen($message) < 10 || strlen($message) > 1000) {
        $errors[] = "Message must be between 10 and 1000 characters.";
    }
    
    // If there are validation errors
    if (!empty($errors)) {
        $response = array(
            "status" => "alert-danger",
            "message" => implode("<br>", $errors)
        );
    } else {
        // Verify reCAPTCHA
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secretAPIkey = '6Lf2vV0jAAAAACnf5veftndUkV0iupYGBwvY0Jay';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretAPIkey.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            
            if($responseData->success) {
                // Prepare email headers
                $to = "dudethatserin@icloud.com";
                $headers = array(
                    'From' => $name . ' <' . $email . '>',
                    'Reply-To' => $email,
                    'X-Mailer' => 'PHP/' . phpversion(),
                    'Content-Type' => 'text/plain; charset=UTF-8'
                );
                
                // Prepare email content
                $emailContent = "Name: " . $name . "\n";
                $emailContent .= "Email: " . $email . "\n\n";
                $emailContent .= "Message:\n" . $message;
                
                // Send email
                if(mail($to, $subject, $emailContent, implode("\r\n", $headers))) {
                    $response = array(
                        "status" => "alert-success",
                        "message" => "Thank you! Your message has been sent successfully."
                    );
                } else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Sorry, there was an error sending your message. Please try again later."
                    );
                }
            } else {
                $response = array(
                    "status" => "alert-danger",
                    "message" => "Robot verification failed. Please try again."
                );
            }
        } else {
            $response = array(
                "status" => "alert-danger",
                "message" => "Please complete the reCAPTCHA verification."
            );
        }
    }
}
?>
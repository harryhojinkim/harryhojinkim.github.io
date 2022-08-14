<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "harry.hojin.kim@gmail.com";
        
        # Sender Data
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        // $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $phone = trim($_POST["phone"]);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR empty($phone)) {
            # OR !filter_var($email, FILTER_VALIDATE_EMAIL)
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }
        
        $subject = "RSVP added = Name:";
        $subject .= $name
        # Mail Content
        $content = "Name: $name\n";
        // $content .= "Email: $email\n\n";
        $content .= "Phone: $phone\n";
        $content .= "Message:\n$message\n";

        # email headers.
        $headers = "From: $name <$email>";

        # Send the email.
        $success = mail($mail_to, $subject, $content);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "감사합니다. 참석여부가 발송되었습니다.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "에러가 발생하였습니다. 다시 시도해주세요.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "에러가 발생하였습니다. 다시 시도해주세요.";
    }

?>

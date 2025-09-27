<?php
// Check for empty fields and valid email address
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(500);
    echo "Empty fields or invalid email address.";
    exit();
}

$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

$to = "museoacieloabierto.sf@gmail.com"; // Your email address
$subject = "$m_subject: $name";
$body = "You have received a new message from your website contact form.\n\n" . "Here are the details:\n\nName: $name\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";
$header = "From: $email\r\n";
$header .= "Reply-To: $email\r\n";

if (mail($to, $subject, $body, $header)) {
    http_response_code(200);
    echo "Message sent successfully!";
} else {
    http_response_code(500);
    echo "Message could not be sent. Mail function failed.";
}
?>
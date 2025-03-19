<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Directly retrieve form values (without database escaping)
    $name = $_POST['name'];
    $company = $_POST['cname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Send Email Notification
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'dimbelfeliks@gmail.com'; // Your Gmail
        $mail->Password = 'yijl sosp bope qobu'; // Use App Password (Not your real Gmail password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set Email Sender & Recipient
        $mail->setFrom('dimbelfeliks@gmail.com', 'Feliks');
        $mail->addAddress('dimbelfeliks@gmail.com'); // You receive the message here

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "NOTIFICATION: Someone wants to hire you!";
        $mail->Body = "
            <h2>New Job Inquiry</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Company:</strong> $company</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        echo "<script>alert('Message Sent Successfully!'); window.location.href='index.html';</script>";
    } catch (Exception $e) {
        echo "Email failed: " . $mail->ErrorInfo;
    }
}
?>
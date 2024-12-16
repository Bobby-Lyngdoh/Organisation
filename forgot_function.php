<?php
session_start();
// Include the database connection
include("connect.php");  // Ensure connect.php is correct and includes a valid mysqli connection

// Use PHPMailer namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Composer autoloader if you're using Composer
require 'vendor/autoload.php';

// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}


// Function to check if the email exists in the database
function emailExists($email) {
    global $connect;
    $sql = "SELECT id FROM user WHERE email = ?";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if email exists
        if ($stmt->num_rows > 0) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    return false;
}

// Function to update password in the database
function updatePassword($email, $newPassword) {
    global $connect;

    // Hash the password using MD5 (not recommended for production, use password_hash() instead)
    $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

    // SQL query to update the password
    $sql = "UPDATE user SET password = ? WHERE email = ?";

    // Prepare statement
    if ($stmt = $connect->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ss", $hashedPassword, $email);

        // Execute the statement
        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } else {
        // If preparation of the query fails
        return false;
    }
}

// Function to send an email via SMTP with styled content
function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'botboblyngdoh18@gmail.com';  // Your email
        $mail->Password = 'hjpe irmw ubzg myri';   // Your email password or app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Enable debugging for detailed error messages
        $mail->SMTPDebug = 0;  // Debug level: 2 (client and server messages)

        // Sender details
        $mail->setFrom('botboblyngdoh18@gmail.com', 'Boby website');
        $mail->addAddress($to);  // Recipient

        // Prepare the styled email content
        $htmlMessage = "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f7f7f7;
                }
                .container {
                    width: 100%;
                    max-width: 600px;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: #ffffff;
                    border-radius: 8px;
                    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                }
                h2 {
                    color: #333;
                    text-align: center;
                }
                .password-box {
                    background-color: #f1f1f1;
                    padding: 15px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    margin: 20px 0;
                    text-align: center;
                    font-size: 18px;
                    color: #333;
                    font-weight: bold;
                }
                .footer {
                    font-size: 14px;
                    color: #888;
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Password Reset Notification</h2>
                <p>Hello,</p>
                <p>Your password has been successfully reset. Below is your new password:</p>
                <div class='password-box' style='font-size: 22px; color: #4CAF50;'>
                    $message
                </div>
                <p>If you didn't request this password reset, please contact support immediately.</p>
                <div class='footer'>
                    <p>Best regards,</p>
                    <p>The Boby Website Team</p>
                </div>
            </div>
        </body>
        </html>";

        // Set email format to HTML
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlMessage;

        // Send the email
        $mail->send();
        echo "Message has been sent successfully.<br>";
        return true;  // Indicate that the email was sent successfully
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        return false;  // Indicate that there was an error sending the email
    }
}

// Main logic to generate a random password, update password, and send email
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  // Get email from form input

    // Check if the email exists in the database
    if (emailExists($email)) {
        // Generate a random password
        $newPassword = generateRandomPassword();

        // Update password in the database
        if (updatePassword($email, $newPassword)) {

            // Prepare the email subject and message
            $subject = "Password Reset Notification";
            $message = "Your password has been reset. Your new password is: <strong>$newPassword</strong>";

            // Send the email with the new password
            if (sendEmail($email, $subject, $message)) {
                // Prepare success message and redirect
                $_SESSION['message'] = "Password has been reset successfully. A confirmation email has been sent.";
                header("location:login.php");
                exit;
            } else {
                // If email sending failed
                $_SESSION['message'] = "Error sending email. Please try again later.";
                header("location:forgot.php");
                exit;
            }

        } else {
            // If updating the password failed                  
            $_SESSION['message'] = "Error updating password. Please try again later.";
            header("location:forgot.php");
            exit;
        }
    } else {
        // If email does not exist, redirect to forgot.php with a session message
        $_SESSION['message'] = "No account found with that email address. Please try again.";
        header("location:forgot.php");
        exit;
    }
}
?>

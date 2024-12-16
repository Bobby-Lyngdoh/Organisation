<?php
session_start();

include("connect.php");  


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
 

function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}



function emailExists($email) {
    global $connect;
    $sql = "SELECT id FROM admin WHERE email = ?";

    if ($stmt = $connect->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

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

function updatePassword($email, $newPassword) {
    global $connect;


   

   
    $sql = "UPDATE admin SET password = ? WHERE email = ?";


    if ($stmt = $connect->prepare($sql)) {
     
        $stmt->bind_param("ss", $hashedPassword, $email);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        } else {
            $stmt->close();
            return false;
        }
    } else {
 
        return false;
    }
}


function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'botboblyngdoh18@gmail.com'; 
        $mail->Password = 'hjpe irmw ubzg myri';   
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

     
        $mail->SMTPDebug = 0; 

 
        $mail->setFrom('botboblyngdoh18@gmail.com', 'Boby website');
        $mail->addAddress($to);  


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

    
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlMessage;

      
        $mail->send();
        echo "Message has been sent successfully.<br>";
        return true;  
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}<br>";
        return false; 
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];  


    if (emailExists($email)) {
      
        $newPassword = generateRandomPassword();

        if (updatePassword($email, $newPassword)) {

            $subject = "Password Reset Notification";
            $message = "Your password has been reset. Your new password is: <strong>$newPassword</strong>";

            if (sendEmail($email, $subject, $message)) {
      
                $_SESSION['message'] = "Password has been reset successfully. A confirmation email has been sent.";
                header("location:admin.php");
                exit;
            } else {
               
                header("location:forgot_admin.php");
                exit;
            }

        } else {
       
            $_SESSION['message'] = "Error updating password. Please try again later.";
            header("location:forgot_admin.php");
            exit;
        }
    } else {
       
        $_SESSION['message'] = "No account found with that email address. Please try again.";
        header("location:forgot_admin.php");
        exit;
    }
}
?>

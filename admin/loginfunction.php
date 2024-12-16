<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];
    $captcha_response = $_POST['g-recaptcha-response']; // The reCAPTCHA response

    // Check if reCAPTCHA is completed
    if (empty($captcha_response)) {
        $_SESSION['captcha_error'] = "Please verify that you are not a robot.";
        header("Location: admin.php");
        exit();
    }

    // Your Google reCAPTCHA Secret Key
    $secret_key = '6LcUgJoqAAAAADQpojzNuRPZejnTfQ8IaLgwPRQE'; // Replace with your secret key

    // Verify the reCAPTCHA response with Google's API
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $response = file_get_contents($verify_url . '?secret=' . $secret_key . '&response=' . $captcha_response);
    $response_keys = json_decode($response);

    if (intval($response_keys->success) !== 1) {
        $_SESSION['captcha_error'] = "reCAPTCHA verification failed. Please try again.";
        header("Location: admin.php");
        exit();
    }

    // Proceed with the login process if reCAPTCHA is successful
    $email = mysqli_real_escape_string($connect, $email);
    $password = mysqli_real_escape_string($connect, $password);

    $query = "SELECT * FROM admin WHERE email = '$email'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if ($password == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            header("Location: profile.php");
            exit();
        } else {
            $_SESSION['message'] = "Wrong username or password!";
            header("Location: admin.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Wrong username or password!";
        header("Location: admin.php");
        exit();
    }
}
?>

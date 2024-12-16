<?php 
session_start();
include('connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // reCAPTCHA verification
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $recaptcha_secret = '6LdNe5oqAAAAABpxQrw9G_5HWZktxhmyHWnt7hw8';  // Your reCAPTCHA secret key
    
    // Verify reCAPTCHA response with Google API
    $recaptcha_verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = array(
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response
    );
    
    // Use cURL to verify the response
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $recaptcha_verify_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($recaptcha_data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification temporarily
    $recaptcha_verify = curl_exec($ch);
    curl_close($ch);
    
    // Log the response for debugging
    error_log("reCAPTCHA response: " . $recaptcha_verify); // Log response for debugging
    $recaptcha_result = json_decode($recaptcha_verify);

    // Log the decoded response for further debugging
    error_log("reCAPTCHA result: " . print_r($recaptcha_result, true));

    if (!$recaptcha_result->success) {
        $_SESSION['message'] = "Please verify that you're not a robot.";
        header("Location: login.php");
        exit();
    }

    // Sanitize input to prevent SQL injection
    $email = mysqli_real_escape_string($connect, $email);
    $password = mysqli_real_escape_string($connect, $password);

    // Query to fetch user data by email
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Check if the user is blocked (status = 1)
        if ($user['status'] == 1) {
            $_SESSION['message'] = "Your account is blocked. Please contact administration.";
            header("Location: login.php");
            exit();
        }

        // Check if the password is correct
        if (password_verify($password, $user['password'])) {
            // Successful login, reset failed attempts to 0
            $query = "UPDATE user SET failed_attempts = 0 WHERE id = {$user['id']}";
            mysqli_query($connect, $query);

            $_SESSION['user_id'] = $user['id'];
            header("Location: user_info.php");
            exit();
        } else {
            // Incorrect password, increment failed attempts
            $failed_attempts = $user['failed_attempts'] + 1;

            // If failed attempts reach 4, block the user (set status = 1)
            if ($failed_attempts >= 4) {
                $query = "UPDATE user SET failed_attempts = $failed_attempts, status = 1 WHERE id = {$user['id']}";
                mysqli_query($connect, $query);
                $_SESSION['message'] = "Your account has been blocked due to too many failed login attempts. Please contact administration.";
            } else {
                // Otherwise, just increment the failed attempts
                $query = "UPDATE user SET failed_attempts = $failed_attempts WHERE id = {$user['id']}";
                mysqli_query($connect, $query);
                $_SESSION['message'] = "Wrong username or password!";
            }
            header("Location: login.php");
            exit();
        }
    } else {
        // User not found
        $_SESSION['message'] = "Wrong username or password!";
        header("Location: login.php");
        exit();
    }
}

?>
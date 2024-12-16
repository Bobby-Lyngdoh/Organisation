<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Your existing form data retrieval
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $register = $_POST['register'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm'];

    // reCAPTCHA validation
    $captcha = $_POST['g-recaptcha-response'];
    $secret_key = "6LfgiJoqAAAAABLRBQtFerjCpGzjPGFRi3XspvRN";  // Your secret key from Google reCAPTCHA

    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$captcha");
    $response_keys = json_decode($response, true);

    if(intval($response_keys["success"]) !== 1) {
        $_SESSION['captcha_error'] = "Please complete the CAPTCHA.";
        header("Location: register.php");
        exit();
    }

    // Validation flags
    $isValid = true;
    $_SESSION['name_error'] = $_SESSION['phone_error'] = $_SESSION['password_error'] = $_SESSION['confirmpassword_error'] = $_SESSION['email_error'] = $_SESSION['class_error'] = $_SESSION['register_error'] = '';

    // Validation for other fields...
    if (empty($name) || !is_string($name)) {
        $_SESSION['name_error'] = "Please enter a valid name.";
        $isValid = false;
    }
    if (empty($gender)) {
        $_SESSION['gender_error'] = "Please select a valid gender (male or female).";
        $isValid = false;
    }
    if (empty($phone) || !is_numeric($phone) || strlen($phone) != 10) {
        $_SESSION['phone_error'] = "Please enter a valid 10-digit phone number.";
        $isValid = false;
    } else {
        // Check if the phone number exists in the database
        $stmt = $connect->prepare("SELECT phone FROM user WHERE phone = ?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['phone_error'] = "This phone number is already registered.";
            $isValid = false;
        }
        $stmt->free_result();
        $stmt->close();
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['email_error'] = "Please enter a valid email address.";
        $isValid = false;
    } else {
        // Check if the email exists in the database
        $stmt = $connect->prepare("SELECT email FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['email_error'] = "This email address is already registered.";
            $isValid = false;
        }
        $stmt->free_result();
        $stmt->close();
    }

    if (empty($class) || !is_string($class)) {
        $_SESSION['class_error'] = "Please enter valid class.";
        $isValid = false;
    }

    if (empty($register) || !is_string($register)) {
        $_SESSION['register_error'] = "Please enter a valid registration number.";
        $isValid = false;
    }

    if (empty($password) || strlen($password) < 8) {
        $_SESSION['password_error'] = "Password must be at least 8 characters.";
        $isValid = false;
    }

    if ($confirm_password !== $password) {
        $_SESSION['confirmpassword_error'] = "Password does not match.";
        $isValid = false;
    }

    if (!$isValid) {
        header("Location: register.php");
        exit();
    }

    // If validation passed, proceed with registration
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $connect->prepare("INSERT INTO user (name, gender, phone, email, class, registration_number, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $gender, $phone, $email, $class, $register, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful.";
        header("Location: login.php");
    } else {
        $_SESSION['message'] = "Insert failed: " . $stmt->error;
        header("Location: register.php");
    }

    $stmt->close();
    exit();
}

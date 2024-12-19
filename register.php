<?php 
    session_start(); 
    include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Registration Form</title>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

       
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 0;
            margin-top: 0;
        }

        /* Gap between header and form */
        .content {
            margin-top: 40px; /* Adjust this value to create more or less space */
            width: 100%;
            max-width: 600px;
            padding: 20px;
            box-sizing: border-box;
        }

        h1 { 
            color: #6a4f4b; 
            font-weight: bold; 
            margin-bottom: 20px;
            text-align: center;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            box-sizing: border-box;
            margin-top: 100px;
            margin-right: 50;
        }

        label {
            font-size: 16px;
            color: #333;
            margin-bottom: 5px;
            display: inline-block;
        }

        input[type="text"], input[type="number"], input[type="password"], input[type="email"], input[type="radio"], input[type="checkbox"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f1f1f1;
        }

        input[type="radio"] {
            width: auto;
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .err {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }

        .g-recaptcha {
            margin-bottom: 15px;
        }

        /* Responsive Design */
        @media screen and (max-width: 600px) {
            form {
                width: 90%;
            }
        }

    </style>
</head>
<body>

    <!-- Header -->
   

    <!-- Content Section -->
   
        <?php 
            if (isset($_SESSION['message'])) {
                echo ($_SESSION['message']);
                unset($_SESSION['message']);
            }
        ?>

        <form action="registration_function.php" method="post">

            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter name" required>
            <span class="err"><?php if (isset($_SESSION["name_error"])) echo $_SESSION["name_error"]; ?></span>

            <label>Gender</label>
            <input type="radio" name="gender" id="male" value="Male" required> <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="Female" required> <label for="female">Female</label>
            <span class="err"><?php if (isset($_SESSION["gender_error"])) echo $_SESSION["gender_error"]; ?></span>

            <label for="phone">Phone</label>
            <input type="number" name="phone" id="phone" placeholder="Enter phone number" required>
            <span class="err"><?php if (isset($_SESSION["phone_error"])) echo $_SESSION["phone_error"]; ?></span>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter email id" required>
            <span class="err"><?php if (isset($_SESSION["email_error"])) echo $_SESSION["email_error"]; ?></span>

            <label for="class">Class</label>
            <input type="number" name="class" id="class" placeholder="Enter class" required>
            <span class="err"><?php if (isset($_SESSION["class_error"])) echo $_SESSION["class_error"]; ?></span>

            <label for="register">Registration number</label>
            <input type="text" name="register" id="register" placeholder="Enter registration number" required>
            <span class="err"><?php if (isset($_SESSION["register_error"])) echo $_SESSION["register_error"]; ?></span>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter password" required>

            <label for="confirm">Confirm Password</label>
            <input type="password" name="confirm" id="confirm" placeholder="Confirm password" required>
            <span class="err"><?php if (isset($_SESSION["confirm_error"])) echo $_SESSION["confirm_error"]; ?></span>

            <label for="agree">I agree</label>
            <input type="checkbox" name="agree" id="agree" required> I agree to the terms and conditions.

            <!-- Google reCAPTCHA widget -->
            <div class="g-recaptcha" data-sitekey="6LfgiJoqAAAAAFFiVcUAVfeM04cHKEtw-o1HjLxY"></div>
            <span class="err"><?php if (isset($_SESSION["captcha_error"])) echo $_SESSION["captcha_error"]; ?></span>

            <input type="submit" name="submit" value="Submit">
        
        </form>

        <?php
            unset($_SESSION['name_error']);
            unset($_SESSION['gender_error']);
            unset($_SESSION['phone_error']);
            unset($_SESSION['email_error']);
            unset($_SESSION['class_error']);
            unset($_SESSION['register_error']);
            unset($_SESSION['confirm_error']);
        ?>

    </div>
</body>
</html>

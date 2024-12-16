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
        h1 { 
            margin-left: 45%; 
            color: brown; 
            font-weight: bold; 
        }
        form {
            display: inline-block;
            margin-left: 35%;
            margin-top: 10px;
            width: 30%;
            background-color: lightblue;
            border: 2px solid black;
            padding: 10px;
        }
        input[type="text"], input[type="number"], input[type="password"] {
            border: 1px solid black;
            padding: 10px;
            background-color: beige;
            margin-left: 13%;
            margin-top: 10px;
            width: 70%; 
        }
        label {
            margin-left: 13%;
            color: darkgreen;
            font-family: 'Times New Roman', Times, serif;
            font-weight: bolder;
            font-size: large;
        }
        input[type="submit"] {
            background-color: aquamarine;
            border: 1px solid black;
            border-radius: 2px;
            margin-top: 10px;
            margin-left: 40%;
            width: 20%; 
        }
        .err {
            color: red;
            font-size: small;
        }
    </style>
</head>
<body>
    <h1> Registration</h1>

    <?php 
        if (isset($_SESSION['message'])) {
            echo ($_SESSION['message']);
            unset($_SESSION['message']);
        }
    ?>

    <form action="registration_function.php" method="post">

        <label for="name">Name</label><br>
        <input type="text" name="name" id="name" placeholder="Enter name"><br><br>
        <span class="err"><?php if (isset($_SESSION["name_error"])) echo $_SESSION["name_error"]; ?></span>

        <label>Gender</label><br>
        <label for="male">Male</label>
        <input type="radio" name="gender" id="male" value="Male" >
        <label for="female">Female</label>
        <input type="radio" name="gender" id="female" value="Female"><br><br>
        <span class="err"><?php if (isset($_SESSION["gender_error"])) echo $_SESSION["gender_error"]; ?></span>

        <label for="phone">Phone</label><br>
        <input type="number" name="phone" id="phone" placeholder="Enter phone number"><br><br>
        <span class="err"><?php if (isset($_SESSION["phone_error"])) echo $_SESSION["phone_error"]; ?></span>

        <label for="email">Email</label><br>
        <input type="text" name="email" id="email" placeholder="Enter email id"><br><br>
        <span class="err"><?php if (isset($_SESSION["email_error"])) echo $_SESSION["email_error"]; ?></span>

        <label for="class">Class</label><br>
        <input type="number" name="class" id="class" placeholder="Enter class"><br><br>
        <span class="err"><?php if (isset($_SESSION["class_error"])) echo $_SESSION["class_error"]; ?></span>

        <label for="register">Registration number</label><br>
        <input type="text" name="register" id="register" placeholder="Enter registration number"><br><br>
        <span class="err"><?php if (isset($_SESSION["register_error"])) echo $_SESSION["register_error"]; ?></span>

        <label for="password">Password</label><br>
        <input type="password" name="password" id="password" placeholder="Enter password"><br><br>

        <label for="confirm">Confirm Password</label><br>
        <input type="password" name="confirm" id="confirm" placeholder="Confirm password"><br><br>
        <span class="err"><?php if (isset($_SESSION["confirm_error"])) echo $_SESSION["confirm_error"]; ?> </span>

        <label for="agree">I agree</label>
        <input type="checkbox" name="agree" id="agree"><br><br>

        <!-- Google reCAPTCHA widget -->
        <div class="g-recaptcha" data-sitekey="6LfgiJoqAAAAAFFiVcUAVfeM04cHKEtw-o1HjLxY"></div><br><br>
        <span class="err"><?php if (isset($_SESSION["captcha_error"])) echo $_SESSION["captcha_error"]; ?></span>

        <input type="submit" name="submit" value="Submit"><br>
      
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

</body>
</html>

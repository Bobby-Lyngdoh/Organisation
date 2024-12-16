<?php 
 include("header_2.php");
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <style>
     
        h1 {
            font-weight: bold;
            color: darkblue;
            text-align: center;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
        form {
            padding: 30px;
            width: 100%;
            max-width: 350px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            padding: 15px;
            background-color: #f9c6c6;
            border: 1px solid red;
            color: red;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            text-align: left;
        }
        .input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            text-align: left;
        }
        button {
            background-color: skyblue;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        button:hover {
            background-color: #45a049;
        }
        .err {
            color: red;
            font-size: 14px;
        }
        .link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: blue;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <center>
    <div class="form-container">
        <h1>Login Page</h1>
        
        <?php 
        if (isset($_SESSION['message'])) {
            echo '<div class="message">'.$_SESSION['message'].'</div>';
            unset($_SESSION['message']);
        }
        ?>
        
        <form action="login_function.php" method="post">
    <label for="email">Email ID</label>
    <input type="text" id="email" name="email" placeholder="Email ID" class="input">
    <span class="err"><?php if (isset($_SESSION["email_error"])) echo $_SESSION["email_error"]; ?></span>
    
    <label for="password">Password</label>
    <input type="password" id="password" name="password" placeholder="Password" class="input">
    <span class="err"><?php if (isset($_SESSION["password_error"])) echo $_SESSION["password_error"]; ?></span>

    <div class="g-recaptcha" data-sitekey="6LdNe5oqAAAAAPJLu8gmctPF09cOch5afFd7kHOm"></div>
    <br/>
    
    <button type="submit" name="submit" value="submit">Login</button>

    <a class="link" href="forgot.php">Forgot password?</a>
</form>


        <?php 
      
        if (isset($_SESSION['email_error'])) unset($_SESSION['email_error']);
        if (isset($_SESSION['password_error'])) unset($_SESSION['password_error']);
        ?>
    </div>
    </center>
</body>
</html>

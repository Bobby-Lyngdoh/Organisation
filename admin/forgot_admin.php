<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 8px;
            display: block;
            font: bolder;
            color: #007BFF;
            font-size:x-large;
        }

        .input {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            text-align: center;
            color: darkblue;
            margin-top: 15px;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

    </style>


    <html>
        <body>




        <?php 
    if (isset($_SESSION['message'])) {
        echo '<div class="message">'.$_SESSION['message'].'</div>';
        unset($_SESSION['message']); 
    }
?>

    <form action="admin_forget_function.php" method="POST">
        <h2>Forgot Password</h2>
        
        <label for="email">Please enter your email ID</label>
        <input id="email" name="email" type="email" placeholder="Enter your registered email ID" class="input" required>

        <button type="submit" name="submit" value="submit">Submit</button>

        <a href="admin_login.php" class="back-link">Back to Login</a>
    </form>

    

</body>
</html>

        </body>
    </html>
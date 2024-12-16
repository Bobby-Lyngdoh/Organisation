<?php 
session_start(); // Ensure session is started at the beginning

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php'); 
    exit();
}

$user_id = $_SESSION['user_id'];
include("connect.php");

$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $gender = $row['gender'];
    $phone = $row['phone'];
    $email = $row['email'];
    $class = $row['class'];
    $register = $row['registration_number'];
} else {
    echo "User not found.";
    exit;
}

$stmt->close();
$connect->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
        }
        h1 {
            font-size: 2.5em;
            color: #007BFF;
        }
        h2 {
            color: #333;
            margin-top: 30px;
            border-bottom: 2px solid #007BFF;
            padding-bottom: 10px;
        }
        p {
            font-size: 1.1em;
            line-height: 1.6;
            margin: 10px 0;
        }
        strong {
            color: #555;
        }
        .button-container {
            margin-top: 30px;
        }
        .button-container input {
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            margin: 10px 5px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button-container input:hover {
            background-color: #007BFF;
            color: white;
        }
        .logout-btn {
            background-color: #DC3545;
            color: white;
        }
        .logout-btn:hover {
            background-color: #C82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($name); ?></h1>
    <h2>Your Profile</h2>
    <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
    <p><strong>Gender:</strong> <?php echo htmlspecialchars($gender); ?></p>
    <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($phone); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
    <p><strong>Class:</strong> <?php echo htmlspecialchars($class); ?></p>
    <p><strong>Registration number:</strong> <?php echo htmlspecialchars($register); ?></p>

    <div class="button-container">
        <form action="update_edit.php" method="get">
            <input type="submit" value="Edit/update Profile">
        </form>

        <!-- Logout Form -->
        <form action="logout.php" method="post">
            <input type="submit" value="logout" class="logout-btn">
        </form>
    </div>
</div>

</body>
</html>

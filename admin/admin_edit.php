<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: profile.php'); 
    exit;
}

$user_id = $_SESSION['user_id'];

include("connect.php");

$sql = "SELECT * FROM admin WHERE id = ?";
$stmt = $connect->prepare($sql);
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $phone = $row['phone'];
    $email = $row['email'];
 
} else {
    echo "User not found.";
    exit;
}

$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
                  

    $sql = "UPDATE ADMIN SET name = ?, phone = ?, email = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("sssi", $new_name, $new_phone,$new_email,  $user_id);
    $stmt->execute();
    $stmt->close();
    $connect->close();

    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        
        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .form-group input[type="submit"]:hover {
            background-color: #45a049;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Edit/Update Profile</h1>
    
    <div class="container">
        <form action="admin_edit.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Update/Edit Profile">
            </div>
        </form>
    </div>

    <div class="footer">
        <p>Powered by Your Website</p>
    </div>

</body>
</html>



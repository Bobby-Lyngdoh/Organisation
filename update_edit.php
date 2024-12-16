<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); 
    exit;
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_gender = $_POST['gender'];
    $new_phone = $_POST['phone'];
    $new_email = $_POST['email'];
    $new_class = $_POST['class'];
    $new_register = $_POST['registration_number'];

    $sql = "UPDATE user SET name = ?, gender = ?, phone = ?, email = ?, class = ?, registration_number = ? WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssssi", $new_name, $new_gender, $new_phone, $new_email, $new_class, $new_register, $user_id);
    $stmt->execute();
    $stmt->close();
    $connect->close();

    header('Location: user_info.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head> 
    <title>Edit Profile</title>

    
</head>
<body>
    <h1>Edit/Update Profile</h1>

    <form action="update_edit.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>"><br><br>

        <label for="gender">Gender:</label>
        <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($gender); ?>"><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <label for="class">Class:</label>
        <input type="text" id="class" name="class" value="<?php echo htmlspecialchars($class); ?>"><br><br>

        <label for="registration_number">Registration Number:</label>
        <input type="text" id="registration_number" name="registration_number" value="<?php echo htmlspecialchars($register); ?>"><br><br>

        <input type="submit" value="Update/Edit Profile">
    </form>

    <a href="user_info.php"><strong>Back to Profile</strong></a>
</body>
</html>

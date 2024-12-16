<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $class = $_POST['class'];
    $registration_number = $_POST['registration_number'];

    $sql = "UPDATE user SET name='$name', gender='$gender', phone='$phone', email='$email', class='$class', registration_number='$registration_number' WHERE id='$id'";


    if ($connect->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connect->error;
    }

    header('Location: user_list.php'); // Redirect to the main page
}
?>

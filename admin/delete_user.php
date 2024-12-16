<?php
include('connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    $sql = "DELETE FROM user WHERE id='$id'";

    if ($connect->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $connect->error;
    }

    header('Location: user_list.php'); // Redirect to the main page
}
?>

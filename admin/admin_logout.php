
<?php
session_start();

if (isset($_SESSION["user_id"]) != "") {

    header('Location: admin.php');
}


if (isset($_GET["logout"])) {
    session_destroy();
    session_unset($_SESSION["user_id"]);

    header('Location: admin.php');
    exit();
}
?>

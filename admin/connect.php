<?php
$servername="localhost";
$username="root";
$password="";
$dbname="Organization";

$connect= new mysqli($servername,$username,$password,$dbname);
if($connect->connect_error){
    die("Connection failed: Invalid server name, user name, password or database");}else {echo ("");}
    ?>

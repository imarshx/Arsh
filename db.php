<?php
$conn = mysqli_connect("localhost","root","","student_portal");

if(!$conn){
die("Connection Failed");
}

session_start();
?>
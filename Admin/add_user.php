<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("INSERT INTO admin(username,password)VALUES(?,?)");

$stmt->bind_param("ss",$username,$password);
$stmt->execute();

header("Location: users.php");
?>

<?php
include 'db.php';

$id = $_REQUEST['id'];

$stmt = $conn->prepare("UPDATE admin set status = 'enable' where id=$id ");

$stmt->execute();

header("Location: users.php");
?> 

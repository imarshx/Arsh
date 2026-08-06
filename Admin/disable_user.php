<?php
include 'db.php';

$id = $_REQUEST['id'];

$stmt = $conn->prepare("UPDATE admin set status = 'disable' where id=$id ");

$stmt->execute();

header("Location: users.php");
?>

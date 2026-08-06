<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
"DELETE FROM quick_message WHERE id=?"
);

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: quick_msg.php");
?>

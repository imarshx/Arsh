<?php
include 'db.php';

$id = $_GET['id'];

$stmt = $conn->prepare(
"DELETE FROM notes WHERE id=?"
);

$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: notes_upload.php");
?>

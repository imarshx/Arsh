<?php

include 'db.php';

if(isset($_GET['id']))
{

$id = intval($_GET['id']);

$query = $conn->query("
SELECT * FROM notes
WHERE id='$id'
");

if($query->num_rows>0)
{

$data = $query->fetch_assoc();


//increase download count

$conn->query("
UPDATE notes
SET downloads = downloads+1
WHERE id='$id'
");

$file = "notes/".$data['course']."/".$data['file_name'];


//redirect file

header("Location:".$file);
exit();

}

}

echo "File Not Found.";

?>
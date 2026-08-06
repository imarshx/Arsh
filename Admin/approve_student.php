<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$rollno = $_GET['rollno'];

$conn->query("UPDATE student_details SET status='Approve' WHERE rollno = $rollno");

echo $rollno;

echo "<script>alert('Approve successfully!');</script>";

echo "
            <script>
            window.location.href='dashboard.php';
            </script>
            ";

//header("Location: dashboard.php");
?>

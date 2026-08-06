<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$message = $_GET['message'];

if($conn->query("DELETE FROM feedback WHERE message = '$message'"))
    {
        echo "<script>alert('Delete successfully!');</script>";
        
        echo "
            <script>
            window.location.href='feedback.php';
            </script>
            ";
    }
else{
    echo "<script>alert('Delete Failed !!!');</script>";
}

//header("Location: dashboard.php");
?>

<?php
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admin WHERE username='$username'");

$stmt->execute();

$result = $stmt->get_result();

$status ="enable";

if($result->num_rows > 0){

    $admin = $result->fetch_assoc();

    if($password==$admin['password']){

        if($status == $admin['status']){
        
        $_SESSION['admin'] = $admin['username'];
        
        header("Location: dashboard.php");
        
        exit();

        }
    else{
        echo "User is Disable";
    }

    }
}
else{
    echo "Invalid Login";
}
?>

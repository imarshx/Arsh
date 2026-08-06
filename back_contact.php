<?php
include "db.php";

if(isset($_POST['submit']))
{
    
    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];

    $sql="INSERT INTO contact(name,email,subject,message)
    VALUES('$name','$email','$subject','$message')";

    mysqli_query($conn,$sql);

    echo "<script>
    alert('Message Sent Successfully');
    </script>";
    
    echo "
            <script>
            window.location.href='index.php';
            </script>
            ";

}
?>
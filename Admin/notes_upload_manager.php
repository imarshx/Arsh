<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}


/* Upload Notes */

if(isset($_POST['upload']))
{
    $course = $_POST['course'];
    $title = $_POST['title'];

    $file_name = $_FILES['pdf']['name'];
    $tmp_name = $_FILES['pdf']['tmp_name'];

    $extension = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

    // Allow only PDF files
    if($extension != "pdf")
    {
        echo "<script>alert('Only PDF files are allowed.');</script>";
    }
    else
    {

        // Create unique file name
        $new_name = $file_name;

        // Folder according to course
        $folder = "notes/".$course."/";

        // Create folder automatically
        if(!file_exists($folder))
        {
            mkdir($folder,0777,true);
        }

        if(move_uploaded_file($tmp_name,$folder.$new_name))
        {

            $query = $conn->query("
            INSERT INTO notes(course,title,file_name)
            VALUES('$course','$title','$new_name')
            ");

            if($query)
            {
                echo "<script>
                alert('Notes Uploaded Successfully.');
                window.location='dashboard.php';
                </script>";
            }
            else
            {
                echo "<script>alert('Database Error.');</script>";
            }

        }
        else
        {
            echo "<script>alert('File Upload Failed.');</script>";
        }

    }

}
?>

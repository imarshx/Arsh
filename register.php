<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration - Government Polytechnic College</title>
  <link rel="icon" type="image/png" href="logo/psbte.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <div class="auth-container">
    <div class="auth-bg-shapes">
      <div class="auth-shape"></div>
      <div class="auth-shape"></div>
      <div class="auth-shape"></div>
    </div>
    
    <div class="auth-box">
      <h1 class="text-gradient">Student Registration</h1>
      <p class="auth-subtitle">Government Polytechnic College</p>

      <?php

      include 'db.php';

      if(isset($_POST['register']))
      {

      $name=$_POST['fullname'];
      $rollno=$_POST['rollno'];
      $mobile=$_POST['mobile'];
      $course=$_POST['course'];
      $password=$_POST['password'];


      // PHOTO UPLOAD

      $photo_name = "";

      if(isset($_FILES['photo']) && $_FILES['photo']['error']==0)
      {
          $folder = "Admin/uploads/";

          //create folder automatically
          if(!is_dir($folder))
          {
              mkdir($folder,0777,true);
          }

          $photo_name = time()."_".$_FILES['photo']['name'];

          $target = $folder.$photo_name;

          move_uploaded_file($_FILES['photo']['tmp_name'],$target);
      }



      // INSERT QUERY

      $sql="INSERT INTO students
      (fullname,rollno,mobile,course,password,photo)

      VALUES

      ('$name','$rollno','$mobile','$course','$password','$photo_name')";


      if(mysqli_query($conn,$sql))
      {

      echo "<script>
      alert('Registration Successful');
      window.location='login.php';
      </script>";

      }

      }

      ?>

      <form method="post" enctype="multipart/form-data" class="auth-form">
        <div class="form-group">
          <label><i class="fas fa-user"></i> Full Name</label>
          <input type="text" name="fullname" placeholder="Enter Full Name" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-id-card"></i> Roll Number</label>
          <input type="text" name="rollno" placeholder="Enter Roll Number" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-phone"></i> Mobile Number</label>
          <input type="text" name="mobile" placeholder="Enter Mobile Number" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-book"></i> Course Name</label>
          <input type="text" name="course" placeholder="Enter Course Name" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-lock"></i> Password</label>
          <input type="password" name="password" placeholder="Create Password" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-camera"></i> Upload Photo</label>
          <input type="file" name="photo" accept="image/*" required>
        </div>
        
        <button type="submit" name="register" class="auth-btn">
          <i class="fas fa-user-plus"></i> Register
        </button>
        
        <div class="auth-footer">
          Already Registered?<br>
          <a href="login.php">Login From Here</a>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

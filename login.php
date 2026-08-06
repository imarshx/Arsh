<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Login - Government Polytechnic College</title>
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
      <h1 class="text-gradient">Student Login</h1>
      <p class="auth-subtitle">Government Polytechnic College</p>
      
      <?php

      include 'db.php';


      if(isset($_POST['login'])){

      $rollno=$_POST['rollno'];

      $password=$_POST['password'];

      $result=$conn->query("SELECT * FROM student_details WHERE rollno='$rollno'");

      $row=mysqli_fetch_assoc($result);


      if($result->num_rows>0 && $password==$row['adhar']){

      $_SESSION['fname']=$row['student_f_name'];
      $_SESSION['lname']=$row['student_l_name'];

      header("Location:dashboard.php");

      }

      else{

      echo "<script>alert('Invalid Login Details');</script>";

      }

      }

      ?>

      <form method="POST" class="auth-form">
        <div class="form-group">
          <label><i class="fas fa-id-card"></i> Roll Number</label>
          <input type="text" name="rollno" placeholder="Enter Roll Number" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-lock"></i> Password</label>
          <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        
        <button type="submit" name="login" class="auth-btn">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
        
        <div class="auth-footer">
          <a href="forgot_pass.php">Forgot Password?</a><br>
          <a href="contact.php">Contact College Administrator</a>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

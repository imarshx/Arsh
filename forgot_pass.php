<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Government Polytechnic College</title>
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
      <h1 class="text-gradient">Forgot Password</h1>
      <p class="auth-subtitle">Reset your account password</p>

      <?php

      include 'db.php';

      $message="";

      if(isset($_POST['reset']))
      {

      $rollno = $_POST['rollno'];
      $mobile = $_POST['mobile'];
      $newpassword = $_POST['password'];

      $query = $conn->query("SELECT * FROM student_details
      WHERE rollno='$rollno'
      AND mobile='$mobile'");


      if($query->num_rows>0)
      {

      $password = $newpassword;

      $conn->query("UPDATE student_details
      SET adhar='$password'
      WHERE rollno='$rollno'");

      $message = "Password Changed Successfully.";

      echo "<script>
      alert('Password Changed Successfully.');
      window.location='login.php';
      </script>";

      }
      else{

      $message = "Invalid Roll Number or Mobile Number.";

      }

      }

      ?>

      <?php if($message!=""): ?>
      <div class="glass" style="padding: 15px; margin-bottom: 20px; text-align: center; color: var(--accent); border-left: 4px solid var(--accent);">
        <?php echo $message; ?>
      </div>
      <?php endif; ?>

      <form method="POST" class="auth-form">
        <div class="form-group">
          <label><i class="fas fa-id-card"></i> Roll Number</label>
          <input type="text" name="rollno" placeholder="Enter Roll Number" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-phone"></i> Mobile Number</label>
          <input type="text" name="mobile" placeholder="Enter Registered Mobile Number" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-lock"></i> New Password</label>
          <input type="password" name="password" placeholder="Create New Password" required>
        </div>
        
        <button type="submit" name="reset" class="auth-btn">
          <i class="fas fa-key"></i> Reset Password
        </button>
        
        <div class="auth-footer">
          Remember Your Password?<br>
          <a href="login.php">Back to Login</a>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

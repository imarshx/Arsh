<?php
include 'db.php';

if(!isset($_SESSION['fname']))
{
    header("Location:login.php");
    exit();
}

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];

/* Fetch Student Details */

$query = $conn->query("SELECT * FROM student_details WHERE student_f_name='$fname'");
$data = $query->fetch_assoc();

/* Feedback */

if(isset($_POST['send']))
{
$rollno = $data['rollno'];
$photo = $data['student_photo'];
$class = $data['student_class'];
$student_name = $data['student_f_name'] . " " . $data['student_l_name'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$conn->query("INSERT INTO feedback(rollno,photo,student_name,class,subject,message)
VALUES('$rollno','$photo','$student_name','$class','$subject','$message')");

echo "<script>alert('Feedback Sent Successfully');</script>";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
<link rel="icon" type="image/png" href="logo/psbte.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="styles.css">
<style>
  .message-content {
      color: var(--text);
      line-height: 1.6;
      background: rgba(255,255,255,0.05);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
    }
</style>
</head>
<body>

  <!-- Dashboard Header -->
  <div class="dashboard-header">
    <div class="dashboard-nav">
      <div class="dashboard-welcome">
        Welcome  <strong><?php echo $data['student_f_name'] . " " . $data['student_l_name']; ?></strong>
      </div>
      <div class="dashboard-actions">
        <a href="student_message_from_admin.php?rollno=<?php echo $data['rollno'];?>" class="btn btn-secondary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-envelope"></i> Message
        </a>
        <a href="syllabus.php?course=<?php echo $data['student_class']; ?>" class="btn btn-secondary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-book"></i> Syllabus & Notes
        </a>
        <a href="logout.php" class="btn btn-primary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </div>

  <div class="dashboard-container">

    <!-- Student Profile Card -->
    <div class="student-profile reveal">
      <div class="profile-photo-section">
        <img style="margin-top:40px;" src="Admin/uploads/<?php echo $data['student_photo']; ?>" alt="Profile Photo" class="profile-photo">
      </div>
      
      <div class="profile-details-card glass">
        <h3><i class="fas fa-user-circle"></i> Student Details</h3>
        <div class="detail-row">
          <span class="detail-label">Name</span>
          <span class="detail-value"><?php echo $data['student_f_name'] . " " . $data['student_l_name']; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Roll Number</span>
          <span class="detail-value"><?php echo $data['rollno']; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Class</span>
          <span class="detail-value"><?php echo $data['student_class']; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Contact</span>
          <span class="detail-value"><?php echo $data['phone']; ?></span>
        </div>
      </div>
    </div>

    <!-- Result Card -->
    <div class="result-card glass reveal">
      <h3><i class="fas fa-chart-bar"></i> Your Result</h3>
      <?php
      $rollno = $data['rollno'];
      $query = $conn->query("
      SELECT * FROM student_result
      WHERE rollno='$rollno'
      ");

      if($query->num_rows > 0)
      {
          $data = $query->fetch_assoc();
      ?>
      
      <div class="result-percentage"><?php echo $data['percentage']; ?>%</div>
      
      <?php 
      
      if($data['status'] == 'Pass')
          {
              ?>
              <span class="result-status result-pass">
                <i class="fas fa-check-circle"></i> <?php echo $data['status']; ?>
              </span>
              <?php
          }
      else
          {
              ?>
              <span class="result-status result-fail">
                <i class="fas fa-times-circle"></i> <?php echo $data['status']; ?>
              </span>
              <?php
          }

      ?>
      
      <?php
      }
      else
      {
          ?>
          <h4 style="color: var(--text-secondary); margin-top: 20px;">Result not declared yet.</h4>
          <?php
      }

      ?>
    </div>

    <!-- Photo Upload -->
    <div class="dashboard-section">
      <div class="glass reveal" style="padding: 30px;">
        <h3 style="margin-bottom: 20px; color: white;"><i class="fas fa-camera"></i> Change Profile Photo</h3>
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label style="display: block; margin-bottom: 10px; color: white;">Select Photo</label>
            <input style="width:100%;" type="file" name="photo" accept="image/*" required style="background: var(--glass); border: 1px solid var(--glass-border); color: white;">
          </div>
          <button style="margin-left:40%;" type="submit" name="update_photo" class="btn btn-primary btn-3d">
            <i class="fas fa-upload"></i> Update Photo
          </button>
        </form>
      </div>
    </div>
    <br>
    <!-- Feedback Section -->
    <div class="dashboard-section" >
      <div class="feedback-card glass reveal">
        <h3  style="width:97%;margin:6px -15px 5px 15px;"><i class="fas fa-comment-dots"></i> Send Feedback</h3>
        <form method="POST" >
          <div class="form-group">
            <label style="display: block; margin-left:15px; margin-bottom: 10px; color: white;">Subject :</label>
            <input style="width:97%;margin:0px -15px 0px 15px;" type="text" name="subject" class="form-control" placeholder="Enter Subject" required>
          </div>
          
          <div class="form-group">
            <label style="display: block; margin-left:15px; margin-bottom: 10px; color: white;">Message :</label>
            <textarea style="width:97%;margin:0px -15px 0px 15px;" name="message" class="form-control" rows="5" placeholder="Write your feedback here..." required></textarea>
          </div>
          
          <button style="margin-left:40%;" type="submit" name="send" class="submit-btn btn btn-primary btn-3d">
            <i class="fas fa-paper-plane"></i> Send Feedback
          </button>
          <br>
        </form>
        <br>
      </div>
    </div>
    <br>
    <!-- Quick Messages -->
    <div class="dashboard-section">
      <div class="glass reveal" style="padding: 30px;">
        <h3 style="margin-bottom: 25px; color: white;"><i class="fas fa-bell"></i> Quick Messages</h3>
        <?php
        $rollno = $data['rollno'];

        $query = $conn->query("
        SELECT *
        FROM quick_message
        WHERE rollno='ALL'
        OR rollno='$rollno'
        ORDER BY id DESC
        ");

        if($query->num_rows > 0)
        {
            while($row = $query->fetch_assoc())
            {
        ?>

        <div class="quick-message">
          <div class="message-content">
            <h4><?php echo nl2br($row['message']); ?></h4>

            <div class="date">
              <i class="far fa-clock"></i> Posted On: <?php echo $row['created_at']; ?>
            </div>
          </div>
        </div>

        <?php
            }
        }
        else
        {
        ?>
            <h4 style="color: var(--text-secondary);">No Messages Available.</h4>
        <?php
        }
        ?>
      </div>
    </div>

  </div>

  <?php
  /* UPDATE PROFILE PHOTO */

  if(isset($_POST['update_photo']))
  {

      $photo_name = $_FILES['photo']['name'];
      $temp_name = $_FILES['photo']['tmp_name'];

      $extension = strtolower(pathinfo($photo_name,PATHINFO_EXTENSION));

      $allowed = array("jpg","jpeg","png","webp");

      if(in_array($extension,$allowed))
      {
          $new_name = time()."_".$photo_name;

          move_uploaded_file($temp_name,"Admin/uploads/".$new_name);

          $conn->query("UPDATE student_details
          SET student_photo='$new_name'
          WHERE student_f_name='$fname'");

          echo "<script>
          alert('Profile Photo Updated Successfully');
          window.location='dashboard.php';
          </script>";

      }
      else
      {
          echo "<script>alert('Only JPG, JPEG, PNG and WEBP files are allowed.');</script>";
      }

  }
  ?>

  <script src="script.js"></script>
</body>
</html>

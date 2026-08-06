<?php
include 'db.php';

if(!isset($_SESSION['fname']))
{
    header("Location:login.php");
    exit();
}

$fname = $_SESSION['fname'];


/* Fetch Student Details */

$query = $conn->query("SELECT * FROM student_details WHERE student_f_name='$fname'");
$data = $query->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Messages - Government Polytechnic College</title>
  <link rel="icon" type="image/png" href="logo/psbte.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Dashboard Header -->
  <div class="dashboard-header">
    <div class="dashboard-nav">
      <div class="dashboard-welcome">
        Welcome <strong><?php echo $data['student_f_name'] . " " . $data['student_l_name']; ?></strong>
      </div>
      <div class="dashboard-actions">
        <a href="dashboard.php" class="btn btn-secondary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-home"></i> Home
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
    <div class="section-header reveal">
      <h2><i class="fas fa-envelope-open-text"></i> Your Messages</h2>
      <p>Feedback and replies from administration</p>
    </div>

    <?php

    $rollno = $_GET['rollno'];

    $result = $conn->query("
    SELECT * FROM feedback
    WHERE rollno='$rollno'
    ");

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
    ?>
    
    <div class="glass reveal" style="padding: 30px; margin-bottom: 25px;">
      <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
          <i class="fas fa-user"></i>
        </div>
        <div>
          <h4 style="color: white; margin-bottom: 5px;"><?php echo htmlspecialchars($row['subject']); ?></h4>
          <p style="color: var(--text-secondary); font-size: 0.85rem;">By: <?php echo htmlspecialchars($row['student_name']); ?></p>
        </div>
      </div>
      
      <div style="background: var(--glass); padding: 20px; border-radius: 12px; margin-bottom: 20px; border-left: 3px solid var(--primary);">
        <p style="color: var(--text); line-height: 1.7;">
          <?php echo nl2br(htmlspecialchars($row['message'])); ?>
        </p>
      </div>
      
      <div style="background: rgba(108, 99, 255, 0.05); padding: 20px; border-radius: 12px; border-left: 3px solid var(--secondary);">
        <h4 style="color: var(--secondary); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
          <i class="fas fa-reply"></i> Admin Reply
        </h4>
        <?php
        if(empty($row['reply']))
        {
            echo "<span style='color: var(--text-secondary);'>Waiting for reply...</span>";
        }
        else
        {
            echo "<p style='color: var(--text); line-height: 1.7;'>".nl2br(htmlspecialchars($row['reply']))."</p>";
        }
        ?>
      </div>
    </div>

    <?php
    }
    }
    else
    {
    ?>
    <div class="glass reveal" style="padding: 60px; text-align: center;">
      <i class="fas fa-inbox" style="font-size: 4rem; color: var(--text-secondary); margin-bottom: 20px;"></i>
      <h3 style="color: var(--text-secondary);">No Messages Available</h3>
      <p style="color: var(--text-secondary); margin-top: 10px;">You have not sent any feedback yet.</p>
    </div>
    <?php
    }
    ?>

  </div>

  <script src="script.js"></script>
</body>
</html>

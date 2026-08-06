<?php
include 'db.php';

if(!isset($_SESSION['fname']))
{
    header("Location:login.php");
    exit();
}

$fname=$_SESSION['fname'];

$course = $_GET['course'];


$result = $conn->query("
SELECT * FROM notes
WHERE course='$course'
ORDER BY id DESC
");

$query = $conn->query("SELECT * FROM student_details WHERE student_f_name='$fname'");
$data = $query->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Syllabus & Notes - Government Polytechnic College</title>
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
        <a href="student_message_from_admin.php?rollno=<?php echo $data['rollno'];?>" class="btn btn-secondary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-envelope"></i> Message
        </a>
        <a href="logout.php" class="btn btn-primary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </div>
  </div>

  <div class="dashboard-container">
    <div class="section-header reveal">
      <h2><?php echo "Course : ".$course; ?></h2>
      <p>Syllabus & Notes</p>
    </div>

    <?php

    if($result->num_rows>0)
    {
    while($row = $result->fetch_assoc())
    {
    ?>

    <div class="glass reveal" style="padding: 25px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
      <div style="flex: 1; min-width: 250px;">
        <h3 style="margin-bottom: 10px; color: white;">
          <i class="fas fa-file-pdf" style="color: var(--accent);"></i> 
          <?php echo htmlspecialchars($row['title']); ?>
        </h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem;">
          <?php echo htmlspecialchars($row['file_name']); ?>
        </p>
      </div>
      
      <div style="display: flex; align-items: center; gap: 15px;">
        <span class="course-tag" style="background: var(--glass); border: 1px solid var(--glass-border);">
          <i class="fas fa-download"></i> <?php echo $row['downloads']; ?> downloads
        </span>
        <a href="download.php?id=<?php echo $row['id'];?>" class="btn btn-primary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-download"></i> Download PDF
        </a>
      </div>
    </div>

    <?php
    }

    }
    else
    {
    ?>
    <div class="glass reveal" style="padding: 40px; text-align: center;">
      <i class="fas fa-folder-open" style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 20px;"></i>
      <h3 style="color: var(--text-secondary);">No Notes Found</h3>
      <p style="color: var(--text-secondary); margin-top: 10px;">Notes for this course will be uploaded soon.</p>
    </div>
    <?php
    }
    ?>

  </div>

  <script src="script.js"></script>
</body>
</html>

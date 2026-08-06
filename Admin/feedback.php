<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Feedback - Admin Panel</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">
  <style>
    .admin-sidebar {
      width: 260px;
      height: 100vh;
      background: linear-gradient(180deg, #0a0a1a 0%, #1a1a2e 100%);
      position: fixed;
      padding: 25px;
      border-right: 1px solid var(--glass-border);
      overflow-y: auto;
      z-index: 100;
      transition: transform 0.3s ease;
    }
    .admin-sidebar h2 {
      color: #fff;
      margin-bottom: 30px;
      font-size: 1.3rem;
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .admin-sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: var(--text-secondary);
      text-decoration: none;
      padding: 12px 15px;
      margin: 8px 0;
      border-radius: 10px;
      transition: all 0.3s;
      font-size: 0.95rem;
    }
    .admin-sidebar a:hover {
      background: var(--glass);
      color: white;
      transform: translateX(5px);
    }
    .admin-sidebar a i {
      width: 20px;
      text-align: center;
    }
    .admin-content {
      margin-left: 290px;
      padding: 30px;
      width: calc(100% - 290px);
    }
    .admin-header {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 25px 30px;
      margin-bottom: 30px;
    }
    .feedback-card {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 25px;
      margin-bottom: 25px;
      transition: all 0.3s;
    }
    .feedback-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    .badge-count {
      background: white;
      color: #1e293b;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 700;
      margin-left: auto;
    }
    .btn-admin {
      padding: 10px 24px;
      border-radius: 8px;
      border: none;
      cursor: pointer;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.3s;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn-admin-primary {
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      color: white;
    }
    .btn-admin-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(108, 99, 255, 0.3);
    }
    .btn-admin-secondary {
      background: rgba(255,255,255,0.1);
      color: white;
      border: 1px solid var(--glass-border);
    }
    .btn-admin-secondary:hover {
      background: rgba(255,255,255,0.15);
    }
    @media (max-width: 768px) {
      .admin-sidebar {
        transform: translateX(-100%);
      }
      .admin-sidebar.active {
        transform: translateX(0);
      }
      .admin-content {
        margin-left: 0;
        width: 100%;
      }
      .menu-toggle {
        display: flex;
        flex-direction: column;
        gap: 6px;
        cursor: pointer;
        padding: 5px;
        z-index: 1001;
        position: absolute;
        right: 25px;
        top: 25px;
      }
      .menu-toggle span {
        width: 28px;
        height: 3px;
        background: white;
        border-radius: 3px;
        transition: all 0.3s;
      }
    }
    @media (max-width: 480px) {
      .feedback-card {
        padding: 20px;
      }
      .feedback-card .student-info {
        flex-direction: column;
        align-items: flex-start;
      }
      .feedback-actions {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="menu-toggle" id="menuToggle">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div class="admin-sidebar" id="sidebar">
    <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
    
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="admission.php"><i class="fas fa-user-plus"></i> Admission <span class="badge-count"><?php
        $count = $conn->query("SELECT COUNT(*) as total FROM student_details");
        $rowCount = $count->fetch_assoc();
        echo $rowCount['total'];
        ?></span>
    </a>
    <a href="check_student.php"><i class="fas fa-users"></i> Students</a>
    <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
    <a href="notes_upload.php"><i class="fas fa-upload"></i> Notes</a>
    <a href="quick_msg.php"><i class="fas fa-bell"></i> Quick Message</a>
    <a href="exam.php"><i class="fas fa-clipboard-check"></i> Exam Result</a>
    <a href="users.php"><i class="fas fa-users-cog"></i> Users <span class="badge-count"><?php
        $count = $conn->query("SELECT COUNT(*) as total FROM admin");
        $rowCount = $count->fetch_assoc();
        echo $rowCount['total'];
        ?></span>
    </a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="admin-content">
    <div class="admin-header">
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-comments" style="color: var(--primary);"></i> Student Feedback</h1>
    </div>

    <?php
    $result = $conn->query("SELECT * FROM feedback ORDER BY id DESC");
    
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
    ?>
    
    <div class="feedback-card reveal">
      <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;" class="student-info">
        <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="Student" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);" onerror="this.src='uploads/000.jpg'">
        <div>
          <h4 style="color: white; margin-bottom: 5px;"><?php echo htmlspecialchars($row['student_name']); ?></h4>
          <p style="color: var(--text-secondary); font-size: 0.85rem;"><?php echo htmlspecialchars($row['class']); ?> | Roll: <?php echo htmlspecialchars($row['rollno']); ?></p>
        </div>
      </div>
      
      <div style="background: var(--glass); padding: 20px; border-radius: 12px; margin-bottom: 15px; border-left: 3px solid var(--primary);">
        <h4 style="color: var(--primary); margin-bottom: 10px;"><?php echo htmlspecialchars($row['subject']); ?></h4>
        <p style="color: var(--text); line-height: 1.7;"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
      </div>
      
      <div style="display: flex; gap: 10px; flex-wrap: wrap;" class="feedback-actions">
        <a href="reply_feedback.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;">
          <i class="fas fa-reply"></i> Reply
        </a>
        <a href="delete_feedback.php?message=<?php echo $row['message']; ?>" class="btn btn-secondary btn-3d" style="padding: 10px 20px; font-size: 0.9rem;" onclick="return confirm('Are you sure?')">
          <i class="fas fa-trash"></i> Delete
        </a>
      </div>
    </div>
    
    <?php
      }
    } else {
    ?>
    <div class="glass reveal" style="padding: 60px; text-align: center;">
      <i class="fas fa-inbox" style="font-size: 4rem; color: var(--text-secondary); margin-bottom: 20px;"></i>
      <h3 style="color: var(--text-secondary);">No Feedback Yet</h3>
      <p style="color: var(--text-secondary); margin-top: 10px;">Student feedback will appear here.</p>
    </div>
    <?php
    }
    ?>
  </div>

  <script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('active');
      menuToggle.classList.toggle('active');
    });

    sidebar.addEventListener('click', (e) => {
      if(e.target === sidebar) {
        sidebar.classList.remove('active');
        menuToggle.classList.remove('active');
      }
    });
  </script>
</body>
</html>

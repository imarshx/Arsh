<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? '';

$stmt = $conn->prepare("SELECT * FROM feedback WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();

if(!$row) {
    header("Location: feedback.php");
    exit();
}

if(isset($_POST['send']))
{
    $reply = mysqli_real_escape_string($conn, $_POST['reply']);

    $stmt = $conn->prepare("UPDATE feedback SET reply=? WHERE id=?");
    $stmt->bind_param("si", $reply, $id);
    $stmt->execute();
    $stmt->close();

    echo "<script>
    alert('Reply Sent Successfully');
    window.location='feedback.php';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reply Feedback - Admin Panel</title>
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
    .form-group-admin {
      margin-bottom: 20px;
    }
    .form-group-admin label {
      display: block;
      margin-bottom: 8px;
      color: var(--text-secondary);
      font-size: 0.9rem;
      font-weight: 500;
    }
    .form-control-admin {
      width: 100%;
      padding: 14px 18px;
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s;
      font-family: inherit;
    }
    .form-control-admin:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 20px rgba(108, 99, 255, 0.2);
    }
    textarea.form-control-admin {
      resize: vertical;
      min-height: 120px;
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-reply" style="color: var(--primary);"></i> Reply to Feedback</h1>
    </div>

    <div class="glass reveal" style="padding: 30px; max-width: 100%; margin-bottom: 30px;">
      <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; color: white;">
          <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" alt="Student" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);" onerror="this.src='uploads/000.jpg'">
        </div>
        <div>
          <h4 style="color: white; margin-bottom: 5px;"><?php echo htmlspecialchars($row['student_name']); ?></h4>
          <p style="color: var(--text-secondary); font-size: 0.85rem;">Roll: <?php echo htmlspecialchars($row['rollno']); ?> | Class: <?php echo htmlspecialchars($row['class']); ?></p>
        </div>
      </div>
      
      <div style="background: var(--glass); padding: 20px; border-radius: 12px; border-left: 3px solid var(--primary); margin-bottom: 20px;">
        <h4 style="color: var(--primary); margin-bottom: 10px;"><?php echo htmlspecialchars($row['subject']); ?></h4>
        <p style="color: var(--text); line-height: 1.7;"><?php echo nl2br(htmlspecialchars($row['message'])); ?></p>
      </div>

      <form method="POST">
        <div class="form-group-admin">
          <label><i class="fas fa-reply"></i> Your Reply</label>
          <textarea name="reply" class="form-control-admin" placeholder="Write your reply here..." required><?php echo htmlspecialchars($row['reply'] ?? ''); ?></textarea>
        </div>
        
        <button type="submit" name="send" class="btn btn-primary" style="width: 100%; padding: 12px; margin-bottom: 15px;">
          <i class="fas fa-paper-plane"></i> Send Reply
        </button>
        
        <div style="text-align: center;">
          <a href="feedback.php" class="btn btn-secondary" style="padding: 8px 20px;">
            <i class="fas fa-arrow-left"></i> Back to Feedback
          </a>
        </div>
      </form>
    </div>
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

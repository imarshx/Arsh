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
  <title>Students - Admin Panel</title>
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
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
    }
    .admin-card {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 25px;
      text-align: center;
      transition: all 0.3s;
    }
    .admin-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.3);
    }
    .admin-card h3 {
      color: white;
      margin-bottom: 10px;
      font-size: 1.1rem;
    }
    .admin-card .count {
      font-size: 2.5rem;
      font-weight: 800;
      background: linear-gradient(135deg, var(--primary), var(--secondary));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
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
    .btn-class {
      width: 100%;
      padding: 14px;
      background: var(--glass);
      border: 1px solid var(--glass-border);
      color: white;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
      transition: all 0.3s;
      font-size: 0.95rem;
    }
    .btn-class:hover {
      background: var(--primary);
      border-color: var(--primary);
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(108, 99, 255, 0.3);
    }
    .stats-row {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
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
      .admin-header {
        flex-direction: column;
        align-items: flex-start;
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
      <div>
        <h1 style="color: white; font-size: 1.8rem; margin-bottom: 5px;">Welcome <?php echo htmlspecialchars($_SESSION['admin']); ?></h1>
        <p style="color: var(--text-secondary);">Manage your institution efficiently</p>
      </div>
      <div class="admin-card" style="padding: 15px 25px; margin-bottom: 0;">
        <h3 style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 5px;">Total Users</h3>
        <div class="count" style="font-size: 1.8rem;">
          <?php
          $count = $conn->query("SELECT COUNT(*) as total FROM admin");
          $rowCount = $count->fetch_assoc();
          echo $rowCount['total'];
          ?>
        </div>
      </div>
    </div>

    <div class="admin-card" style="padding: 30px; margin-bottom: 30px;">
      <h2 style="color: white; margin-bottom: 25px; text-align: center;"><i class="fas fa-layer-group"></i> Classes</h2>
      <form method="post" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px;">
          <?php
          $classes = ['1','2','3','4','5','6','7','8','9','10','11','12','cse','it','ba'];
          foreach($classes as $class):
            $count = $conn->prepare("SELECT COUNT(*) as total FROM student_details where student_class = ?");
            $count->bind_param("s", $class);
            $count->execute();
            $result = $count->get_result();
            $classCount = $result->fetch_assoc();
            $count->close();
          ?>
          <button type="submit" name="<?php echo $class; ?>" class="btn-class">
            <?php echo ucfirst($class); ?> Class - <?php echo $classCount['total']; ?>
          </button>
          <?php endforeach; ?>
        </div>
      </form>
    </div>

    <div class="stats-row">
      <div class="admin-card">
        <h3>Total Students</h3>
        <div class="count">
          <?php
          $count = $conn->query("SELECT COUNT(*) as total FROM student_details");
          $rowCount = $count->fetch_assoc();
          echo $rowCount['total'];
          ?>
        </div>
        <a href="total_students_list.php?s_status=total" class="btn btn-secondary btn-3d" style="margin-top: 15px; padding: 8px 20px; font-size: 0.85rem;">View All</a>
      </div>
      
      <div class="admin-card">
        <h3>Approved Students</h3>
        <div class="count">
          <?php
          $count = $conn->query("SELECT COUNT(*) as total FROM student_details where status='approve'");
          $rowCount = $count->fetch_assoc();
          echo $rowCount['total'];
          ?>
        </div>
        <a href="students_list.php?s_status=approve" class="btn btn-secondary btn-3d" style="margin-top: 15px; padding: 8px 20px; font-size: 0.85rem;">View All</a>
      </div>
      
      <div class="admin-card">
        <h3>Cancelled Students</h3>
        <div class="count">
          <?php
          $count = $conn->query("SELECT COUNT(*) as total FROM student_details where status='cancel'");
          $rowCount = $count->fetch_assoc();
          echo $rowCount['total'];
          ?>
        </div>
        <a href="students_list.php?s_status=cancel" class="btn btn-secondary btn-3d" style="margin-top: 15px; padding: 8px 20px; font-size: 0.85rem;">View All</a>
      </div>
    </div>
  </div>

  <?php
  $classes = ['1','2','3','4','5','6','7','8','9','10','11','12','cse','it','ba'];
  foreach($classes as $class):
    if(isset($_POST[$class]))
    {
        echo "
            <script>
            window.location.href='students.php?name=$class';
            </script>
            ";
    }
  endforeach;
  ?>

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

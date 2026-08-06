<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$users = $conn->query("SELECT * FROM admin");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users - Admin Panel</title>
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
    }
    .admin-header {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 25px 30px;
      margin-bottom: 30px;
    }
    .admin-card {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 25px;
      margin-bottom: 20px;
    }
    .form-control-admin {
      width: 100%;
      padding: 12px 16px;
      background: rgba(255,255,255,0.05);
      border: 1px solid var(--glass-border);
      border-radius: 10px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s;
      font-family: inherit;
    }
    .form-control-admin:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 15px rgba(108, 99, 255, 0.2);
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
    .btn-admin-danger {
      background: linear-gradient(135deg, #ef4444, #dc2626);
      color: white;
    }
    .btn-admin-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(239, 68, 68, 0.3);
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

  <div class="menu-toggle" id="menuToggle"><span></span><span></span><span></span></div>
  <div class="admin-sidebar" id="sidebar">
    <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
    
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="admission.php"><i class="fas fa-user-plus"></i> Admission <span class="badge-count"><?php
        $count = $conn->query("SELECT COUNT(*) as total FROM student_details");
        $row = $count->fetch_assoc();
        echo $row['total'];
        ?></span>
    </a>
    <a href="check_student.php"><i class="fas fa-users"></i> Students</a>
    <a href="feedback.php"><i class="fas fa-comments"></i> Feedback</a>
    <a href="notes_upload.php"><i class="fas fa-upload"></i> Notes</a>
    <a href="quick_msg.php"><i class="fas fa-bell"></i> Quick Message</a>
    <a href="exam.php"><i class="fas fa-clipboard-check"></i> Exam Result</a>
    <a href="users.php"><i class="fas fa-users-cog"></i> Users <span class="badge-count"><?php
        $count = $conn->query("SELECT COUNT(*) as total FROM admin");
        $row = $count->fetch_assoc();
        echo $row['total'];
        ?></span>
    </a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <div class="admin-content">
    <div class="admin-header">
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-users-cog" style="color: var(--primary);"></i> User Management</h1>
    </div>

    <div class="admin-card">
      <h3 style="color: white; margin-bottom: 20px;"><i class="fas fa-user-plus"></i> Add New User</h3>
      <form action="add_user.php" method="POST" style="display: flex; gap: 15px; flex-wrap: wrap; align-items: flex-end;">
        <div style="flex: 1; min-width: 200px;">
          <label style="display: block; margin-bottom: 8px; color: var(--text-secondary); font-size: 0.9rem;">Username</label>
          <input type="text" name="username" class="form-control-admin" placeholder="Enter Username" required>
        </div>
        <div style="flex: 1; min-width: 200px;">
          <label style="display: block; margin-bottom: 8px; color: var(--text-secondary); font-size: 0.9rem;">Password</label>
          <input type="password" name="password" class="form-control-admin" placeholder="Enter Password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-3d">
          <i class="fas fa-plus"></i> Add User
        </button>
      </form>
    </div>

    <div class="admin-card">
      <h3 style="color: white; margin-bottom: 20px;"><i class="fas fa-list"></i> All Users</h3>
      <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px;">
        <?php
        while($user = $users->fetch_assoc()) {
        ?>
        <div class="glass reveal" style="padding: 20px; display: flex; justify-content: space-between; align-items: center;">
          <div>
            <h4 style="color: white; margin-bottom: 5px;"><i class="fas fa-user" style="color: var(--primary);"></i> <?php echo htmlspecialchars($user['username']); ?></h4>
            <p style="color: var(--text-secondary); font-size: 0.85rem;">Admin User</p>
          </div>
          <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-admin-danger" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Are you sure?')">
            <i class="fas fa-trash"></i>
          </a>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <script>
    const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar');
    menuToggle.addEventListener('click',()=>{sidebar.classList.toggle('active');menuToggle.classList.toggle('active');});
    sidebar.addEventListener('click',(e)=>{if(e.target===sidebar){sidebar.classList.remove('active');menuToggle.classList.remove('active');}});
  </script>
</body>
</html>

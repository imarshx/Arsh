<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
/*if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $name = $_REQUEST['name'];
        echo $name;

        if($name = $_REQUEST['1'])
            {
                echo $name;
            }
        else{
            if($name = $_REQUEST['2'])
                {
                    echo $name;
                }
        }
        
    }
*/

$name = "";
//echo $name;
if(!isset($_GET['name']))
    {
    }
else
    {
        $name = $_GET['name'];
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-users" style="color: var(--primary);"></i> Students - <?php echo ucfirst($name); ?></h1>
    </div>

    <div class="glass" style="padding: 0; overflow: hidden;">
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr style="background: rgba(108, 99, 255, 0.1);">
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Roll No</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Name</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Class</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Phone</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Status</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM student_details WHERE student_class='$name'";
          $result = $conn->query($sql);
          
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $statusColor = $row['status'] == 'approve' ? '#10b981' : ($row['status'] == 'cancel' ? '#ef4444' : '#f59e0b');
          ?>
          <tr style="border-bottom: 1px solid var(--glass-border); transition: all 0.3s;" onmouseover="this.style.background='var(--glass)'" onmouseout="this.style.background='transparent'">
            <td style="padding: 15px; color: white;"><?php echo $row['rollno']; ?></td>
            <td style="padding: 15px; color: white;"><?php echo $row['student_f_name'] . " " . $row['student_l_name']; ?></td>
            <td style="padding: 15px; color: var(--text-secondary);"><?php echo $row['student_class']; ?></td>
            <td style="padding: 15px; color: var(--text-secondary);"><?php echo $row['phone']; ?></td>
            <td style="padding: 15px;">
              <span style="padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; background: <?php echo $statusColor; ?>20; color: <?php echo $statusColor; ?>;">
                <?php echo ucfirst($row['status']); ?>
              </span>
            </td>
            <td style="padding: 15px;">
              <a href="check_rollno.php?rollno=<?php echo $row['rollno']; ?>" class="btn btn-primary btn-3d" style="padding: 8px 16px; font-size: 0.85rem;">
                <i class="fas fa-eye"></i> View
              </a>
            </td>
          </tr>
          <?php
            }
          } else {
          ?>
          <tr>
            <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-secondary);">
              <i class="fas fa-inbox" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
              No students found in this class.
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
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
    const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar');
    menuToggle.addEventListener('click',()=>{sidebar.classList.toggle('active');menuToggle.classList.toggle('active');});
    sidebar.addEventListener('click',(e)=>{if(e.target===sidebar){sidebar.classList.remove('active');menuToggle.classList.remove('active');}});
  </script>
</body>
</html>

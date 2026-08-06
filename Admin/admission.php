<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$s_class = $_POST['rollno'] ?? '';
$row = null;

if(isset($_POST['search']) && !empty($s_class)) {
    $stmt = $conn->prepare("SELECT * FROM student_details WHERE rollno = ?");
    $stmt->bind_param("s", $s_class);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admission - Admin Panel</title>
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
    .admin-card {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 20px;
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
    .btn-admin-secondary {
      background: rgba(255,255,255,0.1);
      color: white;
      border: 1px solid var(--glass-border);
    }
    .btn-admin-secondary:hover {
      background: rgba(255,255,255,0.15);
    }
    .form-row {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }
    .student-photo {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid var(--primary);
      box-shadow: 0 0 25px rgba(108, 99, 255, 0.3);
      margin: 0 auto 20px;
    }
    .no-data-message {
      text-align: center;
      padding: 40px;
      color: var(--text-secondary);
    }
    .no-data-message i {
      font-size: 3rem;
      margin-bottom: 15px;
      display: block;
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
      .form-row {
        grid-template-columns: 1fr;
      }
      .form-row[style*="margin-bottom"] {
        display: flex;
        flex-direction: column;
        gap: 15px;
      }
    }
    @media (max-width: 480px) {
      .btn-admin {
        width: 100%;
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
    <a href="admission.php"><i class="fas fa-user-plus"></i>Admission <span class="badge-count"><?php
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-user-plus" style="color: var(--primary);"></i> Admissions</h1>
      <a href="admission_manage.php" class="btn btn-primary btn-3d" style="margin-left: auto; padding: 10px 20px; font-size: 0.9rem;">
        <i class="fas fa-plus"></i> New Admission
      </a>
    </div>

    <div class="admin-card">
      <h2 style="color: white; margin-bottom: 25px; text-align: center;"><i class="fas fa-search"></i> Check Details</h2>
      
      <form method="post" enctype="multipart/form-data">
        <div class="form-row" style="margin-bottom: 25px;">
          <div class="form-group-admin" style="flex: 1; margin-right: 15px;">
            <label style="display: block; margin-bottom: 8px; color: var(--text-secondary);">Roll Number</label>
            <input type="text" name="rollno" class="form-control-admin" value="<?php echo htmlspecialchars($s_class); ?>" placeholder="Enter roll number" required>
          </div>
          <button type="submit" name="search" class="btn-admin btn-admin-primary" style="margin-top: 28px; padding: 15px 25px; height: 50px;">
            <i class="fas fa-search"></i> Search
          </button>
        </div>

        <?php if($row): ?>
        <div class="form-row">
          <div class="form-group-admin">
            <label>Student First Name</label>
            <input type="text" name="student_f_name" class="form-control-admin" required value="<?php echo htmlspecialchars($row['student_f_name'] ?? ''); ?>">
          </div>
          <div class="form-group-admin">
            <label>Student Last Name</label>
            <input type="text" name="student_l_name" class="form-control-admin" required value="<?php echo htmlspecialchars($row['student_l_name'] ?? ''); ?>">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group-admin">
            <label>Student Class</label>
            <input type="text" name="student_class" class="form-control-admin" required value="<?php echo htmlspecialchars($row['student_class'] ?? ''); ?>">
          </div>
          <div class="form-group-admin">
            <label>Aadhar Card Number</label>
            <input type="text" name="adhar" class="form-control-admin" required value="<?php echo htmlspecialchars($row['adhar'] ?? ''); ?>">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group-admin">
            <label>Father Name</label>
            <input type="text" name="father_name" class="form-control-admin" required value="<?php echo htmlspecialchars($row['father_name'] ?? ''); ?>">
          </div>
          <div class="form-group-admin">
            <label>Mother Name</label>
            <input type="text" name="mother_name" class="form-control-admin" required value="<?php echo htmlspecialchars($row['mother_name'] ?? ''); ?>">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group-admin">
            <label>Phone Number</label>
            <input type="text" name="phone" class="form-control-admin" required value="<?php echo htmlspecialchars($row['phone'] ?? ''); ?>">
          </div>
          <div class="form-group-admin">
            <label>Address</label>
            <input type="text" name="address" class="form-control-admin" required value="<?php echo htmlspecialchars($row['address'] ?? ''); ?>">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group-admin">
            <label>Pincode</label>
            <input type="text" name="pincode" class="form-control-admin" required value="<?php echo htmlspecialchars($row['pincode'] ?? ''); ?>">
          </div>
        </div>

        <div style="text-align: center; margin: 30px 0;">
          <img src="uploads/<?php echo htmlspecialchars($row['student_photo'] ?? ''); ?>" alt="Student Photo" class="student-photo" onerror="this.onerror=null;this.src='uploads/000.jpg';">
        </div>
        <?php endif; ?>

        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
          <button type="submit" name="cancel" class="btn-admin btn-admin-secondary">
            <i class="fas fa-times"></i> Cancel
          </button>
          <?php if($row): ?>
          <button type="submit" name="edit" class="btn-admin btn-admin-primary">
            <i class="fas fa-edit"></i> Edit
          </button>
          <?php endif; ?>
        </div>
      </form>
    </div>

    <?php if(!$row && !empty($s_class)): ?>
    <div class="admin-card">
      <div class="no-data-message">
        <i class="fas fa-user-minus"></i>
        <p>No student found with Roll Number: <?php echo htmlspecialchars($s_class); ?></p>
        <p style="margin-top: 15px; font-size: 0.9rem;">Please check the roll number and try again.</p>
      </div>
    </div>
    <?php endif; ?>

    <?php
    if(isset($_POST['edit']))
    {
        $rollno          = mysqli_real_escape_string($conn, $_POST['rollno']);
        $student_f_name  = mysqli_real_escape_string($conn, $_POST['student_f_name']);
        $student_l_name  = mysqli_real_escape_string($conn, $_POST['student_l_name']);
        $student_class   = mysqli_real_escape_string($conn, $_POST['student_class']);
        $adhar           = mysqli_real_escape_string($conn, $_POST['adhar']);
        $father_name     = mysqli_real_escape_string($conn, $_POST['father_name']);
        $mother_name     = mysqli_real_escape_string($conn, $_POST['mother_name']);
        $phone           = mysqli_real_escape_string($conn, $_POST['phone']);
        $address         = mysqli_real_escape_string($conn, $_POST['address']);
        $pincode         = mysqli_real_escape_string($conn, $_POST['pincode']);

        $update = $conn->query("
            UPDATE student_details
            SET
                student_f_name='$student_f_name',
                student_l_name='$student_l_name',
                student_class='$student_class',
                adhar='$adhar',
                father_name='$father_name',
                mother_name='$mother_name',
                phone='$phone',
                address='$address',
                pincode='$pincode'
            WHERE rollno='$rollno'
        ");

        if($update)
        {
            echo "
            <script>
                alert('Student Details Updated Successfully');
                window.location.href='dashboard.php';
            </script>";
        }
        else
        {
            echo "<script>alert('Update Failed');</script>";
        }
    }

    if(isset($_POST['cancel']))
        {        
            echo "
                <script>
                window.location.href='dashboard.php'
                </script>
                ";
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

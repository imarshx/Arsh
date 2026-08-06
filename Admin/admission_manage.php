<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
    $student_f_name = mysqli_real_escape_string($conn, $_POST['student_f_name']);
    $student_l_name = mysqli_real_escape_string($conn, $_POST['student_l_name']);
    $class = mysqli_real_escape_string($conn, $_POST['student_class']);
    $adhar = mysqli_real_escape_string($conn, $_POST['adhar']);
    $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
    $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);

    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
    {
        $allowed_ext = array("jpg", "jpeg", "png", "gif");
        $file_name = $_FILES["photo"]["name"];
        $file_tmp = $_FILES["photo"]["tmp_name"];
        $file_size = $_FILES["photo"]["size"];
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if(in_array($ext, $allowed_ext) && $file_size <= 2000000)
        {
            $upload_dir = "uploads/";
            if(!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $unique_filename = time() . '_' . $file_name;
            $target_file = $upload_dir . $unique_filename;

            if(move_uploaded_file($file_tmp, $target_file))
            {
                $stmt = $conn->prepare("INSERT INTO student_details(rollno, student_f_name, student_l_name, student_class, adhar, father_name, mother_name, phone, address, pincode, student_photo, status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");
                $stmt->bind_param("sssssssssss", $rollno, $student_f_name, $student_l_name, $class, $adhar, $father_name, $mother_name, $phone, $address, $pincode, $unique_filename);
                $stmt->execute();
                $stmt->close();

                echo "<script>alert('Admission Added Successfully'); window.location.href='admission.php';</script>";
            }
            else
            {
                $error = "Failed to upload photo";
            }
        }
        else
        {
            $error = "Invalid file type or size (max 2MB, JPG/PNG/GIF only)";
        }
    }
    else
    {
        $error = "Photo is required";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>New Admission - Admin Panel</title>
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
    .error-msg {
      background: rgba(239, 68, 68, 0.2);
      border: 1px solid #ef4444;
      color: #ef4444;
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      text-align: center;
    }
    .file-input-wrapper {
      position: relative;
      overflow: hidden;
      display: inline-block;
      width: 100%;
    }
    .file-input-wrapper input[type=file] {
      position: absolute;
      left: 0;
      top: 0;
      opacity: 0;
      width: 100%;
      height: 100%;
      cursor: pointer;
    }
    .file-input-label {
      display: block;
      padding: 40px;
      background: var(--glass);
      border: 2px dashed var(--glass-border);
      border-radius: 12px;
      text-align: center;
      color: var(--text-secondary);
      transition: all 0.3s;
      cursor: pointer;
    }
    .file-input-wrapper:hover .file-input-label {
      border-color: var(--primary);
      color: var(--primary);
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-user-plus" style="color: var(--primary);"></i> New Admission</h1>
    </div>

    <div class="glass reveal" style="padding: 30px; max-width: 100%;">
      <?php if(isset($error)): ?>
      <div class="error-msg">
        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
      </div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group-admin">
            <label>Roll Number</label>
            <input type="text" name="rollno" class="form-control-admin" placeholder="Enter roll number" required>
          </div>
          <div class="form-group-admin">
            <label>Student Class</label>
            <input type="text" name="student_class" class="form-control-admin" placeholder="e.g., 10, CSE" required>
          </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group-admin">
            <label>First Name</label>
            <input type="text" name="student_f_name" class="form-control-admin" placeholder="First name" required>
          </div>
          <div class="form-group-admin">
            <label>Last Name</label>
            <input type="text" name="student_l_name" class="form-control-admin" placeholder="Last name" required>
          </div>
        </div>

        <div class="form-group-admin">
          <label>Aadhar Card Number</label>
          <input type="text" name="adhar" class="form-control-admin" placeholder="12-digit Aadhar number" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group-admin">
            <label>Father's Name</label>
            <input type="text" name="father_name" class="form-control-admin" placeholder="Father's name" required>
          </div>
          <div class="form-group-admin">
            <label>Mother's Name</label>
            <input type="text" name="mother_name" class="form-control-admin" placeholder="Mother's name" required>
          </div>
        </div>

        <div class="form-group-admin">
          <label>Phone Number</label>
          <input type="text" name="phone" class="form-control-admin" placeholder="Phone number" required>
        </div>

        <div class="form-group-admin">
          <label>Address</label>
          <input type="text" name="address" class="form-control-admin" placeholder="Full address" required>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group-admin">
            <label>Pincode</label>
            <input type="text" name="pincode" class="form-control-admin" placeholder="6-digit pincode" required>
          </div>
          <div class="form-group-admin">
            <label>Student Photo</label>
            <div class="file-input-wrapper">
              <input type="file" name="photo" accept="image/*" required>
              <div class="file-input-label">
                <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <p>Click to upload student photo</p>
                <p style="font-size: 0.85rem;">JPG, PNG, GIF (max 2MB)</p>
              </div>
            </div>
          </div>
        </div>

        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 25px;">
          <button type="submit" class="btn btn-primary" style="padding: 12px 25px;">
            <i class="fas fa-save"></i> Submit Admission
          </button>
          <a href="admission.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
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

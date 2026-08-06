<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['upload']))
{
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    
    if(!empty($title) && !empty($course) && !empty($file_name)) {
        $course_folder = 'notes/' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $course);
        
        if(!is_dir($course_folder)) {
            mkdir($course_folder, 0755, true);
        }
        
        $unique_filename = time() . '_' . basename($file_name);
        $target = $course_folder . '/' . $unique_filename;
        
        if(move_uploaded_file($file_tmp, $target)) {
            $conn->query("INSERT INTO notes(title, course, file_name) VALUES('$title', '$course', '$unique_filename')");
            echo "<script>alert('Notes Uploaded Successfully');</script>";
        } else {
            echo "<script>alert('Failed to upload file');</script>";
        }
    }
}

$notes = $conn->query("SELECT * FROM notes ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes Upload - Admin Panel</title>
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
    .badge-count {
      background: white;
      color: #1e293b;
      padding: 4px 10px;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 700;
      margin-left: auto;
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-upload" style="color: var(--primary);"></i> Notes Upload</h1>
    </div>

    <div class="glass reveal" style="padding: 30px; max-width: 100%; margin-bottom: 30px;">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-group-admin">
          <label style="display: block; margin-bottom: 10px; color: white; font-weight: 500;"><i class="fas fa-heading"></i> Title</label>
          <input type="text" name="title" class="form-control-admin" placeholder="Enter notes title" required>
        </div>
        
        <div class="form-group-admin">
          <label style="display: block; margin-bottom: 10px; color: white; font-weight: 500;"><i class="fas fa-book"></i> Course</label>
          <input type="text" name="course" class="form-control-admin" placeholder="Enter course name (e.g., CSE, IT, BA)" required>
        </div>
        
        <div class="form-group-admin">
          <label style="display: block; margin-bottom: 10px; color: white; font-weight: 500;"><i class="fas fa-file-pdf"></i> Upload PDF</label>
          <div class="file-input-wrapper">
            <input type="file" name="file" accept=".pdf" required>
            <div class="file-input-label">
              <i class="fas fa-cloud-upload-alt" style="font-size: 2rem; margin-bottom: 10px;"></i>
              <p>Click to upload or drag and drop</p>
              <p style="font-size: 0.85rem;">PDF files only</p>
            </div>
          </div>
        </div>
        
        <button type="submit" name="upload" class="btn btn-primary" style="width: 100%; padding: 12px; margin-top: 10px;">
          <i class="fas fa-upload"></i> Upload Notes
        </button>
      </form>
    </div>

    <div class="admin-header" style="margin-top: 0;">
      <h2 style="color: white; font-size: 1.3rem;"><i class="fas fa-list" style="color: var(--primary);"></i> Uploaded Notes</h2>
    </div>

    <div class="glass reveal" style="padding: 0; overflow: hidden;">
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr style="background: rgba(108, 99, 255, 0.1);">
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Title</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Course</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">File</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Downloads</th>
            <th style="padding: 15px; text-align: left; color: var(--primary); font-weight: 600;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($notes->num_rows > 0) {
            while($note = $notes->fetch_assoc()) {
          ?>
          <tr style="border-bottom: 1px solid var(--glass-border); transition: all 0.3s;" onmouseover="this.style.background='var(--glass)'" onmouseout="this.style.background='transparent'">
            <td style="padding: 15px; color: white;"><?php echo htmlspecialchars($note['title']); ?></td>
            <td style="padding: 15px; color: var(--text-secondary);"><?php echo htmlspecialchars($note['course']); ?></td>
            <td style="padding: 15px; color: var(--text-secondary);"><?php echo htmlspecialchars($note['file_name']); ?></td>
            <td style="padding: 15px; color: var(--text-secondary);;"><?php echo $note['downloads'] ?? 0; ?></td>
            <td style="padding: 15px;">
              <a href="download.php?id=<?php echo $note['id']; ?>" class="btn btn-primary btn-3d" style="padding: 8px 16px; font-size: 0.85rem;">
                <i class="fas fa-download"></i>
              </a>
              <a href="delete_notes.php?id=<?php echo $note['id']; ?>&type=note" class="btn btn-secondary btn-3d" style="padding: 8px 16px; font-size: 0.85rem;" onclick="return confirm('Are you sure?')">
                <i class="fas fa-trash"></i>
              </a>
            </td>
          </tr>
          <?php
            }
          } else {
          ?>
          <tr>
            <td colspan="5" style="padding: 40px; text-align: center; color: var(--text-secondary);">
              <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 10px; display: block;"></i>
              No notes uploaded yet.
            </td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
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

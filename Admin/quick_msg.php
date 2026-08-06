<?php
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['send']))
{
    $message = mysqli_real_escape_string($conn,$_POST['message']);

    $send_to = $_POST['send_to'];

    $rollno = mysqli_real_escape_string(
    $conn,
    $_POST['rollno']
    );

    if($send_to == "all")
    {
        $rollno = "ALL";
    }

    $conn->query("
    INSERT INTO quick_message(message,rollno)
    VALUES('$message','$rollno')
    ");

    echo "<script>
    alert('Message Sent Successfully');
    window.location.href='quick_msg.php';
    </script>";
}

if(isset($_GET['delete']))
{
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM quick_message WHERE id=$delete_id");
    echo "<script>
    alert('Message Deleted Successfully');
    window.location.href='quick_msg.php';
    </script>";
}

$messages = $conn->query("SELECT * FROM quick_message ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quick Message - Admin Panel</title>
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
    .message-card {
      background: var(--glass);
      backdrop-filter: blur(20px);
      border: 1px solid var(--glass-border);
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 15px;
      transition: all 0.3s;
    }
    .message-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .message-meta {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
      flex-wrap: wrap;
      gap: 10px;
    }
    .message-recipient {
      color: var(--primary);
      font-weight: 600;
      font-size: 0.95rem;
    }
    .message-time {
      color: var(--text-secondary);
      font-size: 0.8rem;
    }
    .message-content {
      color: var(--text);
      line-height: 1.6;
      background: rgba(255,255,255,0.03);
      padding: 15px;
      border-radius: 8px;
      margin-bottom: 10px;
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
      <h1 style="color: white; font-size: 1.8rem;"><i class="fas fa-bell" style="color: var(--primary);"></i> Quick Message</h1>
    </div>

    <div class="glass reveal" style="padding: 30px; max-width: 100%; margin-bottom: 30px;">
      <form method="POST">
        <div class="form-group-admin">
          <label>Send To</label>
          <select  name="send_to" class="form-control-admin" required>
            <option style="background:rgb(0,0,0);" value="all">All Students</option>
            <option style="background:rgb(0,0,0);" value="specific">Specific Student</option>
          </select>
        </div>
        
        <div class="form-group-admin">
          <label>Roll Number (leave blank for all)</label>
          <input type="text" name="rollno" class="form-control-admin" placeholder="Enter Roll Number">
        </div>
        
        <div class="form-group-admin">
          <label>Message</label>
          <textarea name="message" class="form-control-admin" placeholder="Enter your message..." required></textarea>
        </div>
        
        <button type="submit" name="send" class="btn btn-primary" style="width: 100%; padding: 12px;">
          <i class="fas fa-paper-plane"></i> Send Message
        </button>
      </form>
    </div>

    <div class="admin-header" style="margin-top: 0;">
      <h2 style="color: white; font-size: 1.3rem;"><i class="fas fa-history" style="color: var(--secondary);"></i> Message History</h2>
    </div>

    <?php if($messages->num_rows > 0): ?>
      <?php while($msg = $messages->fetch_assoc()): ?>
        <div class="message-card">
          <div class="message-meta">
            <span class="message-recipient">
              <i class="fas fa-user"></i> To: <?php echo htmlspecialchars($msg['rollno']); ?>
            </span>
            <span class="message-time">
              <i class="fas fa-clock"></i> <?php echo date('M d, Y H:i', strtotime($msg['created_at'])); ?>
            </span>
          </div>
          <div class="message-content">
            <?php echo nl2br(htmlspecialchars($msg['message'])); ?>
          </div>
          <a href="quick_msg.php?delete=<?php echo $msg['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?')" class="btn btn-secondary btn-sm" style="padding: 6px 12px; font-size: 0.8rem;">
            <i class="fas fa-trash"></i> Delete
          </a>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="glass reveal" style="padding: 40px; text-align: center;">
        <i class="fas fa-inbox" style="font-size: 3rem; color: var(--text-secondary); margin-bottom: 15px;"></i>
        <p style="color: var(--text-secondary);">No messages sent yet.</p>
      </div>
    <?php endif; ?>
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

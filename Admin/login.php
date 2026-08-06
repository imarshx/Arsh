<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Government Polytechnic College</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../styles.css">
</head>
<body>

  <div class="auth-container">
    <div class="auth-bg-shapes">
      <div class="auth-shape"></div>
      <div class="auth-shape"></div>
      <div class="auth-shape"></div>
    </div>
    
    <div class="auth-box">
      <h1 class="text-gradient">Admin Login</h1>
      <p class="auth-subtitle">Government Polytechnic College</p>
      
      <form action="authenticate.php" method="POST" class="auth-form">
        <div class="form-group">
          <label><i class="fas fa-user-shield"></i> Username</label>
          <input type="text" name="username" placeholder="Enter Username" required>
        </div>
        
        <div class="form-group">
          <label><i class="fas fa-lock"></i> Password</label>
          <input type="password" name="password" placeholder="Enter Password" required>
        </div>
        
        <button type="submit" class="auth-btn">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Government Polytechnic College</title>
  <link rel="icon" type="image/png" href="logo/psbte.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="navbar">
      <div class="logo">
        <div class="logo-icon">
          <img src="logo/psbte.png" alt="PSBTE">
        </div>
        <span>GPC Portal</span>
      </div>
      
      <nav>
        <ul class="nav-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php" class="btn btn-primary btn-3d">Login</a></li>
        </ul>
      </nav>
      
      <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>

  <!-- Page Header -->
  <section style="padding: 160px 0 80px; text-align: center; background: linear-gradient(180deg, #1e1e4a 0%, var(--dark) 100%);">
    <div class="container">
      <div class="reveal">
        <h1 class="text-gradient">Contact Us</h1>
        <p style="color: var(--text-secondary); font-size: 1.2rem; max-width: 600px; margin: 20px auto 0;">
          We would love to hear from you. Get in touch with us.
        </p>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section class="contact">
    <div class="container">
      <div class="contact-grid">
        
        <div class="contact-info-card glass reveal">
          <h3 style="margin-bottom: 30px; color: white;">College Information</h3>
          
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-university"></i>
            </div>
            <div class="contact-info-text">
              <h4>College Name</h4>
              <p>Government Polytechnic College</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-info-text">
              <h4>Address</h4>
              <p>Amritsar, Punjab, India</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-phone-alt"></i>
            </div>
            <div class="contact-info-text">
              <h4>Phone</h4>
              <p>+91 12345 67890</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-info-text">
              <h4>Email</h4>
              <p>info@gpc.edu.in</p>
            </div>
          </div>
          
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-clock"></i>
            </div>
            <div class="contact-info-text">
              <h4>Office Hours</h4>
              <p>Monday - Friday<br>9:00 AM - 5:00 PM</p>
            </div>
          </div>
        </div>
        
        <div class="contact-form-card glass reveal">
          <h3 style="margin-bottom: 25px; color: white;">Send us a Message</h3>
          <form action="back_contact.php" method="post">
            <div class="form-group">
              <label style="display: block; margin-bottom: 10px; color: white;">Your Name</label>
              <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
              <label style="display: block; margin-bottom: 10px; color: white;">Email Address</label>
              <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
              <label style="display: block; margin-bottom: 10px; color: white;">Subject</label>
              <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
            </div>
            
            <div class="form-group">
              <label style="display: block; margin-bottom: 10px; color: white;">Message</label>
              <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary btn-3d">
              <i class="fas fa-paper-plane"></i> Send Message
            </button>
          </form>
        </div>
        
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h3>Government Polytechnic College</h3>
          <p>Empowering students with quality technical education since 1985.</p>
        </div>
        
        <div class="footer-links">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="courses.php">Courses</a></li>
            <li><a href="contact.php">Contact</a></li>
          </ul>
        </div>
        
        <div class="footer-contact">
          <h4>Contact Info</h4>
          <p><i class="fas fa-map-marker-alt"></i> Amritsar, Punjab, India</p>
          <p><i class="fas fa-phone"></i> +91 12345 67890</p>
          <p><i class="fas fa-envelope"></i> info@gpc.edu.in</p>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>© 2026 Government Polytechnic College | Student Management Portal</p>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>

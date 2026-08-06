<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Browser Tab Title -->
  <title>Government Polytechnic College - Student Portal</title>

  <!-- Browser Tab Logo (Favicon) -->
  <link rel="icon" type="image/png" href="logo/psbte.png">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="styles.css"> 
  <style>
    .hero-3d-card:nth-child(1) {
  top: 20px;
  left: 40px;
}

.hero-3d-card:nth-child(2) {
  top: 130px;
  left: -680px;
}

.hero-3d-card:nth-child(3) {
  top: 250px;
  left: 130px;
} 
  </style>
</head>
<body>

  <div class="particles" id="particles"></div>

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
          <li><a href="#home">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="courses.php">Courses</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a style="color:rgb(255,255,255);" href="login.php" class="btn btn-primary btn-3d">Login</a></li>
        </ul>
      </nav>
      
      <div class="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </header>

  <section class="hero" id="home">
    <div class="hero-bg-shapes">
      <div class="shape shape-1"></div>
      <div class="shape shape-2"></div>
      <div class="shape shape-3"></div>
    </div>

    <div class="hero-cards">
      <div class="hero-3d-card"><i class="fas fa-graduation-cap"></i></div>
      <div class="hero-3d-card"><i class="fas fa-laptop-code"></i></div>
      <div class="hero-3d-card"><i class="fas fa-book-open"></i></div>
    </div>
    
    <div class="hero-content">
      <div class="hero-badge">
        <i class="fas fa-star"></i>
        AICTE Approved Institution
      </div>
      <h1 class="hero-main-title">
        <span class="hero-title-row">
          <span class="hero-college-name">
            <span class="typing-text" id="typingText"></span><span class="blink-cursor">|</span>
          </span>
        </span>
        <div class="hero-tagline" id="hero-tagline"></div>
      </h1>
      <p class="hero-subtitle">Empowering students with quality education, modern facilities, and excellent placement opportunities since 1985.</p>
      <div class="hero-buttons">
        <a href="login.php" class="btn btn-primary btn-3d">
          <i class="fas fa-user-graduate"></i>
          Student Login
        </a>
        <a href="register.php" class="btn btn-secondary btn-3d">
          <i class="fas fa-user-plus"></i>
          New Registration
        </a>
      </div>
    </div>
  </section>

  <section class="about" id="about">
    <div class="container">
      <div class="section-header reveal">
        <h2>About Our College</h2>
        <p>Shaping future leaders with excellence in education and innovation</p>
      </div>
      
      <div class="about-grid">
        <div class="about-card glass reveal">
          <div class="about-icon">
            <i class="fas fa-award"></i>
          </div>
          <h3>Excellence</h3>
          <p>Committed to providing top-notch technical education with state-of-the-art infrastructure and experienced faculty.</p>
        </div>
        
        <div class="about-card glass reveal">
          <div class="about-icon">
            <i class="fas fa-flask"></i>
          </div>
          <h3>Innovation</h3>
          <p>Encouraging creative thinking and practical learning through modern laboratories and project-based education.</p>
        </div>
        
        <div class="about-card glass reveal">
          <div class="about-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h3>Placements</h3>
          <p>Strong industry connections ensuring 95% placement rate with top companies like TCS, Infosys, Wipro, and more.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="stats">
    <div class="container">
      <div class="section-header reveal">
        <h2>College Highlights</h2>
        <p>Numbers that speak for our excellence</p>
      </div>
      
      <div class="stats-grid">
        <div class="stat-card glass reveal">
          <div class="stat-number" data-target="5000">5000+</div>
          <div class="stat-label">Students</div>
        </div>
        <div class="stat-card glass reveal">
          <div class="stat-number" data-target="50">50+</div>
          <div class="stat-label">Faculty Members</div>
        </div>
        <div class="stat-card glass reveal">
          <div class="stat-number" data-target="25">25+</div>
          <div class="stat-label">Courses</div>
        </div>
        <div class="stat-card glass reveal">
          <div class="stat-number" data-target="95">95%</div>
          <div class="stat-label">Placement Rate</div>
        </div>
      </div>
    </div>
  </section>

  <section class="courses" id="courses">
    <div class="container">
      <div class="section-header reveal">
        <h2>Popular Courses</h2>
        <p>Explore our AICTE approved diploma programmes</p>
      </div>
      
      <div class="courses-grid">
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-laptop"></i></div>
            <h3>Computer Engineering</h3>
            <p>Master software development, web technologies, and modern programming practices.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-building"></i></div>
            <h3>Civil Engineering</h3>
            <p>Learn construction technology, structural design, and project management.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-cogs"></i></div>
            <h3>Mechanical Engineering</h3>
            <p>Study manufacturing processes, machine design, and thermal engineering.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-bolt"></i></div>
            <h3>Electrical Engineering</h3>
            <p>Explore power systems, electronics, and electrical machine design.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-microchip"></i></div>
            <h3>Electronics & Communication</h3>
            <p>Dive into VLSI, embedded systems, and communication technologies.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-car"></i></div>
            <h3>Automobile Engineering</h3>
            <p>Learn vehicle design, automotive technology, and maintenance engineering.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-network-wired"></i></div>
            <h3>Information Technology</h3>
            <p>Study networking, cybersecurity, and software development fundamentals.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">60 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
        
        <div class="course-card glass reveal">
          <div class="course-card-inner">
            <div class="course-icon"><i class="fas fa-drafting-compass"></i></div>
            <h3>Architectural Assistantship</h3>
            <p>Learn architectural design, interior planning, and construction documentation.</p>
            <div class="course-meta">
              <span class="course-tag">3 Years</span>
              <span class="course-tag">40 Seats</span>
            </div>
            <br>
            <a href="courses.php" class="btn btn-primary btn-3d">View Details</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="facilities">
    <div class="container">
      <div class="section-header reveal">
        <h2>Our Facilities</h2>
        <p>World-class infrastructure for holistic development</p>
      </div>
      
      <div class="facilities-grid">
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-desktop"></i></span>
          <h3>Computer Labs</h3>
          <p>Modern laboratories with latest technology and high-speed internet connectivity.</p>
        </div>
        
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-book"></i></span>
          <h3>Digital Library</h3>
          <p>Thousands of books, journals, and online resources for research and learning.</p>
        </div>
        
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-basketball-ball"></i></span>
          <h3>Sports Complex</h3>
          <p>Indoor and outdoor sports facilities including gym, cricket ground, and more.</p>
        </div>
        
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-flask"></i></span>
          <h3>Science Labs</h3>
          <p>Well-equipped physics, chemistry, and engineering laboratories for practical learning.</p>
        </div>
        
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-wifi"></i></span>
          <h3>Smart Campus</h3>
          <p>Fully WiFi-enabled campus with smart classrooms and digital learning tools.</p>
        </div>
        
        <div class="facility-card glass reveal">
          <span class="facility-icon"><i class="fas fa-bus"></i></span>
          <h3>Transport Facility</h3>
          <p>Safe and reliable transportation service covering all major routes in the city.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="placements">
    <div class="container">
      <div class="section-header reveal">
        <h2>Top Recruiters</h2>
        <p>Our students are placed in leading companies worldwide</p>
      </div>
    </div>
    
    <div class="company-track">
      <div class="company-logo">Infosys</div>
      <div class="company-logo">TCS</div>
      <div class="company-logo">Wipro</div>
      <div class="company-logo">HCL</div>
      <div class="company-logo">IBM</div>
      <div class="company-logo">Accenture</div>
      <div class="company-logo">Cognizant</div>
      <div class="company-logo">Tech Mahindra</div>
      <div class="company-logo">Infosys</div>
      <div class="company-logo">TCS</div>
      <div class="company-logo">Wipro</div>
      <div class="company-logo">HCL</div>
      <div class="company-logo">IBM</div>
      <div class="company-logo">Accenture</div>
      <div class="company-logo">Cognizant</div>
      <div class="company-logo">Tech Mahindra</div>
    </div>
  </section>

  <section class="notices">
    <div class="container">
      <div class="section-header reveal">
        <h2>Latest Notices</h2>
        <p>Stay updated with the latest announcements</p>
      </div>
      
      <div class="notices-list">
        <div class="notice-card glass reveal">
          <h4><i class="fas fa-bullhorn"></i> Admissions Open for Session 2026-27</h4>
          <p>Applications are now open for all diploma programmes. Apply before the deadline to secure your seat.</p>
          <div class="notice-date"><i class="far fa-calendar"></i> July 28, 2026</div>
        </div>
        
        <div class="notice-card glass reveal">
          <h4><i class="fas fa-file-alt"></i> Scholarship Forms Available</h4>
          <p>Scholarship application forms are available till 30 September. Eligible students are requested to apply.</p>
          <div class="notice-date"><i class="far fa-calendar"></i> July 25, 2026</div>
        </div>
        
        <div class="notice-card glass reveal">
          <h4><i class="fas fa-calendar-check"></i> Semester Examinations</h4>
          <p>Semester examinations will begin from October. Check the timetable and prepare accordingly.</p>
          <div class="notice-date"><i class="far fa-calendar"></i> July 20, 2026</div>
        </div>
        
        <div class="notice-card glass reveal">
          <h4><i class="fas fa-briefcase"></i> Campus Placement Drive</h4>
          <p>Major placement drive is scheduled for next month. Register with the placement cell to participate.</p>
          <div class="notice-date"><i class="far fa-calendar"></i> July 15, 2026</div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact" id="contact" style="margin-top:-120px;">
    <div class="container">
      <div class="section-header reveal">
        <h2>Contact Us</h2>
        <p>Get in touch with us for any queries or information</p>
      </div>
      
      <div class="contact-grid">
        <div class="contact-info-card glass reveal">
          <div class="contact-info-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-info-text">
              <h4>Address</h4>
              <p>Government Polytechnic College<br>Amritsar, Punjab, India</p>
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
          <h3 class="form-title">Send us a Message</h3>
          <form action="back_contact.php" method="post" class="contact-form">
            <div class="form-group">
              <label for="name"><i class="fas fa-user"></i> Your Name</label>
              <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
            </div>
            
            <div class="form-group">
              <label for="email"><i class="fas fa-envelope"></i> Email Address</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
              <label for="subject"><i class="fas fa-heading"></i> Subject</label>
              <input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject" required>
            </div>
            
            <div class="form-group">
              <label for="message"><i class="fas fa-pen"></i> Message</label>
              <textarea id="message" name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary btn-3d submit-btn">
              <i class="fas fa-paper-plane"></i>
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-brand">
          <h3>Government Polytechnic College</h3>
          <p>Empowering students with quality technical education, modern infrastructure, and excellent placement opportunities since 1985.</p>
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
        <p>© 2026 Government Polytechnic College. All Rights Reserved. | Designed & Developed by Arsh</p>
      </div>
    </div>
  </footer>

  <script src="script.js"></script>
  <script>
    // Typing animation
    const phrases = ['Government Polytechnic College ','Welcome to Student Portal ', 'Manage Learning Easily ', 'Track Results Instantly ', 'Connect With Teachers '];
    const el = document.getElementById('typingText');
    let p = 0, c = 0, deleting = false;
    function typeLoop() {
        const cur = phrases[p];
        if (!deleting) {
            el.textContent = cur.substring(0, c++);
            if (c > cur.length) { deleting = true; setTimeout(typeLoop, 1500); return; }
        } else {
            el.textContent = cur.substring(0, c--);
            if (c < 0) { deleting = false; p = (p + 1) % phrases.length; }
        }
        setTimeout(typeLoop, deleting ? 40 : 90);
    }
    typeLoop();
</script>
</body>
</html>
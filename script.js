// ==========================================
// MODERN INTERACTIONS & 3D EFFECTS
// ==========================================

// Mobile Menu Toggle
const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

if (menuToggle && navLinks) {
  menuToggle.addEventListener('click', () => {
    menuToggle.classList.toggle('active');
    navLinks.classList.toggle('active');
  });

  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      menuToggle.classList.remove('active');
      navLinks.classList.remove('active');
    });
  });
}

// Header Scroll Effect
const header = document.querySelector('.header');
let lastScroll = 0;

window.addEventListener('scroll', () => {
  const currentScroll = window.pageYOffset;
  
  if (header) {
    if (currentScroll > 50) {
      header.classList.add('scrolled');
    } else {
      header.classList.remove('scrolled');
    }
  }
  
  lastScroll = currentScroll;
});

// ==========================================
// SCROLL REVEAL ANIMATION
// ==========================================
const revealElements = document.querySelectorAll('.reveal');

const revealObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active');
    }
  });
}, {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
});

revealElements.forEach(el => revealObserver.observe(el));

// ==========================================
// 3D TILT EFFECT ON CARDS
// ==========================================
const tiltCards = document.querySelectorAll('.glass, .about-card, .course-card, .facility-card, .stat-card');

tiltCards.forEach(card => {
  card.addEventListener('mousemove', (e) => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    
    const centerX = rect.width / 2;
    const centerY = rect.height / 2;
    
    const rotateX = (y - centerY) / 20;
    const rotateY = (centerX - x) / 20;
    
    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
  });

  card.addEventListener('mouseleave', () => {
    card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
  });
});

// ==========================================
// ANIMATED COUNTERS FOR STATS
// ==========================================
const statNumbers = document.querySelectorAll('.stat-number');

const counterObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
      entry.target.classList.add('counted');
      const target = entry.target;
      const text = target.innerText;
      const numericValue = parseInt(text.replace(/\D/g, ''));
      const suffix = text.replace(/[0-9]/g, '');
      
      if (!isNaN(numericValue)) {
        let current = 0;
        const increment = numericValue / 50;
        const timer = setInterval(() => {
          current += increment;
          if (current >= numericValue) {
            current = numericValue;
            clearInterval(timer);
          }
          target.innerText = Math.floor(current) + suffix;
        }, 30);
      }
    }
  });
}, { threshold: 0.5 });

statNumbers.forEach(stat => counterObserver.observe(stat));

// ==========================================
// SMOOTH SCROLL FOR NAV LINKS
// ==========================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const href = this.getAttribute('href');
    if (href !== '#') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    }
  });
});

// ==========================================
// FLOATING PARTICLES GENERATOR
// ==========================================
function createParticles() {
  const particlesContainer = document.querySelector('.particles');
  if (!particlesContainer) return;
  
  const particleCount = window.innerWidth < 768 ? 15 : 30;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    particle.style.left = Math.random() * 100 + '%';
    particle.style.top = Math.random() * 100 + '%';
    particle.style.animationDuration = (Math.random() * 20 + 10) + 's';
    particle.style.animationDelay = Math.random() * 20 + 's';
    particle.style.opacity = Math.random() * 0.4 + 0.1;
    particle.style.width = (Math.random() * 4 + 2) + 'px';
    particle.style.height = particle.style.width;
    
    const colors = ['#6C63FF', '#00D2FF', '#FF6584'];
    particle.style.background = colors[Math.floor(Math.random() * colors.length)];
    
    particlesContainer.appendChild(particle);
  }
}

createParticles();

// ==========================================
// MAGNETIC BUTTON EFFECT
// ==========================================
const buttons = document.querySelectorAll('.btn');

buttons.forEach(btn => {
  btn.addEventListener('mousemove', (e) => {
    const rect = btn.getBoundingClientRect();
    const x = e.clientX - rect.left - rect.width / 2;
    const y = e.clientY - rect.top - rect.height / 2;
    
    btn.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px) scale(1.05)`;
  });
  
  btn.addEventListener('mouseleave', () => {
    btn.style.transform = 'translate(0, 0) scale(1)';
  });
});

// ==========================================
// PARALLAX EFFECT ON SCROLL
// ==========================================
window.addEventListener('scroll', () => {
  const scrolled = window.pageYOffset;
  
  const shapes = document.querySelectorAll('.shape');
  shapes.forEach((shape, index) => {
    const speed = (index + 1) * 0.1;
    shape.style.transform = `translateY(${scrolled * speed}px)`;
  });
});

// ==========================================
// HERO: rotating tagline (college name is static)
// ==========================================
(function initHeroTagline() {
  const taglineEl = document.getElementById('hero-tagline');
  if (!taglineEl) return;

  const phrases = [
    { text: 'Empowering Future Engineers', color: '#00D2FF' },
    { text: 'Innovating Tomorrow\'s Leaders', color: '#FF6584' },
    { text: 'Where Excellence Meets Education', color: '#00E676' },
    { text: 'Building Dreams, Shaping Careers', color: '#FFD700' },
    { text: 'Igniting Innovation, Every Day', color: '#A855F7' }
  ];

  function type(el, text, speed, cb) {
    el.innerHTML = '';
    let i = 0;
    function step() {
      if (i < text.length) {
        el.innerHTML += text.charAt(i);
        i++;
        setTimeout(step, speed);
      } else if (cb) cb();
    }
    step();
  }

  let idx = 0;
  function cycle() {
    const item = phrases[idx];
    taglineEl.style.setProperty('--tag-color', item.color);
    type(taglineEl, item.text, 60, function () {
      setTimeout(cycle, 2200);
    });
    idx = (idx + 1) % phrases.length;
  }

  // let the college name reveal finish first
  setTimeout(cycle, 1700);
})();
function typeWriter(element, text, speed = 50) {
  let i = 0;
  element.innerHTML = '';
  
  function type() {
    if (i < text.length) {
      element.innerHTML += text.charAt(i);
      i++;
      setTimeout(type, speed);
    }
  }
  
  type();
}

// ==========================================
// FORM INPUT ANIMATIONS
// ==========================================
const inputs = document.querySelectorAll('.form-control, .auth-form input, .auth-form textarea');

inputs.forEach(input => {
  input.addEventListener('focus', () => {
    input.parentElement.classList.add('focused');
  });
  
  input.addEventListener('blur', () => {
    if (!input.value) {
      input.parentElement.classList.remove('focused');
    }
  });
});

// ==========================================
// GLITCH EFFECT ON HOVER (For logos/text)
// ==========================================
function addGlitchEffect(element) {
  element.addEventListener('mouseenter', () => {
    element.style.animation = 'none';
    setTimeout(() => {
      element.style.animation = '';
    }, 10);
  });
}

document.querySelectorAll('.company-logo, .logo').forEach(addGlitchEffect);

// ==========================================
// LAZY LOADING FOR IMAGES
// ==========================================
if ('loading' in HTMLImageElement.prototype) {
  const images = document.querySelectorAll('img');
  images.forEach(img => {
    img.loading = 'lazy';
  });
} else {
  const script = document.createElement('script');
  script.src = 'https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js';
  document.body.appendChild(script);
}

// ==========================================
// INTERSECTION OBSERVER FOR ANIMATIONS
// ==========================================
const animatedElements = document.querySelectorAll('.course-card, .about-card, .facility-card');

const animationObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry, index) => {
    if (entry.isIntersecting) {
      setTimeout(() => {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }, index * 100);
    }
  });
}, { threshold: 0.1 });

animatedElements.forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(30px)';
  el.style.transition = 'all 0.6s ease';
  animationObserver.observe(el);
});

// ==========================================
// RIPPLE EFFECT FOR BUTTONS
// ==========================================
buttons.forEach(btn => {
  btn.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.cssText = `
      position: absolute;
      width: ${size}px;
      height: ${size}px;
      left: ${x}px;
      top: ${y}px;
      background: rgba(255,255,255,0.3);
      border-radius: 50%;
      transform: scale(0);
      animation: ripple 0.6s ease-out;
      pointer-events: none;
    `;
    
    this.appendChild(ripple);
    setTimeout(() => ripple.remove(), 600);
  });
});

// Add ripple animation
const style = document.createElement('style');
style.textContent = `
  @keyframes ripple {
    to {
      transform: scale(4);
      opacity: 0;
    }
  }
`;
document.head.appendChild(style);

// ==========================================
// PERFORMANCE: Throttle scroll events
// ==========================================
function throttle(func, limit) {
  let inThrottle;
  return function() {
    const args = arguments;
    const context = this;
    if (!inThrottle) {
      func.apply(context, args);
      inThrottle = true;
      setTimeout(() => inThrottle = false, limit);
    }
  }
}

// Apply throttle to scroll-heavy functions
window.addEventListener('scroll', throttle(() => {
  // Additional scroll-based animations can go here
}, 16));

console.log('%c✨ Welcome to the Future of Web Design ✨', 'color: #6C63FF; font-size: 20px; font-weight: bold;');
console.log('%c3D Effects • Glassmorphism • Modern UI', 'color: #00D2FF; font-size: 14px;');

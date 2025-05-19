
// Create particles
function createParticles() {
    const particlesContainer = document.getElementById('particles');
    const particleCount = 30;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.classList.add('particle');
        
        // Random size between 2px and 6px
        const size = Math.random() * 4 + 2;
        particle.style.width = `${size}px`;
        particle.style.height = `${size}px`;
        
        // Random position
        particle.style.left = `${Math.random() * 100}%`;
        particle.style.bottom = `-${size}px`;
        
        // Random animation duration between 10s and 20s
        const duration = Math.random() * 10 + 10;
        particle.style.animationDuration = `${duration}s`;
        
        // Random delay
        particle.style.animationDelay = `${Math.random() * 5}s`;
        
        // Random opacity
        particle.style.opacity = Math.random() * 0.5 + 0.1;
        
        particlesContainer.appendChild(particle);
    }
}

// Password strength meter
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthMeter = document.getElementById('strengthMeter');
    let strength = 0;
    
    // Check for length
    if (password.length > 7) strength += 1;
    
    // Check for uppercase letters
    if (password.match(/[A-Z]/)) strength += 1;
    
    // Check for numbers
    if (password.match(/[0-9]/)) strength += 1;
    
    // Check for special characters
    if (password.match(/[^A-Za-z0-9]/)) strength += 1;
    
    // Update strength meter
    const width = strength * 25;
    strengthMeter.style.width = `${width}%`;
    
    // Update color based on strength
    if (strength <= 1) {
        strengthMeter.style.backgroundColor = '#f44336'; // Red
    } else if (strength === 2) {
        strengthMeter.style.backgroundColor = '#ff9800'; // Orange
    } else if (strength === 3) {
        strengthMeter.style.backgroundColor = '#ffc107'; // Yellow
    } else {
        strengthMeter.style.backgroundColor = '#4caf50'; // Green
    }
});

// Form submission
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const fullname = document.getElementById('fullname').value;
    const email = document.getElementById('email').value;
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm-password').value;
    
    // Simple validation
    if (fullname.trim() === '' || email.trim() === '' || username.trim() === '' || password.trim() === '') {
        alert('Please fill in all fields');
        return;
    }
    
    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }
    
    // Here you would typically send the data to your server
    console.log('Registration attempt with:', { fullname, email, username, password });
    
    // Simulate registration success
    const registerCard = document.querySelector('.register-card');
    registerCard.style.transform = 'translateY(-20px)';
    registerCard.style.opacity = '0';
    
    setTimeout(() => {
        alert('Registration successful! Redirecting to login...');
        window.location.href = 'login.php'; // Redirect to login
    }, 500);
});

// Initialize on load
document.addEventListener('DOMContentLoaded', function() {
    createParticles();
});
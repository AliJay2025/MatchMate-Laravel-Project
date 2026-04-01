// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add active class to nav links on scroll
window.addEventListener('scroll', () => {
    const sections = document.querySelectorAll('section');
    const navLinks = document.querySelectorAll('.nav-links a');
    
    let current = '';
    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.clientHeight;
        if (scrollY >= sectionTop - 200) {
            current = section.getAttribute('id');
        }
    });
    
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${current}`) {
            link.classList.add('active');
        }
    });
});

// Counter animation for stats
const animateNumbers = () => {
    const statNumbers = document.querySelectorAll('.stat-item h3');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const element = entry.target;
                const text = element.innerText;
                const value = parseInt(text);
                
                if (!isNaN(value)) {
                    let start = 0;
                    const duration = 2000;
                    const increment = value / (duration / 16);
                    
                    const counter = setInterval(() => {
                        start += increment;
                        if (start >= value) {
                            element.innerText = text;
                            clearInterval(counter);
                        } else {
                            element.innerText = Math.floor(start) + '+';
                        }
                    }, 16);
                }
                
                observer.unobserve(element);
            }
        });
    }, observerOptions);
    
    statNumbers.forEach(stat => observer.observe(stat));
};

// Run animations when page loads
document.addEventListener('DOMContentLoaded', () => {
    animateNumbers();
});
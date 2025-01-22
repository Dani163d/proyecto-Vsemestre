const navToggle = document.querySelector('.nav-toggle');
const navbar = document.querySelector('.navbar');
const navClose = document.querySelector('.nav-close');

navToggle.addEventListener('click', () => {
    navbar.classList.add('active');
    navToggle.classList.add('active');
});

navClose.addEventListener('click', () => {
    navbar.classList.remove('active');
    setTimeout(() => {
        navToggle.classList.remove('active');
    }, 300);
});

document.addEventListener('click', (e) => {
    if (!navbar.contains(e.target) && !navToggle.contains(e.target)) {
        navbar.classList.remove('active');
        setTimeout(() => {
            navToggle.classList.remove('active');
        }, 300);
    }
});

const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('mouseover', () => {
        link.style.transform = 'translateX(5px)';
    });
    link.addEventListener('mouseout', () => {
        link.style.transform = 'translateX(0)';
    });
});
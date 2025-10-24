// ============================================
// Jim Vieira Website - Interactive JavaScript
// ============================================

(function() {
    'use strict';
    
    // Navigation Scroll Effect
    const navigation = document.getElementById('navigation');
    
    function handleScroll() {
        if (window.scrollY > 50) {
            navigation.classList.add('scrolled');
        } else {
            navigation.classList.remove('scrolled');
        }
    }
    
    window.addEventListener('scroll', handleScroll);
    
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const menuIcon = document.getElementById('menuIcon');
    const closeIcon = document.getElementById('closeIcon');
    
    mobileMenuBtn.addEventListener('click', function() {
        const isOpen = mobileMenu.classList.toggle('active');
        
        if (isOpen) {
            menuIcon.style.display = 'none';
            closeIcon.style.display = 'block';
        } else {
            menuIcon.style.display = 'block';
            closeIcon.style.display = 'none';
        }
    });
    
    // Smooth Scroll for Navigation Links
    function smoothScroll(target) {
        const element = document.querySelector(target);
        if (element) {
            const offset = 80; // Navigation height
            const elementPosition = element.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - offset;
            
            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
            
            // Close mobile menu if open
            if (mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                menuIcon.style.display = 'block';
                closeIcon.style.display = 'none';
            }
        }
    }
    
    // Add smooth scroll to all navigation links
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = this.getAttribute('href');
            if (target && target !== '#') {
                smoothScroll(target);
            }
        });
    });
    
    // Contact Form Handling
    const contactForm = document.getElementById('contactForm');
    
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            organization: document.getElementById('organization').value,
            message: document.getElementById('message').value
        };
        
        // Basic validation
        if (!formData.name || !formData.email || !formData.message) {
            showToast('Please fill in all required fields.', 'error');
            return;
        }
        
        // Email validation
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            showToast('Please enter a valid email address.', 'error');
            return;
        }
        
        // WordPress AJAX integration
        if (typeof jimVieiraAjax !== 'undefined') {
            // WordPress AJAX call
            fetch(jimVieiraAjax.ajax_url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'jim_vieira_contact_form',
                    name: formData.name,
                    email: formData.email,
                    organization: formData.organization,
                    message: formData.message,
                    nonce: jimVieiraAjax.nonce
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.data);
                    contactForm.reset();
                } else {
                    showToast(data.data, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('An error occurred. Please try again later.', 'error');
            });
        } else {
            // Fallback for non-WordPress environments
            console.log('Form submitted:', formData);
            showToast('Message sent successfully! We\'ll be in touch soon.');
            contactForm.reset();
        }
    });
    
    // Toast Notification System
    function showToast(message, type = 'success') {
        const toast = document.getElementById('toast');
        toast.textContent = message;
        toast.className = 'toast show';
        
        if (type === 'error') {
            toast.classList.add('error');
        }
        
        setTimeout(() => {
            toast.className = 'toast';
        }, 5000);
    }
    
    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    
    // Intersection Observer for Animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Observe animated elements
    document.querySelectorAll('.topic-card, .video-card-small').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'all 0.6s ease-out';
        observer.observe(el);
    });
    
    // Video Play Button Functionality (placeholder)
    document.querySelectorAll('.video-thumbnail, .video-thumbnail-small').forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            // In production, this would open a modal with the actual video
            // or navigate to the video page
            console.log('Video clicked:', this.querySelector('img').alt);
            showToast('Video player would open here. Integrate with YouTube or Vimeo.');
            
            // Example integration with YouTube:
            /*
            const videoId = this.dataset.videoId;
            const modal = document.createElement('div');
            modal.className = 'video-modal';
            modal.innerHTML = `
                <div class="video-modal-content">
                    <button class="video-modal-close">&times;</button>
                    <iframe 
                        width="100%" 
                        height="100%" 
                        src="https://www.youtube.com/embed/${videoId}?autoplay=1" 
                        frameborder="0" 
                        allow="autoplay; encrypted-media" 
                        allowfullscreen>
                    </iframe>
                </div>
            `;
            document.body.appendChild(modal);
            */
        });
    });
    
    // Book Purchase Buttons (placeholder)
    document.querySelectorAll('.book-buttons .btn').forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.textContent.trim();
            console.log('Book purchase clicked:', platform);
            showToast(`Redirecting to ${platform}...`);
            
            // In production, add actual affiliate links:
            // if (platform.includes('Amazon')) {
            //     window.open('YOUR_AMAZON_AFFILIATE_LINK', '_blank');
            // } else if (platform.includes('Audible')) {
            //     window.open('YOUR_AUDIBLE_AFFILIATE_LINK', '_blank');
            // }
        });
    });
    
    // Media Kit Download Button
    const mediaKitBtn = document.querySelector('.about-section .btn-primary');
    if (mediaKitBtn) {
        mediaKitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Media kit download requested');
            showToast('Media kit download would start here.');
            
            // In production:
            // window.location.href = '/path-to-media-kit.pdf';
        });
    }
    
    // YouTube Channel Button
    const youtubeBtn = document.querySelector('.videos-section .btn-outline-dark');
    if (youtubeBtn) {
        youtubeBtn.addEventListener('click', function() {
            // Replace with actual YouTube channel URL
            window.open('https://youtube.com/@jimvieira', '_blank');
        });
    }
    
    // Speaking Engagement Buttons
    document.querySelectorAll('.speaking-section .btn-primary, .hero-buttons .btn-primary').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (this.getAttribute('href') === '#contact') {
                return; // Let the smooth scroll handle it
            }
            e.preventDefault();
            smoothScroll('#contact');
        });
    });
    
    // Lazy Loading for Images (modern browsers)
    if ('loading' in HTMLImageElement.prototype) {
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
        });
    }
    
    // Performance: Debounce scroll event
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(handleScroll, 10);
    }, { passive: true });
    
    // Initialize on page load
    handleScroll();
    
    // Social Media Link Tracking (optional)
    document.querySelectorAll('a[href*="youtube.com"], a[href*="instagram.com"], a[href*="facebook.com"]').forEach(link => {
        link.addEventListener('click', function() {
            const platform = this.getAttribute('aria-label') || 'Social';
            console.log('Social media clicked:', platform);
            
            // In production, you can add analytics tracking here:
            // if (typeof gtag !== 'undefined') {
            //     gtag('event', 'social_click', {
            //         'platform': platform
            //     });
            // }
        });
    });
    
})();
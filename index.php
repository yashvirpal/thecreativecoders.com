<?php include('includes/header.php'); ?>
<?php include('includes/banner.php'); ?>


    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <h2 class="fade-in">Our Services</h2>
            <div class="service-grid fade-in-delay">
                <div class="service-item">
                    <h3>Web Development</h3>
                    <p>We create responsive, user-friendly websites tailored to your needs.</p>
                </div>
                <div class="service-item">
                    <h3>UI/UX Design</h3>
                    <p>Our designs are focused on user engagement and high conversion rates.</p>
                </div>
                <div class="service-item">
                    <h3>SEO Optimization</h3>
                    <p>Boost your online presence with our expert SEO services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio">
        <div class="container">
            <h2 class="fade-in">Recent Projects</h2>
            <div class="portfolio-grid">
                <div class="portfolio-item zoom">
                    <img src="img/project1.jpg" alt="Project 1">
                    <h3>Project One</h3>
                    <p>A web solution designed for a leading e-commerce platform.</p>
                </div>
                <div class="portfolio-item zoom">
                    <img src="img/project2.jpg" alt="Project 2">
                    <h3>Project Two</h3>
                    <p>Responsive and user-focused design for a local startup.</p>
                </div>
                <div class="portfolio-item zoom">
                    <img src="img/project3.jpg" alt="Project 3">
                    <h3>Project Three</h3>
                    <p>Complete SEO overhaul for an online retail company.</p>
                </div>
            </div>
            <a href="portfolio.php" class="cta-btn slide-up">View Full Portfolio</a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <h2 class="fade-in">What Our Clients Say</h2>
        <div class="testimonial-slider">
            <div class="testimonial-item fade-in">
                <p>"The Creative Coders transformed our website and helped us grow our business online. Their team is truly amazing!"</p>
                <h3>- Sarah Williams</h3>
            </div>
            <div class="testimonial-item fade-in">
                <p>"Professional, timely, and incredibly talented. I would highly recommend them!"</p>
                <h3>- John Doe</h3>
            </div>
            <div class="testimonial-item fade-in">
                <p>"Their SEO work improved our search rankings drastically. We saw results within a few months!"</p>
                <h3>- Emily Stone</h3>
            </div>
        </div>
    </div>
</section>


    <!-- Call to Action Section -->
    <section class="cta">
        <div class="container">
            <h2 class="fade-in">Ready to Work With Us?</h2>
            <p class="fade-in-delay">Let’s collaborate and bring your vision to life. Contact us today for a free consultation.</p>
            <a href="contact.php" class="cta-btn slide-up">Contact Us</a>
        </div>
    </section>

     <?php include('includes/footer.php'); ?>
<script>
    // Function to check if an element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Add class 'visible' when elements are in the viewport
    function checkPortfolioVisibility() {
        const portfolioItems = document.querySelectorAll('.portfolio-item');
        portfolioItems.forEach(item => {
            if (isElementInViewport(item)) {
                item.classList.add('visible');
            }
        });
    }

    // Event listener for scrolling
    window.addEventListener('scroll', checkPortfolioVisibility);
    window.addEventListener('load', checkPortfolioVisibility);  // Check on page load
</script>
<script>
    const slider = document.querySelector('.testimonial-slider');
    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
    });
</script>

</body>
</html>

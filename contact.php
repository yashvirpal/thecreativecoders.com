<?php include('includes/header.php'); ?>
<?php include('includes/banner.php'); ?>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <h2>Contact Us</h2>
        <p>If you have any questions, or want to discuss a project, feel free to reach out to us through the form below
            or directly via email.</p>

        <form action="/submit-form" method="post" class="contact-form">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Your Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</section>
<?php include('includes/footer.php'); ?>


</body>

</html>
<?php include('./header.php'); ?>
<!-- START OF CONTACT PAGE -->
<div class="contact-section">
    <h2 class="numbered-heading">
        05. Get In Touch
    </h2>
    
    <p>I'm always open to discussing new projects, creative ideas, or opportunities to be part of your visions.</p>
    
    <div class="contact-form">
        <?php if(!empty($response)) {?>
            <div class="form-group">
                <div class="<?php echo $response['status']; ?>">
                    <?php echo $response['message']; ?>
                </div>
            </div>
        <?php }?>

        <form action="" name="contactForm" id="contactForm" method="post" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <input type="text" 
                       name="name" 
                       id="name" 
                       placeholder="Your Name*" 
                       class="contact" 
                       required 
                       pattern="[A-Za-z ]{2,50}"
                       title="Please enter a valid name (2-50 characters, letters only)">
            </div>

            <div class="form-group">
                <input type="email" 
                       name="email" 
                       id="email" 
                       placeholder="Your Email*" 
                       class="contact" 
                       required>
            </div>

            <div class="form-group">
                <input type="text" 
                       name="subject" 
                       id="subject" 
                       placeholder="Subject*" 
                       class="contact" 
                       required 
                       minlength="2" 
                       maxlength="100">
            </div>

            <div class="form-group">
                <textarea name="message" 
                          id="message" 
                          placeholder="Your Message*" 
                          class="contact_form" 
                          required 
                          minlength="10" 
                          maxlength="1000"></textarea>
            </div>

            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Lf2vV0jAAAAAJOU_TPDA9db_HPJibvXPwzUmw0w"></div>
            </div>

            <button type="submit" name="submit" class="contact">Send Message</button>
        </form>
    </div>

    <div class="contact-alternatives">
        <p>You can also reach me directly at:</p>
        <p><a href="mailto:erin.skidds@gmail.com">erin.skidds@gmail.com</a></p>
    </div>
</div>

<?php include('./footer.php'); ?>
<?php include('./header.php'); ?>
<!-- START OF CONTACT PAGE -->
<div class="about-content">
<h2 class="numbered-heading">
    05. Get In Touch...
</h2>
<p>You can contact Erin at any of the following locations, as well as filling out the form below:</p>
<blockquote class="blockquote">
    You can manually send Erin an email at <a href="mailto:erin.skidds@gmail.com">erin.skidds@gmail.com</a><br />
</blockquote>

  <?php include('contactform.php'); ?>
    <!-- Error messages -->
    <?php if(!empty($response)) {?>
    <div class="form-group col-12 text-center">
      <div class="error <?php echo $response['status']; ?>">
        <?php echo $response['message']; ?>
      </div>
    </div>
    <?php }?>

<form action="" name="contactForm" id="contactForm" method="post" enctype="multipart/form-data" novalidate aria-labelledby="contact-form-heading">
        <h3 id="contact-form-heading" class="visually-hidden">Contact Form</h3>
        
        <div class="form-group">
          <label for="name" class="visually-hidden">Full Name (required)</label>
          <input type="text" name="name" id="name" placeholder="Full Name*" class="contact" required aria-required="true" aria-describedby="name-error">
          <div id="name-error" class="error-message" role="alert" aria-live="polite"></div>
        </div>
        
        <div class="form-group">
          <label for="email" class="visually-hidden">Email Address (required)</label>
          <input type="email" name="email" id="email" placeholder="Your Email*" class="contact" required aria-required="true" aria-describedby="email-error">
          <div id="email-error" class="error-message" role="alert" aria-live="polite"></div>
        </div>
        
        <div class="form-group">
          <label for="subject" class="visually-hidden">Subject (required)</label>
          <input type="text" name="subject" id="subject" placeholder="Subject*" class="contact" required aria-required="true" aria-describedby="subject-error">
          <div id="subject-error" class="error-message" role="alert" aria-live="polite"></div>
        </div>
        
        <div class="form-group">
          <label for="message" class="visually-hidden">Message Details (required)</label>
          <textarea rows="4" name="message" id="message" placeholder="Details*" class="contact_form" required aria-required="true" aria-describedby="message-error"></textarea>
          <div id="message-error" class="error-message" role="alert" aria-live="polite"></div>
        </div>
        
        <!-- Google reCAPTCHA block -->
        <div class="g-recaptcha" data-sitekey="6Lf2vV0jAAAAAJOU_TPDA9db_HPJibvXPwzUmw0w" aria-label="Please complete the reCAPTCHA verification"></div>
        
        <button type="submit" name="submit" class="contact" aria-describedby="form-submit-help">SEND MAIL</button>
        <div id="form-submit-help" class="visually-hidden">Press Enter or click to send your message</div>
    </form>
<br />

<?php
require('./footer.php');
?>
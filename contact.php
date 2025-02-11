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

<form action="" name="contactForm" id="contactForm" method="post" enctype="multipart/form-data" novalidate>
        <input type="text" name="name" id="name" placeholder="Full Name*" id="name" class="contact" required><br />
        <input type="email" name="email" id="email" placeholder="Your Email*" id="email" class="contact" required><br />
        <input type="text" name="subject" id="subject" placeholder="Subject*" id="subject" class="contact" required><br />
        <textarea rows="4" name="message" id="message" placeholder="Details*" class="contact_form" required></textarea>
        <!-- Google reCAPTCHA block -->
        <div class="g-recaptcha" data-sitekey="6Lf2vV0jAAAAAJOU_TPDA9db_HPJibvXPwzUmw0w"></div>
        <button type="submit" name="submit" class="contact">SEND MAIL</button>
    </form>
<br />

<?php
require('./footer.php');
?>
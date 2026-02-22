<?php include('./header.php'); ?>
<!-- START OF CONTACT PAGE -->
<main class="about-content" role="main" aria-labelledby="contact-heading">
  <h2 id="contact-heading" class="numbered-heading">05. Get In Touch</h2>

  <p style="margin-bottom: 2rem;">You can contact Erin at any of the following locations, as well as filling out the form below:</p>

  <blockquote class="contact-blockquote">
    <p>You can manually send Erin an email at <a href="mailto:erin.skidds@gmail.com">erin.skidds@gmail.com</a></p>
  </blockquote>

  <form action="contactform.php" name="contactForm" id="contactForm" method="post" novalidate aria-labelledby="contact-form-heading">
    <h3 id="contact-form-heading" class="visually-hidden">Contact Form</h3>

    <div class="contact-form-group">
      <label for="name" class="visually-hidden">Full Name (required)</label>
      <input type="text" name="name" id="name" placeholder="Full Name*" class="contact-field" required aria-required="true" aria-describedby="name-error">
      <div id="name-error" class="error-message" role="alert" aria-live="polite"></div>
    </div>

    <div class="contact-form-group">
      <label for="email" class="visually-hidden">Email Address (required)</label>
      <input type="email" name="email" id="email" placeholder="Email Address*" class="contact-field" required aria-required="true" aria-describedby="email-error">
      <div id="email-error" class="error-message" role="alert" aria-live="polite"></div>
    </div>

    <div class="contact-form-group">
      <label for="message" class="visually-hidden">Message (required)</label>
      <textarea name="message" id="message" placeholder="Your Message*" class="contact-field contact-textarea" rows="6" required aria-required="true" aria-describedby="message-error"></textarea>
      <div id="message-error" class="error-message" role="alert" aria-live="polite"></div>
    </div>

    <button type="submit" name="submit" class="contact-submit">Send Message</button>
  </form>
</main>

<?php require('./footer.php'); ?>
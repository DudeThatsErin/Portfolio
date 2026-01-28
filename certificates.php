<?php include('./header.php'); ?>
<main class="about-content" role="main" aria-labelledby="certificates-heading">
  <h2 id="certificates-heading" class="numbered-heading">07. Certificates & Credentials</h2>
  
  <div class="filter-buttons" role="tablist" aria-label="Filter certificates by platform">
    <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true" aria-controls="certificates-container" id="filter-all-certs">All Certificates</button>
    <button class="filter-btn" data-filter="udemy" role="tab" aria-selected="false" aria-controls="certificates-container" id="filter-udemy">Udemy</button>
    <button class="filter-btn" data-filter="coursera" role="tab" aria-selected="false" aria-controls="certificates-container" id="filter-coursera">Coursera</button>
    <button class="filter-btn" data-filter="other" role="tab" aria-selected="false" aria-controls="certificates-container" id="filter-other">Other</button>
  </div>
  
  <div id="certificates-container" class="certificates-grid" role="tabpanel" aria-labelledby="filter-all-certs">
    
    <div class="certificate-card" data-cert-platform="udemy">
      <div class="cert-header">
        <h3>Example Certificate Title</h3>
        <span class="cert-platform-badge">Udemy</span>
      </div>
      <div class="cert-details">
        <p class="cert-instructor"><strong>Instructor:</strong> Instructor Name</p>
        <p class="cert-date"><strong>Completed:</strong> January 2026</p>
        <p class="cert-description">Brief description of what you learned in this course and key skills acquired.</p>
      </div>
      <div class="cert-footer">
        <a href="#" target="_blank" rel="noopener noreferrer" class="cert-link" aria-label="View certificate">
          <i class="fa-solid fa-certificate" aria-hidden="true"></i> View Certificate
        </a>
      </div>
    </div>

    <div class="certificate-card" data-cert-platform="coursera">
      <div class="cert-header">
        <h3>Example Coursera Course</h3>
        <span class="cert-platform-badge">Coursera</span>
      </div>
      <div class="cert-details">
        <p class="cert-instructor"><strong>Instructor:</strong> Instructor Name</p>
        <p class="cert-date"><strong>Completed:</strong> December 2025</p>
        <p class="cert-description">Brief description of what you learned in this course and key skills acquired.</p>
      </div>
      <div class="cert-footer">
        <a href="#" target="_blank" rel="noopener noreferrer" class="cert-link" aria-label="View certificate">
          <i class="fa-solid fa-certificate" aria-hidden="true"></i> View Certificate
        </a>
      </div>
    </div>

    <div class="certificate-card" data-cert-platform="other">
      <div class="cert-header">
        <h3>Example Other Certification</h3>
        <span class="cert-platform-badge">Other</span>
      </div>
      <div class="cert-details">
        <p class="cert-instructor"><strong>Provider:</strong> Organization Name</p>
        <p class="cert-date"><strong>Completed:</strong> November 2025</p>
        <p class="cert-description">Brief description of what you learned in this course and key skills acquired.</p>
      </div>
      <div class="cert-footer">
        <a href="#" target="_blank" rel="noopener noreferrer" class="cert-link" aria-label="View certificate">
          <i class="fa-solid fa-certificate" aria-hidden="true"></i> View Certificate
        </a>
      </div>
    </div>

  </div>
</main>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const certificates = document.querySelectorAll('[data-cert-platform]');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        filterButtons.forEach(btn => {
          btn.classList.remove('active');
          btn.setAttribute('aria-selected', 'false');
        });
        
        button.classList.add('active');
        button.setAttribute('aria-selected', 'true');
        
        document.getElementById('certificates-container').setAttribute('aria-labelledby', button.id);

        const filterValue = button.getAttribute('data-filter');

        certificates.forEach(cert => {
          if (filterValue === 'all' || cert.getAttribute('data-cert-platform') === filterValue) {
            cert.style.display = 'block';
          } else {
            cert.style.display = 'none';
          }
        });
      });
    });
    
    filterButtons.forEach((button, index) => {
      button.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
          e.preventDefault();
          
          const direction = e.key === 'ArrowLeft' ? -1 : 1;
          let newIndex = index + direction;
          
          if (newIndex < 0) newIndex = filterButtons.length - 1;
          if (newIndex >= filterButtons.length) newIndex = 0;
          
          filterButtons[newIndex].focus();
          filterButtons[newIndex].click();
        }
      });
    });
  });
</script>

<?php include('./footer.php'); ?>

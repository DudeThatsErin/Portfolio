<?php include('./header.php'); ?>
<main class="about-content" role="main" aria-labelledby="resume-heading">
  <h1 id="resume-heading" class="numbered-heading">06. Resume</h1>

  <p>Download my resume to learn more about my experience and qualifications.</p>

  <div style="text-align: center; margin: 2rem 0;">
    <a href="./assets/ErinSkiddsResume.pdf?v=3" download class="resume-download-btn" aria-label="Download PDF resume">
      <i class="fa-solid fa-download" aria-hidden="true"></i> Download PDF Resume
    </a>
    <a href="./assets/ErinSkiddsResume.docx?v=3" download class="resume-download-btn" aria-label="Download Word resume">
      <i class="fa-solid fa-file-word" aria-hidden="true"></i> Download Word Resume
    </a>
  </div>

  <div class="resume-iframe-wrapper">
    <iframe
      src="./assets/ErinSkiddsResume.pdf?v=3"
      title="Erin Skidds Resume Preview"
      style="border: 1px solid var(--border-color); border-radius: var(--border-radius); margin-top: 2rem; display: block; margin-left: auto; margin-right: auto; width: 1000px; max-width: 100%; height: 600px; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
    </iframe>
  </div>

  <?php
  $certDir = './assets/certificates/';
  $certs = [];
  if (is_dir($certDir)) {
    $files = scandir($certDir);
    foreach ($files as $file) {
      if (preg_match('/\.(png|jpg|jpeg|gif|webp)$/i', $file)) {
        $name = pathinfo($file, PATHINFO_FILENAME);
        $name = str_replace(['-', '_'], ' ', $name);
        $name = ucwords($name);
        $certs[] = ['file' => $file, 'name' => $name, 'url' => $certDir . $file];
      }
    }
  }
  if (!empty($certs)): ?>
  <section class="certificates-section" aria-labelledby="certs-heading">
    <h2 id="certs-heading" class="numbered-heading">07. Certificates &amp; Credentials</h2>
    <div class="certificates-grid" id="cert-grid">
      <?php foreach ($certs as $cert): ?>
      <div class="certificate-card"
           role="button"
           tabindex="0"
           aria-label="View <?php echo htmlspecialchars($cert['name']); ?> certificate"
           data-cert-url="<?php echo htmlspecialchars($cert['url']); ?>"
           data-cert-name="<?php echo htmlspecialchars($cert['name']); ?>">
        <div class="certificate-image-wrapper">
          <img src="<?php echo htmlspecialchars($cert['url']); ?>" alt="<?php echo htmlspecialchars($cert['name']); ?>" loading="lazy" />
          <div class="certificate-overlay">
            <i class="fa-solid fa-magnifying-glass-plus" aria-hidden="true"></i>
            <span>Click to view</span>
          </div>
        </div>
        <div class="certificate-info">
          <h3><?php echo htmlspecialchars($cert['name']); ?></h3>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Lightbox -->
  <div id="cert-lightbox" class="lightbox-overlay" style="display:none;" role="dialog" aria-modal="true" aria-label="Certificate viewer">
    <div class="lightbox-content">
      <button class="lightbox-close" id="lightbox-close" aria-label="Close lightbox">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>
      <button class="lightbox-nav lightbox-prev" id="lightbox-prev" aria-label="Previous certificate">
        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
      </button>
      <button class="lightbox-nav lightbox-next" id="lightbox-next" aria-label="Next certificate">
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
      </button>
      <div class="lightbox-image-wrapper">
        <img id="lightbox-img" src="" alt="" />
      </div>
      <div class="lightbox-caption">
        <h3 id="lightbox-title"></h3>
        <p class="lightbox-counter" id="lightbox-counter"></p>
      </div>
    </div>
  </div>

  <script>
  (function() {
    var cards = Array.from(document.querySelectorAll('.certificate-card'));
    var lightbox = document.getElementById('cert-lightbox');
    var img = document.getElementById('lightbox-img');
    var title = document.getElementById('lightbox-title');
    var counter = document.getElementById('lightbox-counter');
    var closeBtn = document.getElementById('lightbox-close');
    var prevBtn = document.getElementById('lightbox-prev');
    var nextBtn = document.getElementById('lightbox-next');
    var current = 0;

    function open(index) {
      current = index;
      var card = cards[current];
      img.src = card.getAttribute('data-cert-url');
      img.alt = card.getAttribute('data-cert-name');
      title.textContent = card.getAttribute('data-cert-name');
      counter.textContent = (current + 1) + ' / ' + cards.length;
      lightbox.style.display = 'flex';
      document.body.style.overflow = 'hidden';
      closeBtn.focus();
    }

    function close() {
      lightbox.style.display = 'none';
      document.body.style.overflow = '';
    }

    function navigate(dir) {
      current = (current + dir + cards.length) % cards.length;
      var card = cards[current];
      img.src = card.getAttribute('data-cert-url');
      img.alt = card.getAttribute('data-cert-name');
      title.textContent = card.getAttribute('data-cert-name');
      counter.textContent = (current + 1) + ' / ' + cards.length;
    }

    cards.forEach(function(card, i) {
      card.addEventListener('click', function() { open(i); });
      card.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); open(i); }
      });
    });

    closeBtn.addEventListener('click', close);
    prevBtn.addEventListener('click', function() { navigate(-1); });
    nextBtn.addEventListener('click', function() { navigate(1); });

    lightbox.addEventListener('click', function(e) {
      if (e.target === lightbox) close();
    });

    document.addEventListener('keydown', function(e) {
      if (lightbox.style.display === 'none') return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') navigate(-1);
      if (e.key === 'ArrowRight') navigate(1);
    });
  })();
  </script>
  <?php endif; ?>
</main>

<?php include('./footer.php'); ?>
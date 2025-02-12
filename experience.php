<?php include('./header.php'); ?>
<div class="about-content">
  <h2 class="numbered-heading">04. Some Things I've Built &amp; Worked On</h2>
  <div class="filter-buttons">
    <button class="filter-btn active" data-filter="all">All Projects</button>
    <button class="filter-btn" data-filter="work">Work Projects</button>
    <button class="filter-btn" data-filter="personal">Personal Projects</button>
  </div>
    <div class="featured">
  <?php
  include('./projects/sasha.php');
  include('./projects/reactauth.php');
  include('./projects/reactcounter.php');
  include('./projects/reacttodo.php');
  include('./projects/social.php');
  include('./projects/hangman.php');
  include('./projects/asteroids.php');
  include('./projects/enth.php');
  include('./projects/la.php');
  include('./projects/dte.php');
  include('./projects/appseeker.php');
  include('./projects/ch.php');
  include('./projects/sakura.php');
  include('./projects/punch.php');
  include('./projects/dispybot.php');
  include('./projects/csharpbot.php');
  include('./projects/csharps.php');
  include('./projects/34ball.php');
  include('./projects/rnr.php');
  include('./projects/edmobile.php');
  include('./projects/ta360.php');
  include('./projects/fa.php');
  include('./projects/dtm.php');
  include('./projects/hostwish.php');
  ?>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projects = document.querySelectorAll('[data-project-type]');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add active class to clicked button
        button.classList.add('active');

        const filterValue = button.getAttribute('data-filter');

        projects.forEach(project => {
          if (filterValue === 'all' || project.getAttribute('data-project-type') === filterValue) {
            project.classList.remove('hidden');
          } else {
            project.classList.add('hidden');
          }
        });
      });
    });
  });
</script>

<?php include('./footer.php'); ?>
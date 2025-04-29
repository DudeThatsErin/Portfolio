<?php include('./header.php'); ?>
<main class="about-content" role="main" aria-labelledby="projects-heading">
  <h2 id="projects-heading" class="numbered-heading">04. Some Things I've Built &amp; Worked On</h2>
  
  <div class="filter-buttons" role="tablist" aria-label="Filter projects by category">
    <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true" aria-controls="projects-container" id="filter-all">All Projects</button>
    <button class="filter-btn" data-filter="work" role="tab" aria-selected="false" aria-controls="projects-container" id="filter-work">Work Projects</button>
    <button class="filter-btn" data-filter="personal" role="tab" aria-selected="false" aria-controls="projects-container" id="filter-personal">Personal Projects</button>
  </div>
  
  <div id="projects-container" class="featured" role="tabpanel" aria-labelledby="filter-all">
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
        // Remove active class from all buttons and update ARIA attributes
        filterButtons.forEach(btn => {
          btn.classList.remove('active');
          btn.setAttribute('aria-selected', 'false');
        });
        
        // Add active class to clicked button and update ARIA attributes
        button.classList.add('active');
        button.setAttribute('aria-selected', 'true');
        
        // Update the tabpanel's aria-labelledby attribute
        document.getElementById('projects-container').setAttribute('aria-labelledby', button.id);

        const filterValue = button.getAttribute('data-filter');

        // Show or hide projects based on filter
        projects.forEach(project => {
          if (filterValue === 'all' || project.getAttribute('data-project-type') === filterValue) {
            project.style.display = 'block';
          } else {
            project.style.display = 'none';
          }
        });
      });
    });
    
    // Handle keyboard navigation for the tablist
    filterButtons.forEach((button, index) => {
      button.addEventListener('keydown', (e) => {
        // Left/right arrow keys to navigate between tabs
        if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
          e.preventDefault();
          
          const direction = e.key === 'ArrowLeft' ? -1 : 1;
          let newIndex = index + direction;
          
          // Handle wrapping around
          if (newIndex < 0) newIndex = filterButtons.length - 1;
          if (newIndex >= filterButtons.length) newIndex = 0;
          
          // Focus the new button and click it
          filterButtons[newIndex].focus();
          filterButtons[newIndex].click();
        }
      });
    });
  });
</script>
</main>

<?php include('./footer.php'); ?>
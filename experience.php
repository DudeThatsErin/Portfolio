<?php include('./header.php'); ?>

<div class="projects-section">
    <h2 class="numbered-heading">04. Some Things I've Built &amp; Worked On</h2>
    
    <div class="project-filters">
        <button class="filter-button active" data-filter="all">All Projects</button>
        <button class="filter-button" data-filter="work">Work Projects</button>
        <button class="filter-button" data-filter="personal">Personal Projects</button>
    </div>

    <div class="featured">
        <?php
        include('./projects/sasha.php');
        include('./projects/reactcounter.php');
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
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-button');
    const projects = document.querySelectorAll('.project-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            button.classList.add('active');

            const filterValue = button.getAttribute('data-filter');

            projects.forEach(project => {
                if (filterValue === 'all' || project.getAttribute('data-type') === filterValue) {
                    project.style.display = 'flex';
                } else {
                    project.style.display = 'none';
                }
            });
        });
    });

    // Modal functionality
    const modals = document.querySelectorAll('.modal');
    const modalButtons = document.querySelectorAll('.modal-button');
    const closeButtons = document.querySelectorAll('.close');

    modalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('href').substring(1);
            const modal = document.getElementById(modalId);
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modal = button.closest('.modal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    });

    window.addEventListener('click', (event) => {
        modals.forEach(modal => {
            if (event.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });
    });
});
</script>

<?php include('./footer.php'); ?>
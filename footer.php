    </div>

    <!-- <div class="right-sidebar">
      <a href="mailto:erin.skidds@gmail.com">erin.skidds@gmail.com</a>
    </div> -->
    </div>

    <!-- Google reCaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
      // Get the button that opens the modal
      var btn = document.querySelectorAll("button.modal-button");

      // All page modals
      var modals = document.querySelectorAll(".modal");

      // Get the <span> element that closes the modal
      var spans = document.getElementsByClassName("close");

      // When the user clicks the button, open the modal
      for (var i = 0; i < btn.length; i++) {
        btn[i].onclick = function(e) {
          e.preventDefault();
          modal = document.querySelector(e.target.getAttribute("href"));
          modal.style.display = "block";
          // Set focus to the first focusable element in the modal
          const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
          if (focusableElements.length > 0) {
            focusableElements[0].focus();
          }
          // Add ARIA attributes
          modal.setAttribute('aria-hidden', 'false');
          document.body.classList.add('modal-open');
        };
      }

      // When the user clicks on <span> (x), close the modal
      for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function() {
          for (var index in modals) {
            if (typeof modals[index].style !== "undefined") {
              modals[index].style.display = "none";
              // Update ARIA attributes
              modals[index].setAttribute('aria-hidden', 'true');
            }
          }
          document.body.classList.remove('modal-open');
        };
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target.classList.contains("modal")) {
          for (var index in modals) {
            if (typeof modals[index].style !== "undefined") {
              modals[index].style.display = "none";
              // Update ARIA attributes
              modals[index].setAttribute('aria-hidden', 'true');
            }
          }
          document.body.classList.remove('modal-open');
        }
      };

      // Handle keyboard accessibility for modals
      document.addEventListener('keydown', function(e) {
        // ESC key closes modal
        if (e.key === 'Escape') {
          for (var index in modals) {
            if (typeof modals[index].style !== "undefined" && modals[index].style.display === "block") {
              modals[index].style.display = "none";
              modals[index].setAttribute('aria-hidden', 'true');
              document.body.classList.remove('modal-open');
            }
          }
        }
      });
    </script>
    </body>

    </html>
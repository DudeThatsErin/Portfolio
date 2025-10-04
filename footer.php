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
          
          // Store the element that opened the modal for return focus
          modal.setAttribute('data-return-focus', e.target.id || 'modal-trigger');
          
          // Set focus to the close button (first focusable element)
          const closeButton = modal.querySelector('.close');
          if (closeButton) {
            closeButton.focus();
          }
          
          // Add ARIA attributes
          modal.setAttribute('aria-hidden', 'false');
          document.body.classList.add('modal-open');
          
          // Trap focus within modal
          trapFocus(modal);
          
          // Announce modal opening
          announceToScreenReader('Dialog opened: ' + (modal.querySelector('h2') ? modal.querySelector('h2').textContent : 'Project details'));
        };
      }

      // When the user clicks on <span> (x), close the modal
      for (var i = 0; i < spans.length; i++) {
        spans[i].onclick = function() {
          closeModal();
        };
      }

      // When the user clicks anywhere outside of the modal, close it
      window.onclick = function(event) {
        if (event.target.classList.contains("modal")) {
          closeModal();
        }
      };

      // Handle keyboard accessibility for modals
      document.addEventListener('keydown', function(e) {
        // ESC key closes modal
        if (e.key === 'Escape') {
          const openModal = document.querySelector('.modal[style*="block"]');
          if (openModal) {
            closeModal();
          }
        }
      });

      // Close modal function with proper focus management
      function closeModal() {
        const openModal = document.querySelector('.modal[style*="block"]');
        if (openModal) {
          openModal.style.display = "none";
          openModal.setAttribute('aria-hidden', 'true');
          document.body.classList.remove('modal-open');
          
          // Return focus to the element that opened the modal
          const returnFocusId = openModal.getAttribute('data-return-focus');
          if (returnFocusId) {
            const returnElement = document.getElementById(returnFocusId) || document.querySelector('[href="#' + openModal.id + '"]');
            if (returnElement) {
              returnElement.focus();
            }
          }
          
          // Remove focus trap
          removeFocusTrap();
          
          // Announce modal closing
          announceToScreenReader('Dialog closed');
        }
      }

      // Focus trap functionality
      let focusTrapElements = [];
      let firstFocusableElement = null;
      let lastFocusableElement = null;

      function trapFocus(modal) {
        focusTrapElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        firstFocusableElement = focusTrapElements[0];
        lastFocusableElement = focusTrapElements[focusTrapElements.length - 1];

        modal.addEventListener('keydown', handleFocusTrap);
      }

      function handleFocusTrap(e) {
        if (e.key === 'Tab') {
          if (e.shiftKey) {
            if (document.activeElement === firstFocusableElement) {
              e.preventDefault();
              lastFocusableElement.focus();
            }
          } else {
            if (document.activeElement === lastFocusableElement) {
              e.preventDefault();
              firstFocusableElement.focus();
            }
          }
        }
      }

      function removeFocusTrap() {
        const openModal = document.querySelector('.modal[style*="block"]');
        if (openModal) {
          openModal.removeEventListener('keydown', handleFocusTrap);
        }
        focusTrapElements = [];
        firstFocusableElement = null;
        lastFocusableElement = null;
      }

      // Handle hamburger menu keyboard accessibility
      const hamburgerLabel = document.querySelector('.hamburger-label');
      const menuCheckbox = document.getElementById('checkbox4');
      
      if (hamburgerLabel && menuCheckbox) {
        hamburgerLabel.addEventListener('keydown', function(e) {
          if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            menuCheckbox.checked = !menuCheckbox.checked;
            hamburgerLabel.setAttribute('aria-expanded', menuCheckbox.checked ? 'true' : 'false');
            
            // Announce menu state to screen readers
            const announcement = menuCheckbox.checked ? 'Menu opened' : 'Menu closed';
            announceToScreenReader(announcement);
          }
        });

        // Update aria-expanded when checkbox changes
        menuCheckbox.addEventListener('change', function() {
          hamburgerLabel.setAttribute('aria-expanded', this.checked ? 'true' : 'false');
        });
      }

      // Function to announce messages to screen readers
      function announceToScreenReader(message) {
        const announcement = document.createElement('div');
        announcement.setAttribute('aria-live', 'polite');
        announcement.setAttribute('aria-atomic', 'true');
        announcement.className = 'visually-hidden';
        announcement.textContent = message;
        document.body.appendChild(announcement);
        
        setTimeout(function() {
          document.body.removeChild(announcement);
        }, 1000);
      }

      // Enhanced form validation with accessibility
      const contactForm = document.getElementById('contactForm');
      if (contactForm) {
        const formFields = [
          { id: 'name', name: 'Full Name' },
          { id: 'email', name: 'Email Address' },
          { id: 'subject', name: 'Subject' },
          { id: 'message', name: 'Message' }
        ];

        // Real-time validation
        formFields.forEach(function(field) {
          const input = document.getElementById(field.id);
          const errorDiv = document.getElementById(field.id + '-error');
          
          if (input && errorDiv) {
            input.addEventListener('blur', function() {
              validateField(input, errorDiv, field.name);
            });
            
            input.addEventListener('input', function() {
              if (input.getAttribute('aria-invalid') === 'true') {
                validateField(input, errorDiv, field.name);
              }
            });
          }
        });

        // Form submission validation
        contactForm.addEventListener('submit', function(e) {
          let hasErrors = false;
          let firstErrorField = null;

          formFields.forEach(function(field) {
            const input = document.getElementById(field.id);
            const errorDiv = document.getElementById(field.id + '-error');
            
            if (input && errorDiv) {
              const isValid = validateField(input, errorDiv, field.name);
              if (!isValid && !firstErrorField) {
                firstErrorField = input;
                hasErrors = true;
              }
            }
          });

          if (hasErrors) {
            e.preventDefault();
            firstErrorField.focus();
            announceToScreenReader('Please correct the errors in the form before submitting.');
          }
        });
      }

      function validateField(input, errorDiv, fieldName) {
        let isValid = true;
        let errorMessage = '';

        if (!input.value.trim()) {
          isValid = false;
          errorMessage = fieldName + ' is required.';
        } else if (input.type === 'email' && !isValidEmail(input.value)) {
          isValid = false;
          errorMessage = 'Please enter a valid email address.';
        }

        input.setAttribute('aria-invalid', isValid ? 'false' : 'true');
        errorDiv.textContent = errorMessage;
        
        return isValid;
      }

      function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
      }
    </script>
    </body>

    </html>
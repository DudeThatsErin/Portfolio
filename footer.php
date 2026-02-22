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

    <!-- Sasha AI Widget -->
    <div id="sasha-widget">
      <div id="sasha-panel" role="dialog" aria-label="Chat with Sasha, Erin's AI" aria-modal="true" style="display:none">
        <div class="sasha-header">
          <div class="sasha-avatar" aria-hidden="true">S</div>
          <div class="sasha-header-text"><strong>Sasha</strong></div>
          <button id="sasha-close" class="sasha-close" aria-label="Close chat">&times;</button>
        </div>
        <div id="sasha-messages" class="sasha-messages" aria-live="polite" aria-label="Chat messages"></div>
        <div class="sasha-input-row">
          <input id="sasha-input" type="text" class="sasha-input" placeholder="Ask me anything&hellip;" aria-label="Message input" />
          <button id="sasha-send" class="sasha-send" aria-label="Send message">&#8593;</button>
        </div>
        <p class="sasha-footer">
          <a href="#" id="sasha-fullchat">Open full chat &rarr;</a>
        </p>
      </div>
      <button id="sasha-bubble" class="sasha-bubble" aria-label="Chat with Sasha, Erin's AI" aria-expanded="false">&#x1F4AC;</button>
    </div>

    <script>
    (function() {
      // TODO: Update these variables to point to the production server
      var SASHA_API = 'http://localhost:8000';
      var SASHA_FRONTEND = 'http://localhost:3000';
      var GREETING = "Hi! I'm Sasha, Erin's AI. Ask me anything about her \u2014 her work, projects, tech stack, or just say hi!";

      var panel = document.getElementById('sasha-panel');
      var bubble = document.getElementById('sasha-bubble');
      var closeBtn = document.getElementById('sasha-close');
      var messagesEl = document.getElementById('sasha-messages');
      var inputEl = document.getElementById('sasha-input');
      var sendBtn = document.getElementById('sasha-send');
      var fullchatLink = document.getElementById('sasha-fullchat');

      var messages = [];
      var loading = false;
      var chatId = localStorage.getItem('sasha_widget_chat_id');
      if (!chatId) {
        chatId = 'widget-' + Date.now();
        localStorage.setItem('sasha_widget_chat_id', chatId);
      }

      // Restore messages
      var stored = localStorage.getItem('sasha_widget_messages');
      if (stored) {
        try { messages = JSON.parse(stored); } catch(e) { messages = []; }
      }
      if (messages.length === 0) {
        messages = [{ role: 'assistant', content: GREETING }];
      }

      function saveMessages() {
        localStorage.setItem('sasha_widget_messages', JSON.stringify(messages));
      }

      function renderMessages() {
        messagesEl.innerHTML = '';
        messages.forEach(function(msg) {
          var div = document.createElement('div');
          div.className = 'sasha-msg ' + (msg.role === 'user' ? 'sasha-msg-user' : 'sasha-msg-bot');
          div.textContent = msg.content;
          if (msg.isOffline) {
            var links = document.createElement('span');
            links.className = 'sasha-offline-links';
            links.innerHTML = ' <a href="https://linkedin.com/in/erinskidds" target="_blank" rel="noopener noreferrer">LinkedIn</a> &middot; <a href="https://github.com/DudeThatsErin" target="_blank" rel="noopener noreferrer">GitHub</a>';
            div.appendChild(links);
          }
          messagesEl.appendChild(div);
        });
        if (loading) {
          var thinking = document.createElement('div');
          thinking.className = 'sasha-msg sasha-msg-bot sasha-thinking';
          thinking.textContent = 'Thinking\u2026';
          messagesEl.appendChild(thinking);
        }
        messagesEl.scrollTop = messagesEl.scrollHeight;
      }

      function setOpen(open) {
        panel.style.display = open ? 'flex' : 'none';
        bubble.setAttribute('aria-expanded', open ? 'true' : 'false');
        bubble.setAttribute('aria-label', open ? 'Close Sasha chat' : "Chat with Sasha, Erin's AI");
        bubble.innerHTML = open ? '&times;' : '&#x1F4AC;';
        if (open) {
          renderMessages();
          setTimeout(function() { inputEl.focus(); }, 50);
        }
      }

      async function sendMessage() {
        var text = inputEl.value.trim();
        if (!text || loading) return;
        inputEl.value = '';
        messages.push({ role: 'user', content: text });
        saveMessages();
        loading = true;
        renderMessages();

        var history = messages.slice(1, -1).map(function(m) {
          return { role: m.role, content: m.content };
        });

        try {
          var res = await fetch(SASHA_API + '/chat', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ message: text, chat_id: chatId, history: history })
          });
          if (!res.ok) throw new Error('HTTP ' + res.status);
          var data = await res.json();
          messages.push({ role: 'assistant', content: data.response });
        } catch(e) {
          messages.push({ role: 'assistant', content: "Sorry, I'm offline right now. You can reach Erin directly on:", isOffline: true });
        }
        loading = false;
        saveMessages();
        renderMessages();
      }

      bubble.addEventListener('click', function() {
        var isOpen = panel.style.display !== 'none';
        setOpen(!isOpen);
      });

      closeBtn.addEventListener('click', function() { setOpen(false); });

      sendBtn.addEventListener('click', sendMessage);

      inputEl.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) { e.preventDefault(); sendMessage(); }
      });

      fullchatLink.addEventListener('click', function(e) {
        e.preventDefault();
        window.open(SASHA_FRONTEND + '?import_chat=' + chatId, '_blank', 'noopener,noreferrer');
      });

      // Disable send when empty
      inputEl.addEventListener('input', function() {
        sendBtn.disabled = !inputEl.value.trim() || loading;
      });
      sendBtn.disabled = true;
    })();
    </script>
    </body>

    </html>
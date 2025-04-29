<div class="hangman_feat" data-project-type="personal">
    <div class="body">
        <h3 class="workTitle">Hangman</h3>
        <p class="details">This is a game I created in Python to test my knowledge of Python.</p>
        <button class="modal-button" href="#hangmanModal" aria-haspopup="dialog" aria-label="Read more about Hangman project">
            Click here to read more...
        </button>
    </div>
</div>

<div id="hangmanModal" class="modal" role="dialog" aria-labelledby="hangmanModalTitle" aria-hidden="true">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span class="close" aria-label="Close dialog">&times;</span>
            <h2 id="hangmanModalTitle">Hangman</h2>
        </div>
        <div class="modal-body">
            <div style="width: 100%; margin: 0 auto; text-align: center;">
                <img src="./assets/hangman.gif" class="img" alt="Screenshot of Hangman game interface" />
            </div>
            <p>
                This is a game I created in Python to test my knowledge of Python. The game includes different lengths of words to guess as well as a sound that plays when you click a letter. It also stores how many games you have played and whether you won or lost the game and displays that after you win or lose. You can choose new words by pressing "new game" and you can restart your guesses by pressing "restart". There is also an easy to press "quit" button for visually impared.
            </p>
        </div>
        <div class="modal-footer">
            <p class="langs"><strong>Languages Used:</strong> Python</p>
            <p><strong>Find Hangman Here:</strong></p>
            <div class="links" style="padding-top: 8px">
                <a href="https://gitlab.com/ErinSkidds/hangman" target="_blank" rel="noopener noreferrer" aria-label="View the Hangman game code on GitLab (opens in new tab)"><i class="fa-brands fa-gitlab" aria-hidden="true" title="View the Code"></i><span class="visually-hidden">View the Code on GitLab</span></a>
            </div>
        </div>
    </div>
</div>
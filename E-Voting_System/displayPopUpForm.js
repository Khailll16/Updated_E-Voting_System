document.addEventListener('DOMContentLoaded', (event) => {


    /*ADD VOTERS POP UP */

    const addpopup = document.getElementById('addvoters-popup');
    const addopenPopupBtn = document.getElementById('addvoters_openPopup');
    const addcloseFormBtn = document.querySelector('.voters-close-form-btn');

    addopenPopupBtn.onclick = function() {
        addpopup.style.display = 'block';
    }

    addcloseFormBtn.onclick = function() {
        addpopup.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == addpopup) {
            addpopup.style.display = 'none';
        }
    }

});
    


    /**ADD POSITION POP UP */

    document.addEventListener('DOMContentLoaded', (event) => {
    const addpositionpopup = document.getElementById('addposition-popup');
    const addpositionopenPopupBtn = document.getElementById('addposition-openPopup');
    const addpositioncloseFormBtn = document.querySelector('.addposition-close-form-btn');

    addpositionopenPopupBtn.onclick = function() {
        addpositionpopup.style.display = 'block';
    }

    addpositioncloseFormBtn.onclick = function() {
        addpositionpopup.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == addpositionpopup) {
            addpositionpopup.style.display = 'none';
        }
    }

});



    /**ADD CANDIDATE POP UP */
    document.addEventListener('DOMContentLoaded', (event) => {
    const addcandidatepopup = document.getElementById('addCandidates_popup');
    const addcandidateopenPopupBtn = document.getElementById('addCandidates_openPopup');
    const addcandidatecloseFormBtn = document.querySelector('.addCandidates_close-form-btn');

    addcandidateopenPopupBtn.onclick = function() {
        addcandidatepopup.style.display = 'block';
    }

    addcandidatecloseFormBtn.onclick = function() {
        addcandidatepopup.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == addcandidatepopup) {
            addcandidatepopup.style.display = 'none';
        }
    }

});

document.addEventListener('DOMContentLoaded', (event) => {
    const resetpositionpopup = document.getElementById('resetposition_popup');
    const resetpositionopenPopupBtn = document.getElementById('resetposition_openPopup');
    const resetpositioncloseFormBtn = document.querySelector('.resetposition_close-form-btn');

    resetpositionopenPopupBtn.onclick = function() {
        resetpositionpopup.style.display = 'block';
    }

    resetpositioncloseFormBtn.onclick = function() {
        resetpositionpopup.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == resetpositionpopup) {
            resetpositionpopup.style.display = 'none';
        }
    }

});


document.addEventListener('DOMContentLoaded', (event) => {
    const logoutpopup = document.getElementById('logout_popup');
    const logoutopenPopupBtn = document.getElementById('logout_openPopup');
    const logoutcloseFormBtn = document.querySelector('.logout_close-form-btn');

    logoutopenPopupBtn.onclick = function() {
        logoutpopup.style.display = 'block';
    }

    logoutcloseFormBtn.onclick = function() {
        logoutpopup.style.display = 'none';
    }

    window.onclick = function(event) {
        if (event.target == logoutpopup) {
            logoutpopup.style.display = 'none';
        }
    }

});

document.addEventListener('DOMContentLoaded', (event) => {
    const ballotpopup = document.getElementById('ballot-popup');
    const ballotcloseFormBtn = document.querySelectorAll('.ballot_close-form-btn');
    const ballotopenPopupBtns = document.querySelectorAll('.ballot-openPopup');
    const radioButtons = document.querySelectorAll('input[type="radio"]');

    // Restore previously selected votes
    restoreSelectedVotes();

    // Listen for radio button changes and save them in session storage
    radioButtons.forEach(radio => {
        radio.addEventListener('change', function () {
            saveVote(this.name, this.value);
        });
    });

    ballotopenPopupBtns.forEach(button => {
        button.addEventListener('click', function () {
            const candidateId = this.getAttribute('data-id');

            // AJAX request to fetch candidate details
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_candidate.php?id=' + candidateId, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    const candidateData = JSON.parse(xhr.responseText);

                    // Update the popup content with candidate details
                    document.getElementById('profile-picture').src = "Candidates/" + candidateData.candidate_profile;
                    document.querySelector('.profile-section p:nth-child(2)').textContent = candidateData.candidate_firstname + ' ' + candidateData.candidate_lastname;
                    document.querySelector('.profile-section p:nth-child(3)').textContent = candidateData.descrip;
                    document.querySelector('.form-section p:nth-child(2)').textContent = candidateData.platform;

                    // Show the popup
                    ballotpopup.style.display = 'block';
                }
            };
            xhr.send();
        });
    });

    // Make the pop-up disappear when clicking the close button
    ballotcloseFormBtn.forEach(button => {
        button.addEventListener('click', function () {
            ballotpopup.style.display = 'none'; // Hide the pop-up
        });
    });

    // Make the pop-up disappear when clicking outside of it
    window.addEventListener('click', function (event) {
        if (event.target == ballotpopup) {
            ballotpopup.style.display = 'none';
        }
    });

    // Save selected vote to session storage
    function saveVote(position, candidate) {
        let votes = JSON.parse(sessionStorage.getItem('votes')) || {};
        votes[position] = candidate;
        sessionStorage.setItem('votes', JSON.stringify(votes));
    }

    // Restore selected votes from session storage
    function restoreSelectedVotes() {
        let votes = JSON.parse(sessionStorage.getItem('votes')) || {};

        radioButtons.forEach(radio => {
            if (votes[radio.name] === radio.value) {
                radio.checked = true; // Restore the checked radio button
            }
        });
    }
});












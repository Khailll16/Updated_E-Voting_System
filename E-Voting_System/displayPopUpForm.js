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





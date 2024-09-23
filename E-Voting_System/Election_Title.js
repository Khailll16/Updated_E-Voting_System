document.addEventListener('DOMContentLoaded', (event) => {


    /*ADD VOTERS POP UP */

    const addpopup = document.getElementById('addvoters-popup');
    const addopenPopupBtn = document.getElementById('addvoters_openPopup');
    const addclosePopupBtn = document.querySelector('.voters-close');
    const addcloseFormBtn = document.querySelector('.voters-close-form-btn');

    addopenPopupBtn.onclick = function() {
        addpopup.style.display = 'block';
    }

    addclosePopupBtn.onclick = function() {
        addpopup.style.display = 'none';
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
    const addpositionclosePopupBtn = document.querySelector('.addposition-close');
    const addpositioncloseFormBtn = document.querySelector('.addposition-close-form-btn');

    addpositionopenPopupBtn.onclick = function() {
        addpositionpopup.style.display = 'block';
    }

    addpositionclosePopupBtn.onclick = function() {
        addpositionpopup.style.display = 'none';
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
    const addcandidateclosePopupBtn = document.querySelector('.addCandidates_close');
    const addcandidatecloseFormBtn = document.querySelector('.addCandidates_close-form-btn');

    addcandidateopenPopupBtn.onclick = function() {
        addcandidatepopup.style.display = 'block';
    }

    addcandidateclosePopupBtn.onclick = function() {
        addcandidatepopup.style.display = 'none';
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
    const resetpositionclosePopupBtn = document.querySelector('.resetposition_close');
    const resetpositioncloseFormBtn = document.querySelector('.resetposition_close-form-btn');

    resetpositionopenPopupBtn.onclick = function() {
        resetpositionpopup.style.display = 'block';
    }

    resetpositionclosePopupBtn.onclick = function() {
        resetpositionpopup.style.display = 'none';
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





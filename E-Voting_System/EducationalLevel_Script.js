// Adding Educational Level
document.getElementById('education-level').addEventListener('change', function () {
    const gradeSelect = document.getElementById('education-grade');
    gradeSelect.innerHTML = ''; // Clear previous options

    const level = this.value;
    let options = [];

    if (level === 'Primary Education') {
        options = ['1', '2', '3', '4', '5', '6'];
    } else if (level === 'Secondary Education') {
        options = ['7', '8', '9', '10'];
    } else if (level === 'Senior Education') {
        options = ['11', '12'];
    } else if (level === 'Tertiary Education') {
        options = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
    }

    options.forEach(option => {
        const optElement = document.createElement('option');
        optElement.value = option;
        optElement.textContent = option;
        gradeSelect.appendChild(optElement);
    });
});



// Editing Educational Level
document.getElementById('education-level').addEventListener('change', function () {
    
    const gradeSelect = document.getElementById('education-grade');
    gradeSelect.innerHTML = ''; // Clear previous options

    const level = this.value;
    let options = [];

    if (level === 'Primary Education') {
        options = ['1', '2', '3', '4', '5', '6'];
    } else if (level === 'Secondary Education') {
        options = ['7', '8', '9', '10'];
    } else if (level === 'Senior Education') {
        options = ['11', '12'];
    } else if (level === 'Tertiary Education') {
        options = ['1st Year', '2nd Year', '3rd Year', '4th Year'];
    }

    options.forEach(option => {
        const optElement = document.createElement('option');
        optElement.value = option;
        optElement.textContent = option;
        gradeSelect.appendChild(optElement);
    });

    // Set current grade year if defined (edit form only)
    const currentGradeYearElement = document.getElementById('current-grade-year');
    if (currentGradeYearElement && currentGradeYearElement.value) {
        gradeSelect.value = currentGradeYearElement.value; 
        currentGradeYearElement.value = ""; 
    }
});

// Trigger change event on page load for edit form if it exists
if (document.getElementById('current-grade-year')) {
    document.getElementById('education-level').dispatchEvent(new Event('change'));
}

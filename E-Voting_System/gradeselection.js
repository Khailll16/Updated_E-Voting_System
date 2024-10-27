    // JavaScript to dynamically load grades based on selected educational level
    document.getElementById('education-level').addEventListener('change', function() {
        const selectedLevel = this.value;
        const gradeSelect = document.getElementById('education-grade');
        
        gradeSelect.innerHTML = '<option value=""> Select Grade or Year Group </option>'; // Clear previous options

        if (selectedLevel) {
            fetch(`fetch_grades.php?education_level=${selectedLevel}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(grade => {
                        const option = document.createElement('option');
                        option.value = grade;
                        option.textContent = grade;
                        gradeSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error fetching grade data:', error));
        }
    });
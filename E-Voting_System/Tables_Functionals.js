document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.voters-list tr');  // Select all rows including the header row
    const entriesSelect = document.getElementById('entries');   // Dropdown for selecting entries per page
    const prevBtn = document.querySelector('.prev-btn');        // Previous button
    const nextBtn = document.querySelector('.next-btn');        // Next button
    const pageNumElement = document.querySelector('.pagination p');  // Page number display
    const showingEntries = document.querySelector('.entries p'); // "Showing X to Y of Z entries" text

    let currentPage = 1;
    let entriesPerPage = parseInt(entriesSelect.value);

    // Function to update the table display
    function updateTable() {
        const totalRows = rows.length - 1; // Exclude the header row
        const totalPages = Math.ceil(totalRows / entriesPerPage); // Calculate total pages

        // Hide all rows first
        rows.forEach((row, index) => {
            if (index === 0) return; // Skip header row
            row.style.display = 'none';
        });

        // Show rows for the current page
        const start = (currentPage - 1) * entriesPerPage + 1; // Calculate start index
        const end = Math.min(start + entriesPerPage - 1, totalRows); // Calculate end index

        for (let i = start; i <= end; i++) {
            rows[i].style.display = ''; // Show the row
        }

        // Update the pagination text
        showingEntries.textContent = `Showing ${start} to ${end} of ${totalRows} entries`;
        pageNumElement.textContent = currentPage;

        // Enable/Disable pagination buttons based on the current page
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;
    }

    // Event listener for changing entries per page
    entriesSelect.addEventListener('change', function () {
        entriesPerPage = parseInt(this.value); // Get selected value (10, 25, 50, 100)
        currentPage = 1; // Reset to first page
        updateTable(); // Update the table with the new entries per page
    });

    // Event listener for the "Next" button
    nextBtn.addEventListener('click', function () {
        const totalRows = rows.length - 1; // Total rows excluding header
        const totalPages = Math.ceil(totalRows / entriesPerPage); // Total pages based on entries per page
        if (currentPage < totalPages) {
            currentPage++; // Go to the next page
            updateTable();
        }
    });

    // Event listener for the "Prev" button
    prevBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--; // Go to the previous page
            updateTable();
        }
    });

    // Initial table update on page load
    updateTable();
});

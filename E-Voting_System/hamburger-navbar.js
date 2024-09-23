// Update your hamburger-navbar.js with this code
function toggleMenu() {
    const menu = document.querySelector('.menu-content');
    const icon = document.querySelector('.nav-burger .icon');
    
    if (menu.classList.contains('show')) {
        // Hide the menu with animation
        menu.classList.remove('show');
        setTimeout(() => {
            menu.style.display = "none"; // Ensure it's hidden after animation completes
        }, 400); // Matches the CSS transition duration
    } else {
        // Show the menu with animation
        menu.style.display = "block";
        setTimeout(() => {
            menu.classList.add('show');
        }, 10); // Small delay to trigger the animation after display block
    }

    // Toggle icon size if needed
    icon.style.fontSize = menu.classList.contains('show') ? "50px" : "50px"; // Adjust if necessary
}

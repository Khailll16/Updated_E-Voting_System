// Add this in your AnimationStartingPage.js file
window.onload = function() {
    const logo = document.querySelector('.logo img');
    const loginForm = document.querySelector('.form-login-admin');
    const loginButton = document.querySelector('.submit button');
    
    // Initially hide the logo, form, and button
    logo.style.opacity = '0';
    loginForm.style.opacity = '0';
    loginButton.style.opacity = '0';
    
    // Fade-in logo after page load
    setTimeout(() => {
        logo.style.opacity = '1';
        logo.style.animation = 'fadeIn 1s ease-in-out';
    }, 200); // Logo fades in after 200ms
    
    // Fade-in form after logo has faded in
    setTimeout(() => {
        loginForm.style.opacity = '1';
        loginForm.style.animation = 'fadeIn 1s ease-in-out';
    }, 600); // Form fades in after 600ms (200ms logo delay + 400ms)

    // Fade-in button after form has faded in
    setTimeout(() => {
        loginButton.style.opacity = '1';
        loginButton.style.animation = 'fadeIn 1s ease-in-out';
    }, 1100); // Button fades in after 1100ms (600ms form delay + 500ms)
};

// Add animation to circles
document.addEventListener("DOMContentLoaded", function() {
    const circles = document.querySelectorAll('#circle1, #circle2, #circle3');
    circles.forEach((circle, index) => {
        setTimeout(() => {
            if (circle.id === 'circle3') {
                // Apply a more noticeable animation to the upper-right circle
                circle.style.animation = `moveUpperRightCircle ${5 + index * 2}s infinite ease-in-out`;
            } else {
                circle.style.animation = `moveCircle ${5 + index * 2}s infinite ease-in-out`;
            }
        }, index * 300);
    });
});

// JavaScript to display the notification for 5 seconds
window.onload = function() {
    const notification = document.getElementById('notification');
        if (notification.innerHTML.trim() !== '') {
                notification.style.display = 'block';
                    setTimeout(() => {
                notification.style.display = 'none';
                    }, 5000);
        }
};
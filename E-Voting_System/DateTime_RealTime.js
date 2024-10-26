function setClockHands() {
    const now = new Date();
    
    const seconds = now.getSeconds();
    const minutes = now.getMinutes();
    const hours = now.getHours();

    const secondDegree = (seconds / 60) * 360;
    const minuteDegree = (minutes / 60) * 360 + (seconds / 60) * 6;
    const hourDegree = (hours % 12 / 12) * 360 + (minutes / 60) * 30;

    document.querySelector('.second-hand').style.transform = `translateX(-50%) rotate(${secondDegree}deg)`;
    document.querySelector('.minute-hand').style.transform = `translateX(-50%) rotate(${minuteDegree}deg)`;
    document.querySelector('.hour-hand').style.transform = `translateX(-50%) rotate(${hourDegree}deg)`;
}

function updateDateTime() {
    const now = new Date();

    // Format the date as YYYY-MM-DD for the date-only display
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const formattedDateDisplay = now.toLocaleDateString('en-US', options);
    document.getElementById('timeDisplay').textContent = formattedDateDisplay;

    // Format the datetime-local value for the disabled input
    const formattedDate = now.toISOString().split('T')[0];
    const formattedTime = now.toTimeString().slice(0, 5);
    document.getElementById('timePicker').value = `${formattedDate}T${formattedTime}`;
}

// Update clock hands and datetime display every second
setInterval(() => {
    setClockHands();
    updateDateTime();
}, 1000);

// Initial call to set date and time on page load
window.onload = () => {
    setClockHands();
    updateDateTime();
};

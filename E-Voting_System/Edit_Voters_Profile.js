function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();
    reader.onload = function() {
        const profilePicture = document.getElementById('profile-picture');
        profilePicture.src = reader.result;
    };
    reader.readAsDataURL(input.files[0]);
}

// To trigger file input when the overlay is clicked
document.querySelector('.overlay').addEventListener('click', () => {
    document.getElementById('file-input').click();
});

// fetch_sections.js

function fetchSections(grade) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "fetch_sections.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById("section").innerHTML = xhr.responseText;
        }
    };
    xhr.send("grade=" + grade);
}

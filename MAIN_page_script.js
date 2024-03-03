// JavaScript for toggling divs in FUNC_X.php files

// Function to hide all divs
function hideAll() {
    var divs = document.querySelectorAll('.dr-function');
    divs.forEach(function(div) {
        div.style.display = 'none';
    });
}

// Function to show specific div based on button clicked
function showDiv(divId) {
    hideAll(); // Hide all divs first
    var divToShow = document.getElementById(divId);
    if (divToShow) {
        divToShow.style.display = 'block';
    }
}

// Function to handle button clicks
function handleButtonClick(functionId) {
    showDiv(functionId);
}

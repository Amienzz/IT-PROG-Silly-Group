function hide(button){
    var parentDiv = button.parentElement;
    parentDiv.style.display = "none";
}

function show(div){
    div.style.display = "block";
}

function toggle(div){
    if (window.getComputedStyle(div).getPropertyValue("display") == "none"){
        div.style.display = "block";
    } else {
        div.style.display = "none";
    }
}

function toggleInput(inputId, checkboxId) {
    var inputField = document.getElementById(inputId);
    var checkbox = document.getElementById(checkboxId);

    inputField.style.display = (checkbox.checked) ? 'block' : 'none';
    inputField.required = checkbox.checked;
}

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
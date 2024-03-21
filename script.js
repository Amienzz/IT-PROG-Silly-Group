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
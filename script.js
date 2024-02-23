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
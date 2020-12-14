function checkBtn(checkButton){
    if (checkButton.checked) {
        document.getElementById("delete").disabled = false;
    } else {
        document.getElementById("delete").disabled = true;
    }
}
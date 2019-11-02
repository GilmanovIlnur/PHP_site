function validateForm() {
    let x = document.forms["form"]["number"].value;
    if (!isFinite(x) || x === ""){
        alert("Ну и какое это число?");
        return false;
    }else if (+x<0 || +x > 16){
        alert("Число должно принадлежать интервалу (0,16)");
        return false;
    }
}
function clearForm() {
    document.forms["form"]["r"].value = "";
}

function fixForm() {
    let x = document.forms["form"]["r"].value;
    x = x.replace(/[ \s0-9,:!&@#$%^()'"]/g, '').toUpperCase().trim()
    document.forms["form"]["r"].value = x;
}

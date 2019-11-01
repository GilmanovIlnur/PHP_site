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
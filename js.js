alert("js подключен")
console.log("qwerty")
function validateForm() {
    let x = document.forms["form"]["number"].value
    if (!isFinite(x) || x === ""){
        alert("Вы ввели не число")
        return false
    }else if (x<0 && x > 10){
        alert("Число должно принадлежать интервалу (0,10)")
        return false
    }
}
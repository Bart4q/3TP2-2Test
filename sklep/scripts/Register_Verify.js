var btn_zar = document.getElementById("btn_zarejestruj");
var form = document.getElementById("zarejestruj");
var poprawny= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
btn_zar.onclick = function() {
    let imie = document.querySelector("#imie").value;
    let nazwisko = document.querySelector("#nazwisko").value;
    let email = document.querySelector("#email").value;
    let haslo = document.querySelector("#haslo").value;
    let phaslo = document.querySelector("#phaslo").value;

    if(imie != '' && nazwisko != '' && email != '' && poprawny.test(email) && haslo != '' && haslo == phaslo){
        form.submit();
    }
    else {
        
    }

    if(imie == '') {
        document.querySelector("#imie").style.border = "1px solid red";
    }
    if(nazwisko == '') {
        document.querySelector("#nazwisko").style.border = "1px solid red";
    }
    if(!poprawny.test(email)){
        document.querySelector("#email").style.border = "1px solid red";
    }
    if(email == '') {
        document.querySelector("#email").style.border = "1px solid red";
    }
    if(haslo == '') {
        document.querySelector("#haslo").style.border = "1px solid red";
    }
    if(phaslo == '') {
        document.querySelector("#phaslo").style.border = "1px solid red";
    }
}

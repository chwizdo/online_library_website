let password = document.querySelector("#password");
let rePassword = document.querySelector("#re-password");
let passAlert = document.querySelector("#pass-alert");
let submit = document.querySelector("#submit");

rePassword.addEventListener("keyup", function() {
    if(rePassword.value == password.value) {
        passAlert.setAttribute("hidden","");
        submit.removeAttribute("disabled");
    } else {
        passAlert.removeAttribute("hidden");
        submit.setAttribute("disabled","");
    }
})
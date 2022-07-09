function checkUser(){
    if(userF.value.length >0){
        errDiv.classList.add("hidden");
        formChecks.username = true;
    }
    if(userF.value.length < 8){
        errMsg.textContent="username non valido almeno 8 caratteri";
        errDiv.classList.remove("hidden");
        userF.classList.add("error");
        formChecks.username = false;
    }
    if(userF.value.length === 0){
        errMsg.textContent="scrivi un username";
        errDiv.classList.remove("hidden");
        userF.classList.add("error");
        formChecks.username = false;
    }
}

function checkNameSurname(){
    if(nameF.value.length >0){
        formChecks.name=true;
    }
    else{
        nameF.classList.add("error");
        formChecks.name=false;
    }
    if(surnameF.value.length >0){
        formChecks.surname=true;
    }
    else{
        surnameF.classList.add("error");
        formChecks.surname=false;
    }
}

function checkEmail(){
    if(emailF.value.length > 0){
        if(!/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(String(email.value).toLowerCase())) {
            errMsg.textContent="email non valida, controlla";
            errDiv.classList.remove("hidden");
            emailF.classList.add('error');
            formChecks.email = false;
        }
        else{
            errDiv.classList.add("hidden");
            formChecks.email = true;
        }
    }
    else{
        errMsg.textContent="scrivi un'email";
        errDiv.classList.remove("hidden");
        emailF.classList.add('error');
        formChecks.email = false;
    }
}

function checkPass(){
    console.log("checkpass");
    if(passF.value.length >0){
            var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,16}$/;
            if(re.test(passF.value)){
                console.log("ok");
                errDiv.classList.add("hidden");
                formChecks.password = true;
            }
            else{
                errMsg.textContent="requisiti: tra 8 e 16 caratteri, almeno una minuscola, una maiuscola, un numero ed un carattere speciale.";
                errDiv.classList.remove("hidden");
                passF.classList.add("error");
                formChecks.password = false;
                console.log("err");
            }
    }
    else{
        errMsg.textContent="scrivi una password";
        errDiv.classList.remove("hidden");
        passF.classList.add("error");
        formChecks.password = false;
    }

}

function checkPassVALIDATOR(){
    if(passCheckF.value.length<0){
        passCheckF.classList.add("error");
        formChecks.password_validator = false;
    }
    else{
        if (passF.value === passCheckF.value){
            errDiv.classList.add("hidden");
            formChecks.password_validator = true;
        }
        else{
            errMsg.textContent="le password non combaciano";
            errDiv.classList.remove("hidden");
            passCheckF.classList.add("error");
            formChecks.password_validator = false;
        }
    }

}

const formChecks = {
    "username" : false,
    "name" : false,
    "surname" : false,
    "email" : false,
    "password" : false,
    "password_validator" : false,
};

function checkForm(event){
    if(formChecks.username !== true || formChecks.name !== true || formChecks.surname !== true || formChecks.email !== true || formChecks.password !== true || formChecks.password_validator !== true ){
        event.preventDefault();
    }

}

function resetStyle(event){
    event.currentTarget.classList.remove("error");
}

const userF = document.querySelector("#user");
userF.addEventListener("blur",checkUser);
userF.addEventListener("focus",resetStyle);
const nameF = document.querySelector("#name");
nameF.addEventListener("blur",checkNameSurname);
nameF.addEventListener("focus",resetStyle);
const surnameF = document.querySelector("#surname");
surnameF.addEventListener("blur",checkNameSurname);
surnameF.addEventListener("focus",resetStyle);
const emailF = document.querySelector("#email");
emailF.addEventListener("blur",checkEmail);
emailF.addEventListener("focus",resetStyle);
const passF = document.querySelector("#pass");
passF.addEventListener("blur",checkPass);
passF.addEventListener("focus",resetStyle);
const passCheckF = document.querySelector("#passCheck");
passCheckF.addEventListener("blur",checkPassVALIDATOR);
passCheckF.addEventListener("focus",resetStyle);


const form = document.querySelector("form");
form.addEventListener("submit",checkForm);

const errDiv = document.querySelector("#errors");
let errMsg = document.querySelector("#errMsg");
errMsg.classList.add("err");

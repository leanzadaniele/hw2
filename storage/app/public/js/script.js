

function checkValues(event){
    if(email.value.length === 0){
        email.classList.add("error");
        event.preventDefault();
    }
    if(password.value.length === 0) {
        password.classList.add("error");
        event.preventDefault();
    }
}

function resetStyle(event){
    event.currentTarget.classList.remove("error");
}

const email = document.querySelector("#email");
email.addEventListener("blur",checkValues);
email.addEventListener("focus",resetStyle);

const password = document.querySelector("#password");
password.addEventListener("blur",checkValues);
password.addEventListener("focus",resetStyle);

const form = document.querySelector("form");
form.addEventListener("submit",checkValues);
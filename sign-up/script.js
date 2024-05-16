//register
let loginMessage=document.getElementById('login-message');

function submitForm(event) {
    event.preventDefault(); 
    let form = document.forms.reg; 
    let formData = new FormData(form); 
    formData.append('register', '');
    fetch('../database/registration.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        if(message==='Successfully registered, you will be automatically redirected to the login page within 3 seconds!'){
            loginMessage.classList.add('valid');
            loginMessage.innerHTML = message; 
        setTimeout(function() {
            window.location.href = '../sign-in/sign-in.php';
        }, 3000)
        }
        else
        {
            loginMessage.innerHTML = message; 
            loginMessage.classList.add('invalid');
        }
    })
    .catch(error => console.error('Error:', error));

    return false; 
}

//Check doubled emails
let emailMessage = document.getElementById("email-message");
let emailform =document.getElementById("email-form");
let emailbox=document.getElementById("email-box")
let submitBtn = document.getElementById("submit-btn");
emailform.addEventListener('input', delayedCheck);

var timer;
function delayedCheck() {
    emailbox.classList.remove("invalid");
    emailbox.classList.remove("valid");
    emailMessage.innerHTML = ""
    clearTimeout(timer); 
    timer = setTimeout(checkEmail, 1500);
}

function checkEmail()
{
    let email = emailform.value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
            if(this.responseText=="Email is used, enter a new email address" || this.responseText=="Email is not valid, enter a valid email address"){
            emailbox.classList.remove("valid");
            emailbox.classList.add("invalid");
            emailMessage.classList.remove("valid");
            emailMessage.classList.add("invalid");
            submitBtn.disabled = true;
            emailMessage.innerHTML = this.responseText;

        }
        else{
            emailbox.classList.remove("invalid");
            emailbox.classList.add("valid");
            emailMessage.classList.remove("invalid");
            emailMessage.classList.add("valid");
            submitBtn.disabled = false;
            emailMessage.innerHTML = this.responseText;
        }
        
    };
    xhttp.open("GET", "./methods/checkpass.php?email=" + email, true);
    xhttp.send();
}

//check if all fields are compiled

const inputFields = document.querySelectorAll('.input-box input');
let contentMessage= document.getElementById('content-message');
let selectedField = null;
let allFieldsFilled = false;
submitBtn.disabled=true;


inputFields.forEach(inputField => {
    inputField.addEventListener('focus', () => {
        selectedField = inputField;
    });

    inputField.addEventListener('blur', () => {
        if (inputField.value.trim() === '' && selectedField === inputField) {
            inputField.parentElement.classList.add('invalid')
        } else {
            inputField.parentElement.classList.remove('invalid');
        }
    });

    inputField.addEventListener('input', () => {
        allFieldsFilled = Array.from(inputFields).every(field => field.value.trim() !== '');
        submitBtn.disabled = !allFieldsFilled;
    });
});

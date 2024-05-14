//login
let loginMessage=document.getElementById('login-message');

function submitForm(event) {
    event.preventDefault(); 
    let form = document.forms.reg; 
    let formData = new FormData(form); 
    formData.append('login', '');
    fetch('../database/login.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(message => {
        if(message==='Successfully logged in, you will be automatically redirected to the login page within 3 seconds!'){
            loginMessage.classList.remove('invalid');
            loginMessage.classList.add('valid');
            loginMessage.innerHTML = message; 
        setTimeout(function() {
            window.location.href = '../home/main.php';
        }, 3000)
        }
        else
        {
            loginMessage.classList.remove('valid');
            loginMessage.classList.add('invalid');
            loginMessage.innerHTML = message; 
        }
    })
    .catch(error => console.error('Error:', error));

    return false; 
}

// checkFields
const inputFields = document.querySelectorAll('.input-box input');
let contentMessage= document.getElementById('content-message');
let submitBtn = document.getElementById("login-btn");
submitBtn.disabled=true;
let allFieldsFilled = false;
let selectedField = null;

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

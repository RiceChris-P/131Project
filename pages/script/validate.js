const submitButton = document.getElementById('checkoutsubmit');
const firstname = document.querySelector('#firstName');
const lastname = document.querySelector('#lastName');
const email = document.querySelector('#email');
const check = document.querySelector('#check');
const password = document.querySelector('#password');
const retypepass = document.querySelector('#retypepass');
const phone = document.querySelector('#phone');
const address = document.querySelector('#address');
const state = document.querySelector('#state');
const city = document.querySelector('#city');
const zip = document.querySelector('#zip');
const cardname = document.querySelector('#cardname');
const cardnum = document.querySelector('#cardnum');
const cardexp = document.querySelector('#cardexp');
const cardcvv = document.querySelector('#cardcvv');

function validateNotEmpty() {
    let success = true;

    if(firstname.value.length ===0) {
        firstname.style.border = '2px solid';
        firstname.style.borderColor = 'red';
        alert("First name cannot be empty.");
        success =  false;
    }
    if(lastname.value.length ===0) {
        lastname.style.border = '2px solid';
        lastname.style.borderColor = 'red';
        alert("Last name cannot be empty.");
        success =  false;
    }
    if(address.value.length ===0) {
        address.style.border = '2px solid';
        address.style.borderColor = 'red';
        alert("Address cannot be empty.");
        success =false;
    }
    if(city.value.length ===0) {
        city.style.border = '2px solid';
        city.style.borderColor = 'red';
        alert("City cannot be empty.");
        success = false;
    }
    if(cardname.value.length ===0) {
        cardname.style.border = '2px solid';
        cardname.style.borderColor = 'red';
        alert("Card name cannot be empty.");
        success = false;
    }
    return success;
}

function createAccountValidation() {
    let success = true;
    if(check.checked) {
        if(password.value.length === 0) {
            password.style.border = '2px solid';
            password.style.borderColor = 'red';
            alert("Password cannot be empty.");
            success = false;
        }
        if(retypepass.value.length === 0) {
            retypepass.style.border = '2px solid';
            retypepass.style.borderColor = 'red';
            alert("Password cannot be empty.");
            success = false;
        }
        if(!(password.value === retypepass.value)) {
            password.style.border = '2px solid';
            password.style.borderColor = 'red';
            retypepass.style.border = '2px solid';
            retypepass.style.borderColor = 'red';
            alert("Passwords do not match.");
            success = false;
        }
    }
    return success;
}

function emailValidation() {
    if(!email.value.includes('@') || !email.value.includes('.')) {
        email.style.border = '2px solid';
        email.style.borderColor = 'red';
        alert("Email must in format emailaddress@domain.com (e.g., user@gmail.com).")
        return false;
    }
    return true;
}

function phoneValidation() {
    if(phone.value.toString().length != 10) {
        phone.style.border = '2px solid';
        phone.style.borderColor = 'red';
        alert("Phone must be 10 digits (e.g., 4151231234).");
        return false;
    }
    return true;
}

function stateValidation() {
    if(state.value.length != 2) {
        state.style.border = '2px solid';
        state.style.borderColor = 'red';
        alert("State must its abbreviated (e.g., CA).");
        return false;
    }
    return true;
}

function zipValidation() {
    if(zip.value.toString().length != 5) {
        zip.style.border = '2px solid';
        zip.style.borderColor = 'red';
        alert("Zipcode must be 5 digits (e.g., 94134).");
        return false;
    }
    return true;
}

function cardNumValidation() {
    if(cardnum.value.toString().length != 15 && cardnum.value.toString().length != 16) {
        cardnum.style.border = '2px solid';
        cardnum.style.borderColor = 'red';
        alert("Card number must be 15 or 16 digits (e.g., 123456789012345 or 1234567890123456).");
        return false;
    }
    return true;
}

function cardExpValidation() {
    if(cardexp.value.length != 5) {
        cardexp.style.border = '2px solid';
        cardexp.style.borderColor = 'red';
        alert("Card expiration date must be in format MM/YY (e.g., 01/23).");
        return false;
    }
    return false;
}

function cardCVVValidation() {
    if(cardcvv.value.toString().length != 3 && cardnum.value.toString().length != 4) {
        cardcvv.style.border = '2px solid';
        cardcvv.style.borderColor = 'red';
        alert("Card CVV must be 3 or 4 digits (e.g., 123 or 1234).");
        return false;
    }
    return true;
}

function validateForm() {
    let success = false;
    success = validateNotEmpty();
    success = emailValidation();
    success = phoneValidation();  
    success = createAccountValidation();
    success = stateValidation();
    success = zipValidation();
    success = cardNumValidation();
    success = cardExpValidation();
    success = cardCVVValidation();
    return success;
}

submitButton.addEventListener('click', e => {
    let success = false;
    success = validateForm();
    if(!success) {
        e.preventDefault();
    }
});

function validate() {
    let check = document.getElementById("check");
    if(check.checked) {
        document.getElementById("password").style.visibility = "visible";
        document.getElementById("retypepass").style.visibility = "visible";
    }
    else {
        document.getElementById("password").style.visibility = "hidden";
        document.getElementById("retypepass").style.visibility = "hidden";
    }
}

function isNumberKey(evt){
var charCode = (evt.which) ? evt.which : evt.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
    return false;
return true;
}
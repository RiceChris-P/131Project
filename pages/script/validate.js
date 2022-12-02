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

function checkValidate() {
    if(firstname.value.length == 0){
        alert("First name cannot be empty!");
        return false;
    }
    if(lastname.value.length == 0) {
        alert("Last name cannot be empty!");
        return false;
    }
    if(document.getElementById("email")) {
        if(email.value.length == 0) {
            alert("Email cannot be empty!");
            return false;
        }
        if(!email.value.includes('@') || !email.value.includes('.')) {
            alert("Email is invalid!");
            return false;
        }
        if(check.checked) {
            if(password.value.length == 0) {
                alert("Password cannot be empty");
                return false;
            }
            if(retypepass.value.length == 0) {
                alert("Retype password cannot be empty!");
                return false;
            }
            if(password.value != retypepass.value) {
                alert("Passwords do not match!");
                return false;
            }
        }
    }
    if(phone.value.length == 0) {
        alert("Phone number cannot be empty!");
        return false;
    }
    if(phone.value.length != 10) {
        alert("Phone number must be 10 digits long!");
        return false;
    }

    if(address.value.length == 0) {
        alert("Street Address cannot be empty!");
        return false;
    }
    if(state.value.length == 0) {
        alert("State cannot be empty");
        return false
    }
    if(state.value.length != 2) {
        alert("State must be two characters!");
        return false;
    }

    if(city.value.length == 0) {
        alert("City cannot be empty!");
        return false;
    }
    if(zip.value.length == 0) {
        alert("Zip cannot be empty!");
        return false;
    }
    if(zip.value.length != 5) {
        alert("Zip must be 5 digits long!");
        return false;
    }

    if(cardname.value.length == 0) {
        alert("Card name cannot be empty!");
        return false;
    }
    if(cardnum.value.length == 0) {
        alert("Card number cannot be empty!");
        return false;
    }
    if(cardnum.value.length != 15 && cardnum.value.length != 16) {
        alert("Card number must be 15 or 16 digits long");
        return false;
    }
    if(cardexp.value.length == 0) {
        alert("Card expiration date cannot be empty!");
        return false;
    }
    if(cardexp.value.length != 5) {
        alert("Card expiration must be 5 characters long (e.g., 01/23)");
        return false;
    }
    if(!cardexp.value.includes('/')) {
        alert("Card expiration date must include a /");
        return false;
    }
    if(cardcvv.value.length == 0) {
        alert("Card CVV cannot be empty!");
        return false;
    }
    if(cardcvv.value.length != 3 && cardcvv.value.length != 4) {
        alert("Card CVV must be 3 or 4 digits!");
        return false;
    }
    return true;
}

submitButton.addEventListener('click', e => {
    if(!checkValidate()) {
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
// flag variables
let validName = false;
let validUsername = false;
let validEmail = true; // email is optional
let validPassword = false;

// element variables
let nameField = document.getElementById("name");
let usernameField = document.getElementById("username");
let emailField = document.getElementById("email");
let passwordField = document.getElementById("password");
let submitButton = document.getElementById("submit");

nameField.addEventListener("keyup", validateName);
usernameField.addEventListener("keyup", validateUsername);
emailField.addEventListener("keyup", validateEmail);
passwordField.addEventListener("keyup", validatePassword);

toggleSubmitButton();

function validateName() {
    if (nameField.value.length > 50) {
        console.log("NAME IS GREATER THAN 50 CHARACTERS");
        validName = false;
    } else {
        validName = true;
    }
    toggleSubmitButton();
}

function validateUsername() {
    // check if username is taken
    toggleSubmitButton();
}

function validateEmail() {
    // check if email is invalid
    // check if email is taken
    toggleSubmitButton();
}

function validatePassword() {
    let password = passwordField.value;
    let numberRegex = /\d/;
    let lowerCaseRegex = /[a-z]/;
    let upperCaseRegex = /[A-Z]/;

    if (password.length < 8) {
        console.log("PASSWORD LESS THAN 8 CHARACTERS");
        validPassword = false;
    }

    if (!numberRegex.test(password)) {
        console.log("NUMBER NOT FOUND");
        validPassword = false;
    }

    if (!lowerCaseRegex.test(password)) {
        console.log("LOWERCASE CHARACTER NOT FOUND");
        validPassword = false;
    }

    if (!upperCaseRegex.test(password)) {
        console.log("UPPERCASE CHARACTER NOT FOUND");
        validPassword = false;
    }
    toggleSubmitButton();
}

function hasValidInformation() {
    return validName && validUsername && validEmail && validPassword;
}

function toggleSubmitButton() {
    if (hasValidInformation()) {
        submitButton.enabled = true;
    } else {
        submitButton.disabled = true;
    }
}

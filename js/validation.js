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

let nameValidation = document.getElementById("name-validation");
let usernameValidation = document.getElementById("username-validation");
let emailValidation = document.getElementById("email-validation");
let passwordValidation = document.getElementById("password-validation");

nameField.addEventListener("input", validateName);
usernameField.addEventListener("input", validateUsername);
emailField.addEventListener("input", validateEmail);
passwordField.addEventListener("input", validatePassword);

hideValidationRequirements();
toggleSubmitButton();

function validateName() {
    let nameLength = nameField.value.length;

    if (nameLength < 3 || nameLength > 50) {
        nameValidation.style.display = "block";
        validName = false;
    } else {
        nameValidation.style.display = "none";
        validName = true;
    }
    toggleSubmitButton();
}

function validateUsername() {
    usernameValidation.style.display = "block";

    validUsername = true;

    // check if username is taken
    toggleSubmitButton();
}

function validateEmail() {
    emailValidation.style.display = "block";

    validEmail = true;

    // check if email is invalid
    // check if email is taken
    toggleSubmitButton();
}

function validatePassword() {
    let flag = true;
    let password = passwordField.value;
    let numberRegex = /\d/;
    // TODO: specialCharacterRegex
    let lowerCaseRegex = /[a-z]/;
    let upperCaseRegex = /[A-Z]/;

    if (password.length < 8) {
        flag = false;
    }

    if (!numberRegex.test(password)) {
        flag = false;
    }

    if (!lowerCaseRegex.test(password)) {
        flag = false;
    }

    if (!upperCaseRegex.test(password)) {
        flag = false;
    }

    if (flag) {
        validPassword = true;
        passwordValidation.style.display = "none";
    } else {
        passwordValidation.style.display = "block";
    }

    toggleSubmitButton();
}

function hideValidationRequirements() {
    nameValidation.style.display = "none";
    usernameValidation.style.display = "none";
    emailValidation.style.display = "none";
    passwordValidation.style.display = "none";
}

function hasValidInformation() {
    return validName && validUsername && validEmail && validPassword;
}

function toggleSubmitButton() {
    if (hasValidInformation()) {
        submitButton.disabled = false;
    } else {
        submitButton.disabled = true;
    }
}

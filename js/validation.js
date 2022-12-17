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

nameField.addEventListener("keyup", validateName);
usernameField.addEventListener("keyup", validateUsername);
emailField.addEventListener("keyup", validateEmail);
passwordField.addEventListener("keyup", validatePassword);

hideValidationRequirements();
toggleSubmitButton();

function validateName() {
    nameValidation.style.display = "block";

    if (nameField.value.length > 50) {
        validName = false;
    } else {
        validName = true;
    }
    toggleSubmitButton();
}

function validateUsername() {
    usernameValidation.style.display = "block";

    // check if username is taken
    toggleSubmitButton();
}

function validateEmail() {
    emailValidation.style.display = "block";

    // check if email is invalid
    // check if email is taken
    toggleSubmitButton();
}

function validatePassword() {
    passwordValidation.style.display = "block";

    let flag = true;
    let password = passwordField.value;
    let numberRegex = /\d/;
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
        submitButton.enabled = true;
    } else {
        submitButton.disabled = true;
    }
}

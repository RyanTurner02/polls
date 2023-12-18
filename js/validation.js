// flag variables
let validName = false;
let validUsername = false;
let validPassword = false;

// element variables
let nameField = document.getElementById("name");
let usernameField = document.getElementById("username");
let passwordField = document.getElementById("password");
let submitButton = document.getElementById("submit");

let nameValidation = document.getElementById("name-validation");
let usernameValidation = document.getElementById("username-validation");
let passwordValidation = document.getElementById("password-validation");

nameField.addEventListener("input", validateName);
usernameField.addEventListener("input", validateUsername);
passwordField.addEventListener("input", validatePassword);

hideValidationRequirements();

function validateName() {
    let nameLength = nameField.value.length;

    if (nameLength > 50) {
        nameValidation.style.display = "block";
        validName = false;
    } else {
        nameValidation.style.display = "none";
        validName = true;
    }
}

function validateUsername() {
    usernameValidation.style.display = "block";

    validUsername = true;

    // check if username is taken
}

function validatePassword() {
    let flag = true;
    let password = passwordField.value;
    let numberRegex = /\d/;
    let specialCharRegex = /[^A-Za-z0-9]/;
    let lowerCaseRegex = /[a-z]/;
    let upperCaseRegex = /[A-Z]/;

    if (password.length < 8) {
        flag = false;
    }

    if (!numberRegex.test(password)) {
        flag = false;
    }

    if (!specialCharRegex.test(password)) {
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
}

function hideValidationRequirements() {
    nameValidation.style.display = "none";
    usernameValidation.style.display = "none";
    passwordValidation.style.display = "none";
}

function hasValidInformation() {
    return validName && validUsername && validPassword;
}

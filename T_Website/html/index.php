<?php
require_once 'config.php'; // Ensures database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Sign In and Sign Up Form</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="https://kit.fontawesome.com/58a6e500f6.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="form-box">
            <h1 id="title">Sign Up</h1>
            <form action="config.php" method="">
                <div class="input-group">
                    <div class="input-field" id="nameField">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Name" id="nameInput">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" id="emailInput">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="age" placeholder="Age" id="age">
                    </div>
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" id="passwordInput">
                    </div>
                    <p>Lost password <a href="#">Click Here!</a></p>
                </div>
                <div class="btn-field">
                    <button type="button" id="signupBtn">Sign up</button>
                    <button type="button" id="signinBtn" class="disable">Sign in</button>
                    <a href="main.php">
                        <button type="button" id="nextBtn" class="disable">Next</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        let signupBtn = document.getElementById("signupBtn");
        let signinBtn = document.getElementById("signinBtn");
        let nextBtn = document.getElementById("nextBtn");
        let nameField = document.getElementById("nameField");
        let title = document.getElementById("title");
        let ageCheckboxContainer = document.createElement("div");
        ageCheckboxContainer.className = "input-field";
        ageCheckboxContainer.innerHTML = `
            <input type="checkbox" id="ageCheckbox">
            <label for="ageCheckbox">Are you 18+ years old?</label>
        `;

        signupBtn.onclick = function() {
            nameField.style.maxHeight = '60px';
            title.innerHTML = " Sign Up";
            nextBtn.classList.add("disable");
            signinBtn.classList.add("disable");
            signupBtn.classList.remove("disable");

            // Remove age verification checkbox if it exists
            if (ageCheckboxContainer.parentNode) {
                ageCheckboxContainer.parentNode.removeChild(ageCheckboxContainer);
            }
        }

        signinBtn.onclick = function() {
            nameField.style.maxHeight = '0';
            title.innerHTML = " Sign In";
            nextBtn.classList.add("disable");
            signupBtn.classList.add("disable");
            signinBtn.classList.remove("disable");

            // Append age verification checkbox if it doesn't exist
            if (!ageCheckboxContainer.parentNode) {
                document.querySelector(".input-group").appendChild(ageCheckboxContainer);
            }
        }

        function checkForm() {
            let ageCheckbox = document.getElementById("ageCheckbox");
            let emailInput = document.getElementById("emailInput");
            let passwordInput = document.getElementById("passwordInput");

            if ((ageCheckbox && ageCheckbox.checked) && emailInput.value && passwordInput.value) {
                nextBtn.classList.remove("disable");
            } else {
                nextBtn.classList.add("disable");
            }
        }

        nextBtn.onclick = function() {
            alert("Successfully signed up! Progressing to the index page.");
            // Replace the alert with actual logic to navigate to the index page.
        }

        // Add event listener to the age checkbox to check form status
        ageCheckboxContainer.addEventListener("change", checkForm);

        // Call checkForm on input change for email and password
        document.getElementById("emailInput").addEventListener("input", checkForm);
        document.getElementById("passwordInput").addEventListener("input", checkForm);
    </script>
</body>
</html>

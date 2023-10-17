document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("login-form");
    const usernameInput = document.getElementById("username");
    const passwordInput = document.getElementById("password");

    loginForm.addEventListener("submit", function (event) {
        // Check if the username and password fields are empty
        if (usernameInput.value.trim() === "" || passwordInput.value.trim() === "") {
            alert("Username and password are required fields.");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
});

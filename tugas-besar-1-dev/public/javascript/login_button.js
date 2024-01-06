document.addEventListener('DOMContentLoaded', function() {

    const passwordField = document.getElementById("password");
    const passwordPeek = document.getElementById("peek-password");

    passwordPeek.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            // If it's a password input, change it to text to reveal the password
            passwordField.type = 'text';
        } else {
            // If it's a text input, change it back to a password input to hide the password
            passwordField.type = 'password';
        }
    })

});
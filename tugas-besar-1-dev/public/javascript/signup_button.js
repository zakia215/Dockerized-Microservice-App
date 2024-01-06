document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('profile-pic');
    const chooseFileButton = document.getElementById('choose-file-button');
    const chooseFileParagraph = document.querySelector('.chosen-file');
    const passwordField = document.getElementById("password");
    const confirmField = document.getElementById("confirmpassword");
    const passwordPeek = document.getElementById("peek-password");
    const confirmPeek = document.getElementById("peek-confirm");
    
    chooseFileButton.addEventListener('click', () => {
        fileInput.click();
    });
    
    passwordPeek.addEventListener('click', () => {
        if (passwordField.type === 'password') {
            // If it's a password input, change it to text to reveal the password
            passwordField.type = 'text';
        } else {
            // If it's a text input, change it back to a password input to hide the password
            passwordField.type = 'password';
        }
    })
    
    confirmPeek.addEventListener('click', () => {
        if (confirmField.type === 'password') {
            // If it's a password input, change it to text to reveal the password
            confirmField.type = 'text';
        } else {
            // If it's a text input, change it back to a password input to hide the password
            confirmField.type = 'password';
        }
    })

    fileInput.addEventListener('change', (event) => {
        if (fileInput.files.length > 0) {
            chooseFileParagraph.textContent = fileInput.files[0].name;
        } else {
            chooseFileParagraph.textContent = 'No file chosen, yet.';
        }
    });



});

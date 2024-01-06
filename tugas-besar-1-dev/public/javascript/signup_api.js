const registerForm = document.getElementById('register-form');

const util = new Util();

registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('confirmpassword').value;
    const profilePicture = document.getElementById('profile-pic').files[0];
    const adminCheckbox = document.getElementById('is_admin');
    const adminContainer = document.getElementsByClassName("sign-up-as-admin")[0];
    const error = document.getElementById('error');

    let isAdmin = false;
    if (adminCheckbox.checked) {
        isAdmin = true;
    }

    const payload = {
        username,
        password,
        "confirm-password": passwordConfirm,
        "profile-picture": profilePicture || "",
        "is-admin": isAdmin
    };

    if (payload["profile-picture"] !== "") {

        const response = await util.uploadFile(profilePicture, '/api/upload');
        console.log(response);
        const JSONresponse = JSON.parse(response);

        if (!JSONresponse.success) {
            alert(JSONresponse.message);
        } else {
            payload["profile-picture"] = JSONresponse.data;
        }

    }

    const response = await util.post('/api/signup', payload);
    // console.log(response);
    const JSONresponse = JSON.parse(response);

    if (JSONresponse.success) {
        window.location.href = '/login';
        error.style.display = 'none';
        adminContainer.style.marginBottom = '15px';
    } else {
        error.innerHTML = JSONresponse.message;
        error.style.display = 'block';
        error.style.color = 'red';
        error.style.marginBottom = '9px';
        error.style.marginTop = '5px';
        error.style.width = '250px';
        error.style.fontSize = '14px';
        adminContainer.style.marginBottom = '0';
    }
});
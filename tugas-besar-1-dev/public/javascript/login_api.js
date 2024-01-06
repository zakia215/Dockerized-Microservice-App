const util = new Util();
const loginForm = document.getElementById('login-form');

loginForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const warningText = document.getElementById('error');

    const payload = {
        username,
        password
    };

    const response = await util.post('/api/login', payload);
    console.log(response);
    const JSONresponse = JSON.parse(response);

    if (JSONresponse.success) {
        window.location.href = '/browse';
        loginForm.style.marginTop = '10px';
        warningText.style.display = 'none';
    } else {
        loginForm.style.marginTop = '5px';
        warningText.style.color = 'red';
        warningText.style.fontSize = '14px';
        warningText.style.margin = '0';
        warningText.style.padding = '0';
        warningText.style.marginTop = '5px';
        warningText.style.display = 'block';
        warningText.style.width = '250px';
        warningText.innerHTML = JSONresponse.message;
    }
});
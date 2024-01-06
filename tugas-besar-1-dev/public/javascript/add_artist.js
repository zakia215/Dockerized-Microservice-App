const addArtistForm = document.getElementById('add-artist-form');
const util = new Util();

const profilePicture = document.getElementById('image-container');
const editText = document.getElementById('edit-photo');
const profileMask = document.getElementById('profile-mask');
const profilePictureInput = document.getElementById('imgFile');
const editArtistNameButton = document.getElementById('edit-artist-name');
const artistNameField = document.getElementById('artistName');
const pictureInput = document.getElementById('imgFile');
const pic = document.getElementById('artist-profile');

addArtistForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const artistName = document.getElementById('artistName').value;
    const imgFile = document.getElementById('imgFile').files[0];
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!artistName || !imgFile) {
        alert("Please provide both artist name and an image file.");
        return;
    }

    const payload = {
        artistName,
        "imgFile": imgFile || "",
        username,
        password,
        email
    };

    if ("imgFile" !== "") {

        const response = await util.uploadFile(imgFile, '/api/upload');
        console.log(response);
        const JSONresponse = JSON.parse(response);

        if (!JSONresponse.success) {
            alert(JSONresponse.message);
        } else {
            payload["imgFile"] = JSONresponse.data;
        }

    }

    const response = await util.post('/api/add-artist', payload);
    console.log(response);
    window.location.href = "/browse/artist";
    const JSONresponse = JSON.parse(response);

    if (JSONresponse.success) {
        console.log("hore!")
    } else {
        alert(JSONresponse.message);
    }

});

profilePicture.addEventListener('mouseenter', () => {
    editText.style.display = 'block';
    profileMask.style.display = 'block';
});

profilePicture.addEventListener('mouseleave', () => {
    editText.style.display = 'none';
    profileMask.style.display = 'none';
});

profilePicture.addEventListener('click', () => {
    profilePictureInput.click();
})

editArtistNameButton.addEventListener('click', () => {
    artistNameField.click();
});

pictureInput.addEventListener('change', () => {
    const fileObj = pictureInput.files[0];
    if (fileObj) {
        const fileUrl = URL.createObjectURL(fileObj);
        pic.src = fileUrl;
        
    }
});
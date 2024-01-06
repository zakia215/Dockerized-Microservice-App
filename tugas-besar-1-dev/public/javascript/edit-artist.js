
const util = new Util();
const editProfileForm = document.getElementById('edit-profile-form');
const image_container_profile = document.getElementById('image-container-profile');
const image_profile_picture = document.getElementById('image-profile-picture');
const edit_photo_profile_text = document.getElementById('edit-photo-profile');
const profile_mask_edit = document.getElementById('profile-mask-edit');
const img_file_input_profile = document.getElementById('imgFileInputProfile');

editProfileForm.addEventListener('submit', async(e) =>{
    e.preventDefault();
    const username = document.getElementById('username-info').value;
    const profile_picture = document.getElementById('imgFileInputProfile').files[0];
    const account_username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    const payload = {
        "name": username,
        "profile-picture": profile_picture || "",
        username: account_username,
        email,
        password
    }

    if (payload["profile-picture"] !== "") {
        const response1 = await util.uploadFile(profile_picture, '/api/upload');
        console.log(response1);
        const JSONresponse1 = JSON.parse(response1);
        if (!JSONresponse1.success) {
            alert(JSONresponse1.message);
        } else {
            payload["profile-picture"] = JSONresponse1.data;
        }
    }

    const response2 = await util.put("/api/browse/artist/" + artist_id, payload);
    // console.log(response2);

    window.location.href = "/browse/artist";

    // const JSONResponseFinal = JSON.parse(response2);

})


image_container_profile.addEventListener('mouseenter', () => {
    edit_photo_profile_text.style.display = 'block';
    profile_mask_edit.style.display= 'block';
})
image_container_profile.addEventListener('mouseleave', () => {
    edit_photo_profile_text.style.display = 'none';
    profile_mask_edit.style.display= 'none';
})
image_container_profile.addEventListener('click', () => {
    img_file_input_profile.click();
})

img_file_input_profile.addEventListener('change', () => {
    const fileObj = img_file_input_profile.files[0];
    if (fileObj) {
        const fileUrl = URL.createObjectURL(fileObj);
        image_profile_picture.src = fileUrl;
        
    }
});

function changePath(originalPath) {
    const parts = originalPath.split('/');
    
    const upLevels = parts.length - 4;
    const upLevelArray = Array(upLevels).fill('..');    
    const newPath = upLevelArray.concat(parts.slice(-1)).join('/');
    
    return newPath;
  }

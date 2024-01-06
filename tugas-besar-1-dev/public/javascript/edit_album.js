const addAlbumForm = document.getElementById('add-album-form');
const util = new Util();
const albumTitle = document.getElementById('title');
const image_container = document.getElementById('image-container-album');
const cover_art_song = document.getElementById('cover_art_album');
const profile_mask = document.getElementById('profile-mask-album');
const edit_photo = document.getElementById('edit-photo-album');
const inputImgFile = document.getElementById('cover_art');

addAlbumForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const title = document.getElementById('title').value;
    const artist_id = document.getElementById('artist_id').value;
    const cover_art = document.getElementById('cover_art').files[0];
    const description = document.getElementById('description').value;

    const payload = {
        title,
        "cover_art": cover_art || "",
        description,
        artist_id,
    };
    if (cover_art !== "") {

        const response = await util.uploadFile(cover_art, '/api/upload');
        console.log(response);
        const JSONresponse = JSON.parse(response);

        if (!JSONresponse.success) {
            alert(JSONresponse.message);
        } else {
            payload["cover_art"] = JSONresponse.data;
        }

    }

    const response = await util.put('/api/browse/album/' + album_id, payload);
    console.log(response);
    const JSONResponseFinal = JSON.parse(response);
    
    window.location.href = "/browse/album";

    if (JSONResponseFinal.success) {
        console.log("hore!")
    } else {
        alert(JSONResponseFinal.message);
    }


});

image_container.addEventListener('mouseenter', () => {
    edit_photo.style.display = 'block';
    profile_mask.style.display= 'block';
})
image_container.addEventListener('mouseleave', () => {
    edit_photo.style.display = 'none';
    profile_mask.style.display= 'none';
})
image_container.addEventListener('click', () => {
    inputImgFile.click();
})
editTitleButton.addEventListener('click', () =>{
    albumTitle.click();
})
imgFileSongInput.addEventListener('change', () => {
    const fileObj = imgFileSongInput.files[0];
    if (fileObj) {
        const fileUrl = URL.createObjectURL(fileObj);
        cover_art_song.src = fileUrl;
        
    }
});

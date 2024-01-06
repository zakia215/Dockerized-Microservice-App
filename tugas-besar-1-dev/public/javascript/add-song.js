const addSongForm = document.getElementById('add-song-form');
const util = new Util();

const songTitle = document.getElementById('songTitle');
const editTitleButton = document.getElementById('edit-song-title');
const artist_id = document.getElementById('artist_id_song');
const album_id = document.getElementById('album_id_song');

const image_container = document.getElementById('image-container-song');
const cover_art_song = document.getElementById('cover_art_song');
const profile_mask = document.getElementById('profile-mask-song');
const edit_photo = document.getElementById('edit-photo-song');
const imgFileSongInput = document.getElementById('imgFileSongInput');
const chooseAudioFileButton = document.getElementById('choose-audio-button');
const audioSongInput = document.getElementById('audio-song-file');
addSongForm.addEventListener('submit', async(e) =>{
    e.preventDefault();
    const title = document.getElementById('songTitle').value;
    console.log(title);
    const file_path = document.getElementById('audio-song-file').files[0]
    const cover_art = document.getElementById('imgFileSongInput').files[0];
    const album_id = document.getElementById('album_id_song').value;
    const genre = document.getElementById('genre-song').value;
    const artist_id = document.getElementById('artist_id_song').value;
    if(!title || !file_path || !cover_art || !album_id || !genre || !artist_id){
        alert("Please fill all fields!");
        return;
    }
    const payload = {
        title,
        file_path,
        cover_art,
        album_id,
        genre,
        artist_id,
    }
    console.log(payload);
    // upload cover_art song
    const response1 = await util.uploadFile(cover_art, 'api/upload');
    console.log(response1);
    const JSONresponse1 = JSON.parse(response1);
    if (!JSONresponse1.success) {
        alert(JSONresponse1.message);
    } else {
        payload["cover_art"] = JSONresponse1.data;
    }

    // upload audio file 
    const response2 = await util.uploadFile(file_path, 'api/upload');
    console.log(response2);
    const JSONresponse2 = JSON.parse(response2);
    if (!JSONresponse2.success) {
        alert(JSONresponse2.message);
    } else {
        payload["file_path"] = JSONresponse2.data;
    }
    const insertResponse = await util.post('/api/add-song', payload)
    console.log(insertResponse);
    window.location.href = '/browse/song';
    if (insertResponse.success) {
        console.log("hore!")
    } else {
        alert(insertResponse.message);
    }
})


image_container.addEventListener('mouseenter', () => {
    edit_photo.style.display = 'block';
    profile_mask.style.display= 'block';
})
image_container.addEventListener('mouseleave', () => {
    edit_photo.style.display = 'none';
    profile_mask.style.display= 'none';
})
image_container.addEventListener('click', () => {
    imgFileSongInput.click();
})
editTitleButton.addEventListener('click', () =>{
    songTitle.click();
})
imgFileSongInput.addEventListener('change', () => {
    const fileObj = imgFileSongInput.files[0];
    if (fileObj) {
        const fileUrl = URL.createObjectURL(fileObj);
        cover_art_song.src = fileUrl;
        
    }
});
chooseAudioFileButton.addEventListener('click', () =>{
    audioSongInput.click();
})


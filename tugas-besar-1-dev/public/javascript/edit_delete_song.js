// const util = new Util();
const deleteSongButtons = document.getElementsByClassName('delete-button');
console.log(deleteSongButtons);
// Loop through all delete buttons and attach a click event listener to each
Array.from(deleteSongButtons).forEach(deleteSongButton => {
    console.log(deleteSongButton)
    deleteSongButton.addEventListener('click', async (e) => {
        console.log("hai");
        e.preventDefault();
        const song_id = deleteSongButton.getAttribute('song-id'); // Use 'data-song-id'
        
        if (confirm('Are you sure you want to delete this song?')) {
            try {
                // Assuming 'util.delete' takes a URL with the songId as a parameter
                const response = await util.delete('/api/browse/song/' + song_id);

                // Redirect to the desired page after successful deletion
                window.location.href = "/browse/song";
            } catch (error) {
                console.error('Error deleting song:', error);
            }
        }
    });
});


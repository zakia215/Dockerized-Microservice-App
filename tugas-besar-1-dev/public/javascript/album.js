const util = new Util();


Array.from(document.getElementsByClassName('delete-button')).forEach(deleteAlbumButton => {;
    console.log(deleteAlbumButton)
    deleteAlbumButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const album_id = deleteAlbumButton.getAttribute('album-id'); 
        
        if (confirm('Are you sure you want to delete this album?')) {
            try {
                const response = await util.delete('/api/browse/album/' + album_id);
                console.log(response);
                window.location.href = "/browse/album";
            } catch (error) {
                console.error('Error deleting album:', error);
            }
        }
    });
});
const util = new Util();


Array.from(document.getElementsByClassName('delete-button')).forEach(deleteArtistButton => {;
    console.log(deleteArtistButton)
    deleteArtistButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const artist_id = deleteArtistButton.getAttribute('artist-id'); 
        
        if (confirm('Are you sure you want to delete this artist?')) {
            try {
                const response = await util.delete('/api/browse/artist/' + artist_id);
                console.log(response);
                window.location.href = "/browse/artist";
            } catch (error) {
                console.error('Error deleting artist:', error);
            }
        }
    });
});
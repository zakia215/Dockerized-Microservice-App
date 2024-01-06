const util = new Util();

const cardContainer = document.getElementById('card-container');

function handlePodcasterClick(e){
    const podcasterId = e.target.getAttribute('data-id');
    subscribeToPodcaster(podcasterId);
    console.log('Subscribed to Podcaster with ID:', podcasterId);
}

var showAllPodcasters = util.debounce(async() => {
    // e.preventDefault();
    const payload = {
        "user-id": userId
    };
    let url = '/api/subscribed-podcaster';
    const response = await util.get(url, payload, false);
    const responseArray = response.split('<div id="separator"></div>');
    // console.log(response);
    cardContainer.innerHTML = responseArray[0];

    // Add event listeners to the newly added subscribe buttons
    Array.from(document.getElementsByClassName('subscribed-podcaster')).forEach(button => {
        button.addEventListener('click', handlePodcasterClick);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    showAllPodcasters();
});
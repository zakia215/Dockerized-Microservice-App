const util = new Util();

const cardContainer = document.getElementById('card-container');
const pageContainer = document.getElementsByClassName('page-number-container')[0];
console.log("hai", userId);
function handleSubscribeClick(e){
    if (e.target.classList.contains('subscribe-button')) {
        const podcasterId = e.target.getAttribute('data-id');
        subscribeToPodcaster(podcasterId);
        console.log('Subscribed to Podcaster with ID:', podcasterId);
    }
}

async function subscribeToPodcaster(podcasterId) {
    const url = '/api/subscription';
    const payload = {
        creator_id: podcasterId,
        user_id: userId // Ensure this is defined elsewhere in your script or PHP
    };
    const response = await util.post(url, payload, false);
    console.log('Response:', response);
}

var showAllPodcasters = util.debounce(async() => {
    // e.preventDefault();
    const payload = {};
    let url = '/api/all-podcasters';
    const response = await util.get(url, payload, false);
    const responseArray = response.split('<div id="separator"></div>');
    // console.log(response);
    cardContainer.innerHTML = responseArray[0];

    // Add event listeners to the newly added subscribe buttons
    Array.from(document.getElementsByClassName('subscribe-button')).forEach(button => {
        button.addEventListener('click', handleSubscribeClick);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    showAllPodcasters();
});

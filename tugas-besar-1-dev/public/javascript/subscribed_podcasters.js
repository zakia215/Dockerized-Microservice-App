const util = new Util();

const cardContainer = document.getElementById('card-container')
const pageContainer = document.getElementsByClassName('page-number-container')[0];

var showAllSubscribedPodcasters = util.debounce(async(e) => {
    e.preventDefault();
    const payload = {
        podcaster_id
    }
    let url = "/api/podcast/" + podcaster_id;
    const response = await util.get(url, payload, false)
    console.log('hai')
    console.log(response);
    // url += `?page=${payload["page"]}`;
    // url += `&limit=${payload["limit"]}`;
    const responseArray = response.split('<div id="separator"></div>');
    console.log(response);
    cardContainer.innerHTML = responseArray[0];
    
})
document.addEventListener('DOMContentLoaded', showAllPodcasts)

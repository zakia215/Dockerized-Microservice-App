const util = new Util();

const searchForm = document.getElementById('search-form');
const searchKey = document.getElementById('search-key');
const submitButton = document.getElementById('submit-button')

const searchBy = document.getElementById('search-song-by');
const sortAttribute = document.getElementById('sort-song');
const sortOrder = document.getElementById('is-asc');
const sortOrderButton = document.getElementById('sort-order-button');
const genreFilter = document.getElementById('filter-genre');
const dateFilter = document.getElementById('filter-release-date');

const formContainer = document.querySelector('.container');
const searchContainer = formContainer.querySelector('form');

const cardContainer = document.getElementById('card-container');
const pageContainer = document.getElementsByClassName('page-number-container')[0];

const selectedPage = document.getElementById('selected-page');
const deleteSongButtons = document.getElementsByClassName('delete-button');

var submitForm = util.debounce(async (e) => {
    e.preventDefault();

    // create payload
    const payload = {
        "search-key": searchKey.value,
        "search-by": searchBy.value,
        "sort-attribute": sortAttribute.value === "" ? "title" : sortAttribute.value,
        "is-asc": sortOrder.checked,
        "genre": genreFilter.value,
        "date": dateFilter.value,
        "page": selectedPage.value,
        "limit": "49"
    };

    // create url
    let url = '/api/browse/song';
    url += `?search-key=${payload["search-key"]}`;
    url += `&search-by=${payload["search-by"]}`;
    url += `&sort-attribute=${payload["sort-attribute"]}`;
    url += `&is-asc=${payload["is-asc"]}`;
    url += `&genre=${payload["genre"]}`;
    url += `&date=${payload["date"]}`;
    url += `&page=${payload["page"]}`;
    url += `&limit=${payload["limit"]}`;

    // send and receive response
    const response = await util.get(url, payload, false);
    const responseArray = response.split('<div id="separator"></div>');
    console.log(response);
    cardContainer.innerHTML = responseArray[0];
    pageContainer.innerHTML = responseArray[1];

    const pageButtons = pageContainer.querySelectorAll('a');
    const pageButtonsLength = pageButtons.length;
    const prevButton = pageButtons[0];
    prevButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (selectedPage.value > 1) {
            selectedPage.value = parseInt(selectedPage.value) - 1;
            console.log(selectedPage.value);
            submitForm(e);
        }
    });
    for (let i = 1; i < pageButtonsLength - 1; i++) {
        const pageButton = pageButtons[i];
        pageButton.addEventListener('click', (e) => {
            e.preventDefault();
            const pageButtonsValue = pageButton.getElementsByTagName('p')[0];
            selectedPage.value = pageButtonsValue.innerHTML;
            console.log(selectedPage.value)
            submitForm(e);
        });
    }
    const nextButton = pageButtons[pageButtonsLength - 1];
    nextButton.addEventListener('click', function (e) {
        e.preventDefault();
        const currentPage = parseInt(selectedPage.value);
        if (selectedPage.value < pageButtonsLength - 2) {
            selectedPage.value = currentPage + 1;
            console.log(selectedPage.value);
            submitForm(e);
        }
    });
});

var showAllSongs = util.debounce(async (e) => {
    e.preventDefault();
    // create payload
    
    const payload = {
        "search-key": searchKey.value,
        "search-by": searchBy.value,
        "sort-attribute": sortAttribute.value === "" ? "title" : sortAttribute.value,
        "is-asc": sortOrder.checked,
        "genre": genreFilter.value,
        "date": dateFilter.value,
        "page": "1",
        "limit": "49"
    };

    // create url
    let url = '/api/browse/song';
    url += `?search-key=${payload["search-key"]}`;
    url += `&search-by=${payload["search-by"]}`;
    url += `&sort-attribute=${payload["sort-attribute"]}`;
    url += `&is-asc=${payload["is-asc"]}`;
    url += `&genre=${payload["genre"]}`;
    url += `&date=${payload["date"]}`;
    url += `&page=${payload["page"]}`;
    url += `&limit=${payload["limit"]}`;

    const response = await util.get(url, payload, false);
    console.log(response);
    const responseArray = response.split('<div id="separator"></div>');
    console.log(responseArray);
    cardContainer.innerHTML = responseArray[0];
    pageContainer.innerHTML = responseArray[1];

    selectedPage.value = "1";

    const pageButtons = pageContainer.querySelectorAll('a');
    const pageButtonsLength = pageButtons.length;
    const prevButton = pageButtons[0];
    prevButton.addEventListener('click', (e) => {
        e.preventDefault();
        if (selectedPage.value > 1) {
            selectedPage.value = parseInt(selectedPage.value) - 1;
            console.log(selectedPage.value);
            submitForm(e);
        }
    });
    for (let i = 1; i < pageButtonsLength - 1; i++) {
        const pageButton = pageButtons[i];
        pageButton.addEventListener('click', (e) => {
            e.preventDefault();
            const pageButtonsValue = pageButton.getElementsByTagName('p')[0];
            selectedPage.value = pageButtonsValue.innerHTML;
            console.log(selectedPage.value)
            submitForm(e);
        });
    }
    const nextButton = pageButtons[pageButtonsLength - 1];
    nextButton.addEventListener('click', function (e) {
        e.preventDefault();
        const currentPage = parseInt(selectedPage.value);
        if (selectedPage.value < pageButtonsLength - 2) {
            selectedPage.value = currentPage + 1;
            console.log(selectedPage.value);
            submitForm(e);
        }
    });

});
 
searchBy.addEventListener('change', function (e) {
    selectedPage.value = "1"; // Set selectedPage.value to the desired value
    submitForm(e);
});

searchKey.addEventListener('input', function (e) {
    selectedPage.value = "1"; // Set selectedPage.value to the desired value
    submitForm(e);
});

sortAttribute.addEventListener('change', function (e) {
    selectedPage.value = "1"; // Set selectedPage.value to the desired value
    submitForm(e);
});

genreFilter.addEventListener('change', function (e) {
    selectedPage.value = "1"; // Set selectedPage.value to the desired value
    submitForm(e);
});

dateFilter.addEventListener('change', function (e) {
    selectedPage.value = "1"; // Set selectedPage.value to the desired value
    submitForm(e);
});

// selectedPage.addEventListener('change', submitForm);

sortOrderButton.addEventListener('click', function (e) {
    e.preventDefault();
    sortOrder.checked = !sortOrder.checked;
    submitForm(e);
});



document.addEventListener('DOMContentLoaded', showAllSongs);
/*
 *  This script makes an call request to the eBay finding API 
 *  It builds the URL from a random keyword and filter then adds a script to make the request
 *  An html element is then created to insert onto the wall
 */

// filter array with objects containing filters to match item type - additional objets (filters) can be added
const filter = [{
    "name": "ListingType",
    "value": ["AuctionWithBIN", "FixedPrice"],
    "paramName": "",
    "paramValue": ""
}];

// get random keyword to search for advert
const keyword = `&keywords=${  randomKeyword()}`;

// global url filter for buildURLArray function
let urlfilter = "";

// build url to make API request
let url = "http://svcs.ebay.com/services/search/FindingService/v1";
url += "?OPERATION-NAME=findItemsByKeywords";
url += "&SERVICE-VERSION=1.0.0";
url += "&SECURITY-APPNAME=SamRampl-dotchat-PRD-da5d7323e-01a24007";
url += "&GLOBAL-ID=EBAY-GB";
url += "&RESPONSE-DATA-FORMAT=JSON";
url += "&callback=_cb_findItemsByKeywords";
url += "&REST-PAYLOAD";
url += keyword;
url += "&paginationInput.entriesPerPage=1";

// create a script element to call API request on page load
const s = document.createElement('script');
s.src = url;
document.body.appendChild(s);

// select wall to insert advert when ready
const wall = document.querySelector(".wall");

// get a random keyword to search for in url query
function randomKeyword() {
    const keywords = [
        "macbook",
        "microsoft surface",
        "coffee cup",
        "javascript book",
        "4k monitor",
        "iphone",
        "canon dslr",
        "html book",
        "css book",
        "php book",
        "vue.js book",
        "MySQL book",
        "keyboard",
        "mouse",
        "wacom",
        "graphics tablet",
        "ux book",
        "after effects",
        "adobe illustrator",
        "adobe photoshop"
    ];

    // get random keyword from array by generating a rounded number based on number of items in array
    const selectedkeyword = keywords[Math.floor(Math.random() * keywords.length)];

    // make keyword url safe i.e. "coffee%20cup"
    return encodeURI(selectedkeyword);
}

// this function name matches the response from the API call
function _cb_findItemsByKeywords(root) {
    // console.log(root);
    const item = root.findItemsByKeywordsResponse[0].searchResult[0].item || [];
    let html = [];
    html.push('<div class="post h2 v2">');
    for (let idx = 0; idx < item.length; ++idx) {
        const itemimage = item[0].galleryURL;
        const viewitem = item[0].viewItemURL;
        if (viewitem !== null) {
            html.push(`<a href="${  viewitem  }" target="_blank"><img src="${  itemimage  }"><span class="advert">Advertisement <i class="fas fa-external-link-alt"></i></span></a>`);
        }
    }
    html.push('</div>');
    html = html.join('');
    wall.innerHTML += html;
}

function buildURLArray() {
    // iterate through filter array 
    for (let i = 0; i < filter; i++) {
        const itemfilter = filter[i];
        // iterate through current array item parameters
        for (const idx in itemfilter) {
            // check if parameter has a value
            if (itemfilter[idx] !== "") {
                if (itemfilter[idx] instanceof Array) {
                    for (let p = 0; p < itemfilter[idx].length; p++) {
                        const value = itemfilter[idx][p];
                        urlfilter += `&itemFilter\(${  i  }\).${  idx  }\(${  p  }\)=${  value}`;
                    }
                } else {
                    urlfilter += `&itemFilter\(${  i  }\).${  idx  }=${  itemfilter[idx]}`;
                }
            }
        }
    }
}

buildURLArray(filter);

url += urlfilter;
/* ******************************************** */
/* * PostMap.js handles:                      * */
/* * Collection of co-ordinates               * */
/* * Creating google map instance             * */
/* * Creating an array of google co-ordinates * */
/* * Create an heatmap overlay                * */
/* ******************************************** */

let data, map, heatmap; // define global scope variable for data set

$.ajax({
    type: 'get', // request type
    url: "GetMapDetails.php", // script which will return co-ordinates as json
    dataType: 'json',
    // success: function (res) {
    //     console.log(res);
    // }
}).done(function (result) { // when call was fulfilled
    data = result; // assign result object to data variable
}).done(function(){ // once data has been assigned value

    function initMap() {
        map = new google.maps.Map(document.querySelector('#map-canvas'), {
            zoom: 4,
            center: { lat: 51.888248, lng: -2.087832 },
            mapTypeId: 'satellite'
        });
    
        heatmap = new google.maps.visualization.HeatmapLayer({
            data: getPoints(data),
            map: map
        });

        heatmap.set('radius', 15);
    }
    
    function getPoints(set) {
    
        let dataPoints = [];
        let len = set.length;
    
        for(let idx = 0; idx < len; idx++){
            let currentData = new google.maps.LatLng(parseFloat(set[idx].lat), parseFloat(set[idx].lng));
            dataPoints.push(currentData);
        }
    
        return dataPoints;
      
    }
    
    initMap();

});










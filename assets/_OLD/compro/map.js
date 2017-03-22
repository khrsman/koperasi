// *
// * Add multiple markers
// * 2013 - en.marnoto.com
// *

// necessary variables
var map;
var infoWindow;

// markersData variable stores the information necessary to each marker
var markersData = [
   {  
      lat: -7.267896,
      lng: 112.758510,
      name: "Fakultas Kedokteran Universitas Airlangga",
      address1:"Bagian Bedah RSUD Dr. Soetomo, Jl. Mayjen Prof. Dr. Moestopo 6-8 Surabaya",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -0.943871,
      lng: 100.958510,
      name: "Fakultas Kedokteran Universitas Andalas",
      address1:"Bagian Bedah RSUP Dr. Djamil, Jl. Perintis Kemerdekaan Padang",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -7.972071,
      lng: 112.631657,
      name: "Fakultas Kedokteran Universitas Brawijaya",
      address1:"Bagian Bedah RSU Dr. Saiful Anwar, Jl. Jaksa Agung Suprapto No.2 Malang",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -6.994181,
      lng: 110.407851,
      name: "Fakultas Kedokteran Universitas Diponegoro",
      address1:"Bagian Bedah RSU Dr. Kariadi, Jl. Dr. Soetomo No.16 Semarang",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },


   {  
      lat: -7.767985,
      lng: 110.373640,
      name: "Fakultas Kedokteran Universitas Gadjah Mada",
      address1:"Bagian Bedah RS Dr. Wahidin Sudirohusodo, Jl. Perintis Kemerdekaan Km.11 Tamalanrea, Makassar",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -5.134892,
      lng: 119.494500,
      name: "Fakultas Kedokteran Universitas Hasanuddin Makassar",
      address1:"Gd. A Lt.4, Medical Staff. Dept Ilmu Bedah RSCM, Jl. Diponegoro 71 Jakarta",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -6.196786,
      lng: 106.846873,
      name: "Fakultas Kedokteran Universitas Indonesia",
      address1:"Bagian Bedah RSU Dr. Saiful Anwar, Jl. Jaksa Agung Suprapto No.2 Malang",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -6.896757,
      lng: 107.599169,
      name: "Fakultas Kedokteran Universitas Padjadjaran",
      address1:"Bagian Bedah RSUP Dr. Hasan Sadikin, Jl. Pasteur Bandung",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },





   {  
      lat: 1.453727,
      lng: 124.806505,
      name: "Fakultas Kedokteran Universitas Sam Ratulangi",
      address1:"Bagian Bedah RSU Malalayang, Jl. RSU Malalayang, Manado",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -7.559025,
      lng: 110.842228,
      name: "Fakultas Kedokteran Universitas Sebelas Maret",
      address1:"Bagian Bedah RSUD Dr.Moewardi, Jl. Kol. Sutarto No. 132 Surakarta",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: -2.966614,
      lng: 104.748706,
      name: "Fakultas Kedokteran Universitas Sriwijaya",
      address1:"Bagian Bedah RSUP Dr. Moh. Hoesin, Jl. Jend. Sudirman Km. 3,5 Palembang",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
    {  
      lat: 3.518156,
      lng: 98.608620,
      name: "Fakultas Kedokteran Universitas Sumatera Utara",
      address1:"Bagian Bedah RSUP H. Adam Malik, Jl. Bunga Lau No.17 Medan",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   },
     {  
      lat: -8.675840,
      lng: 115.213027,
      name: "Fakultas Kedokteran Universitas Udayana",
      address1:"Bagian Bedah FK UNUD/RS Sanglah, Jl. Kesehatan No.1, Denpasar",
      address2: "",
      postalCode: "" // don't insert comma in the last item of each marker
   }

];


function initialize() {
   var centerMap = new google.maps.LatLng(-2.910511,116.543692);
 
   var myOptions = {
      zoom: 1 ,
      center: centerMap,
   }


   // var mapOptions = {
   //    center: new google.maps.LatLng(-2.910511,116.543692),
   //    zoom: 1,
   // };

   map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);

   // a new Info Window is created
   infoWindow = new google.maps.InfoWindow();

   // Event that closes the Info Window with a click on the map
   google.maps.event.addListener(map, 'click', function() {
      infoWindow.close();
   });

   // Finally displayMarkers() function is called to begin the markers creation
   displayMarkers();
}
google.maps.event.addDomListener(window, 'load', initialize);


// This function will iterate over markersData array
// creating markers with createMarker function
function displayMarkers(){

   // this variable sets the map bounds according to markers position
   var bounds = new google.maps.LatLngBounds();
   
   // for loop traverses markersData array calling createMarker function for each marker 
   for (var i = 0; i < markersData.length; i++){

      var latlng = new google.maps.LatLng(markersData[i].lat, markersData[i].lng);
      var name = markersData[i].name;
      var address1 = markersData[i].address1;
      var address2 = markersData[i].address2;
      var postalCode = markersData[i].postalCode;

      createMarker(latlng, name, address1, address2, postalCode);

      // marker position is added to bounds variable
      bounds.extend(latlng);  
   }

   // Finally the bounds variable is used to set the map bounds
   // with fitBounds() function
   map.fitBounds(bounds);
}

// This function creates each marker and it sets their Info Window content
function createMarker(latlng, name, address1, address2, postalCode){
   var marker = new google.maps.Marker({
      map: map,
      position: latlng,
      title: name
   });

   // This event expects a click on a marker
   // When this event is fired the Info Window content is created
   // and the Info Window is opened.
   google.maps.event.addListener(marker, 'click', function() {
      
      // Creating the content to be inserted in the infowindow
      var iwContent = '<div id="iw_container">' +
            '<div class="iw_title">' + name + '</div>' +
         '<div class="iw_content">' + address1 + '</div></div>';
      
      // including content to the Info Window.
      infoWindow.setContent(iwContent);

      // opening the Info Window in the current map and at the current marker location.
      infoWindow.open(map, marker);
   });
}
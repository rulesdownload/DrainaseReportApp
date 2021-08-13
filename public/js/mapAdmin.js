   function initialize() {


    var latlng = new google.maps.LatLng(1.474830, 124.842079);
    var crosshairShape = {
        coords: [0, 0, 0, 0],
        type: 'rect'
      };
  var mapCanvas = document.getElementById('map');
  var mapOptions = {
    center: latlng,
    zoom: 13,
    scrollwheel: false,
    panControl: false,
    zoomControl: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  }
  var map = new google.maps.Map(mapCanvas, mapOptions);

  var marker = new google.maps.Marker({
    map: map,
    position: latlng,
  });


}

  google.maps.event.addDomListener(window, "load", initialize);
      
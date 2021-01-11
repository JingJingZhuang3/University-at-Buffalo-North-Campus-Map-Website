var glat;
var glon;

function getLocation() {
  if (navigator.geolocation) {
    var options ={timeout:15000};
    navigator.geolocation.getCurrentPosition(showPosition,error,options);
  }
  else {
    alert("Browser is not supported.");
  }
}

function error(error){
  alert("error");
}


function showPosition(position) {
  glat=position.coords.latitude;
  glon=position.coords.longitude;
  L.marker([glat,glon]).addTo(map);
  map.setView([glat, glon], 16);
}

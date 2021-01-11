
  function time(dist){
    //walking time 4828.03m/hr
    Math.ceil((dist * 60)/4828.03); //in min
  }

  function distance(lat1,lon1,lat2,lon2) {
    var R = 6371; // km (change this constant to get miles)
    var dLat = (lat2-lat1) * Math.PI / 180;
    var dLon = (lon2-lon1) * Math.PI / 180;
    var a = Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(lat1 * Math.PI / 180 ) * Math.cos(lat2 * Math.PI / 180 ) *
      Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
    var d = R * c;
    if (d>1) return Math.round(d); 		//+"km." + " Estimate time: " + time + "min";
    if (d<=1) return Math.round(d*1000);		//+"m." + " Estimate time: " + time + "min";
    return d;
  }

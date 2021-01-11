<!DOCTYPE html>
<html lang="en">
<head>
<title>UB North Campus Map Navigation</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<style>
body {
  margin: 0;
  height:100%;
  background-color: #D2E2F8;
}
iframe{
  float:left;
  width: 100%;
  top: 100px;
  height: 100%;
  position: fixed;
}

.header {
  background-color: #176BE2;
  padding: 8px;
  text-align: center;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  right: 0;
}
ul {
  position: fixed;
  right: 0;
  top:100px;
  list-style-type: none;
  margin-top: 50px;
  padding: 0;
  min-width: 10%;
  background-color: transparent;
  overflow: auto;
  text-align: center;
}
top {
  transform:translate(0px,95px);
  list-style-type: none;
  overflow: show;
  background-color: #173660;
  position: fixed;
  width: 100%;
  z-index: 1;
}
li {
  float: right;
  border-left:1px solid #bbb;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

.topnav .search-container input {
  padding: 10px 10px;
  margin-top: 3px;
  font-size: 17px;
  border: inset;
  opacity:0.9;
  display: block;
  margin-right: 3px;
}

.topnav .search-container button {
  padding: 10px 20px;
  margin-top: 3px;
  background: #176BE2;
  font-size: 17px;
  border: outset;
  cursor: pointer;
  opacity:0.9;
}

.topnav .search-container button:hover {
  background: #ccc;
}

#mapid {
  /*display: flex;*/
  width: 100%;
  top: 90px;
  height: 100%;
  position: fixed;
  transform:translate(0px,45px);

}
</style>
</head>
<body>
<div class="header">
  <h1 style="color: White;">UB North Campus Map</h1>
</div>
<top>
  <li><a class="active" href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/Contact">Contact Us</a></li>
  <li><a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/About_Us">About Us</a></li>
</top>
<div id="mapid"></div>
<ul>
<div class="topnav">
<div class="search-container">
    <form method ="POST" action="">
	  <input type="text" id = "from" list="buildings" placeholder="Starting Location" name="start">
	  <input type="text" id = "to" list="buildings" placeholder="Destination" name="dest">
	  	  <datalist id="buildings">
			<option value="Alfiero Center">
			<option value="Alumni Arena">
			<option value="Baird Hall">
			<option value="Baldy Hall">
			<option value="Bell Hall">
		    <option value="Bissell Hall">
			<option value="Bonner Hall">
		    <option value="Bookstore">
		    <option value="Capen Hall">
			<option value="Center for the Arts">
			<option value="Center for Tomorrow">
			<option value="Child Care Center">
			<option value="Clemens Hall">
			<option value="Commons">
			<option value="Cooke Hall">
			<option value="Davis Hall">
			<option value="Fronczak Hall">
			<option value="Hochstetter Hall">
			<option value="Jacobs Management Center">
			<option value="Jarvis Hall">
			<option value="Ketter Hall">
			<option value="Knox Lecture Hall">
			<option value="Lockwood Library">
			<option value="Mathematics Building">
			<option value="Natural Sciences Complex">
			<option value="Norton Hall">
			<option value="O’Brian Hall">
			<option value="Park Hall">
			<option value="Slee Hall">
			<option value="Student Union">
			<option value="Talbert Hall">
	    </datalist>
       <input type="submit" name="search" style="color: white;background:#176BE2;" value="Go!">
    </form>
	<?php
	$conn= mysqli_connect("tethys.cse.buffalo.edu:3306","yingyinl","50239602");
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else{
	$message="Database connected successfully";
    ?>
			<script>
				var str="<?php echo $message?>";
				alert(str);
			</script>
	<?php
}
	$db=mysqli_select_db($conn,"yingyinl_db");

	if(isset($_POST['search'])){
		$name =$_POST['start'];
		$name2 =$_POST['dest'];
		$query="SELECT * FROM locations where name='$name'";
		$query_run=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($query_run)){
			?>
			<script id="s" startname= "<?php echo $row['name']?>" startlon="<?php echo $row['lon']?>" startlat="<?php echo $row['lat']?>">
				//var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
				//alert(str);
			</script>
			<?php
		}
	$query2="SELECT * FROM locations where name='$name2'";
		$query_run2=mysqli_query($conn,$query2);
		while($row=mysqli_fetch_array($query_run2)){
			?>
			<script id="d" destname="<?php echo $row['name']?>" destlon="<?php echo $row['lon']?>" destlat="<?php echo $row['lat']?>">
				//var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
				//alert(str);
			</script>
			<?php
		}
	}
	?>

  </div>
  </div>
  <button onclick="getLocation()">GPS</button>

  <script>
  var map=L.map('mapid').setView([42.9997, -78.7857], 16);
    L.tileLayer( 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c'],
    }).addTo( map );

	var clat = document.getElementById("s").getAttribute("startlat");
	var clon = document.getElementById("s").getAttribute("startlon");
	var cname= document.getElementById("s").getAttribute("startname");
	var dlat = document.getElementById("d").getAttribute("destlat");
	var dlon = document.getElementById("d").getAttribute("destlon");
	var dname= document.getElementById("d").getAttribute("destname");

  	if (cname&&dname){
  		// L.marker([clat,clon]).addTo(map).bindPopup("Current Location").openPopup();
  		// L.marker([dlat,dlon]).addTo(map).bindPopup(dname).openPopup();
      getRoute(clat,clon,cname,dlat,dlon,dname);

  	var test_dname = dname+": ("+dlat+","+dlon+")";
  	var test_cname = "Starting Location"+": ("+clat+","+clon+")";

  		L.marker([clat,clon]).addTo(map).bindPopup(test_cname).openPopup();
  		L.marker([dlat,dlon]).addTo(map).bindPopup(test_dname).openPopup();
	}



  function getRoute(clat, clon, cname, dlat, dlon, dname){
    if(cname == "Baldy Hall" && dname == "Student Union"){
      var geojson = {
      "type": "FeatureCollection",
      "features": [
        {
          "type": "Feature",
          "properties": {},
          "geometry": {
            "type": "LineString",
            "coordinates": [
              [-78.7869,43.00044],
              [-78.78590,43.00044],
              [-78.78573,43.00060],
              [-78.78620,43.00090],
              [-78.78628,43.00117]
            ]
          }
        },
      ]
      };
      var myStyle = {
        "color": "#ff7800",
        "weight": 5,
        //"opacity": 0.65
      };
      L.geoJSON(geojson,{
        style:myStyle
      }).addTo(map);
    }
  }


  /********For GPS*********/
  var glat;
  var glon;

  function getLocation() {
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
    }
    else {
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

  function showPosition(position) {
    glat=position.coords.latitude;
    glon=position.coords.longitude;
    L.marker([glat,glon]).addTo(map);
    map.setView([glat, glon], 16);
  }



</script>
</ul>
</body>
</html>

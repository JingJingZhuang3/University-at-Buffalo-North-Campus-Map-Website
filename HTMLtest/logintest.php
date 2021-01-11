<!DOCTYPE html>
<html lang="en">
<head>
<title>UB North Campus Navigation</title>
<meta name="description" content="UB North Campus Navigation for shortest, outdoor, and tunnel routes">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
<script src="js/dist.js"></script>
<script src="js/shortest.js"></script>
<script src="js/algo.js"></script>
<script src="js/outdoor.js"></script>
<script src="js/tunnel.js"></script>
<script src="js/GPS.js"></script>
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
.selectbar{
	display: inline-block;
	margin:3px 3px 3px 3px;
	postion:relative;
}
.selectbar div{
	display: inline-block;
	line-height:30px;
	color: #173660;
	font-size: 13px;
	font-weight: bold;
}
.selectbar select{
	padding: 5px 5px;
	font-size: 13px;
	opacity:0.8;
}
.callout {
  position: fixed;
  bottom: 20px;
  left: 10px;
  margin-left: 10px;
  max-width: 300px;
  opacity:0.8;
}

.callout-header {
  padding: 10px 15px;
  padding-right:30px;
  background: #47626b;
  font-size: 15px;
  color: white;
}

.callout-container {
  padding: 13px;
  background-color: #b3c6cc;
  font-size: 13px;
  text-align: left;
  color: #141c1f;
}

.closebtn {
  position: absolute;
  top: 5px;
  right: 10px;
  color: white;
  font-size: 20px;
  cursor: pointer;
}

.closebtn:hover {
  color: red;
}
</style>
</head>
<body>

<div class="header">
  <h1 style="color: White;">UB North Campus Navigation</h1>
</div>
<top>
  <li><a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/HTMLtest/Signup.html">Sign Up</a></li>
  <li><a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/HTMLtest/loginpage.php">Log In</a></li>
  <li><a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/Contact">Contact Us</a></li>
  <li><a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-spring/cse-442t/About_Us">About Us</a></li>
</top>
<div id="mapid"></div>
<ul>
<div class="topnav">
<div class="search-container">
    <form method ="POST" action="">
	  <input type="text" id = "from" list="buildings" placeholder="Starting Location" name="start">
	  <input type="text" id = "to" list="buildings" placeholder="Destination" name="dest">
	  <div class="selectbar">
		<div>Route Option:</div>
    <select id="options" >
      <option value="shortest">Shortest Route</option>
      <option value="outdoor">Outdoor Route</option>
      <option value="tunnel">Tunnel Route</option>
    </select>
	  </div>
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
			<option value="OBrian Hall">
			<option value="Park Hall">
			<option value="Slee Hall">
			<option value="Student Union">
			<option value="Talbert Hall">
	    </datalist>
       <input type="submit" name="search" style="color: white; background:#176BE2;" value="Go!" onclick="changeFunc();">
    </form>

  </div>
  </div>
  <button onclick="getLocation()">GPS</button>

  </ul>

  <div class="callout">
    <div class="callout-header"><b>Route Info</b></div>
  	<span class="closebtn" onclick="this.parentElement.style.display='none';"><b>×</b></span>
  	<div class="callout-container" id="callout">
    </div>
  </div>

<form id="form" method ="POST" action="">
      <input type="hidden" id="array" name="array" value="">
	  <input type="hidden" id="Str" name="Str" value="shortest">
     </form>

 <script type="text/javascript">
  //changeFunc();
  var map=L.map('mapid').setView([42.9997, -78.7857], 16);
    L.tileLayer( 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        subdomains: ['a','b','c'],
        maxZoom:19
    }).addTo( map );

  function route(){
    let array=[];
    var start= document.getElementById("s").getAttribute("startname");
    var end= document.getElementById("d").getAttribute("destname");
	var option=localStorage.getItem("OP");
	let element2=document.getElementById("Str");
	element2.setAttribute("value",option);
	var bool=true;
    if(option=="tunnel") array= BFS(tunnelDict,start,end);
    else if(option=="shortest") array= BFS(shortestDict,start,end);
    else array= BFS(outdoorDict,start,end);
    if (array.length!=0){
	  let array1= addTo(array);
      let jsondata = JSON.stringify(array1);
      let element=document.getElementById("array");
      element.setAttribute("value",jsondata);
    }else if (start==end){
      alert("Start location and destination are the same!");
	  bool=false;
    }else {
		noRoute();
		bool=false;
	}
	return bool;
  }

  function noRoute(){
    var str="No route existing between the two locations. Please reenter locations.";
    alert(str);
  }


  function getRoute(clat, clon, dlat, dlon){

      var geojson = {
      "type": "FeatureCollection",
      "features": [
        {
          "type": "Feature",
          "properties": {},
          "geometry": {
            "type": "LineString",
            "coordinates": [[parseFloat(clon),parseFloat(clat)],[parseFloat(dlon),parseFloat(dlat)]
              // [-78.7869,43.00044],
              // [-78.78590,43.00044],
              // [-78.78573,43.00060],
              // [-78.78620,43.00090],
              // [-78.78628,43.00117]
            ]
          }
        },
      ]
      }
	  var myStyle = {
        "color": "#ff7800",
        "weight": 5,
        //"opacity": 0.65
      };
      L.geoJSON(geojson,{
        style:myStyle
      }).addTo(map);

  };

   function changeFunc(){
      var box = document.getElementById("options");
      var value=box.options[box.selectedIndex].value;
	  //alert(value);
      //if(value=="outdoor") setOutdoor();
      //if(value=="tunnel") setTunnel();
      //if(value=="shortest") setShortest();
      //let element=document.getElementById("Str");
      localStorage.setItem("OP", value);
	  localStorage.setItem("startname",document.getElementById("from").value );
	  localStorage.setItem("destname",document.getElementById("to").value );
    }
function addTo(arr){
    let ret=[];
    if(typeof(arr[0])==='object'){
      for(var i of arr){
        ret.push(help(i));
      }
    }else{
      return help(arr);
    }
    return ret;
  }

  function help(arr){
    let ret=[];
    let temp=arr[0];
    for(var i=1; i<arr.length;i++){
      let s=temp+" to "+arr[i];
      ret.push(s);
      temp=arr[i];
    }
    return ret;
  }
</script>

<?php
$conn= mysqli_connect("tethys.cse.buffalo.edu:3306","yingyinl","50239602");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} else{
$message="Database connected successfully";
}
$db=mysqli_select_db($conn,"yingyinl_db");
$option1=$_POST['options'];
if(isset($_POST['search'])){
  $name =$_POST['start'];
  $name2 =$_POST['dest'];
  $v1=true;
  $v2=true;
  if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name)||preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name2))
  {
    ?>
  <script>
    var str="Not valid string inputs. Please reenter."
      alert(str);
  </script>
  <?php
  }
  $query="SELECT * FROM locations where name='$name'";
  $query_run=mysqli_query($conn,$query);

  if(mysqli_num_rows($query_run) <1){
    $v1=false;
  }
  while($row=mysqli_fetch_array($query_run)){
    ?>
    <script id="s" startname= "<?php echo $row['name']?>" startlon="<?php echo $row['lon']?>" startlat="<?php echo $row['lat']?>">
      //var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
      //alert(str);
		 localStorage.setItem("startlat", <?php echo $row['lat']?>);
		 localStorage.setItem("startlon", <?php echo $row['lon']?>);
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
		 localStorage.setItem("destlat", <?php echo $row['lat']?>);
		 localStorage.setItem("destlon", <?php echo $row['lon']?>);
    </script>
    <?php
  }
   if(mysqli_num_rows($query_run2) <1){
    $v2=false;
  }
  ?>
  <script>
    var v1="<?php echo $v1 ?>";
    var v2="<?php echo $v2 ?>";
    if(v1==false || v2==false){
      noRoute();
    }else{
		if(route()){
	  document.getElementById("form").submit();
		}
    }
  </script>
  <?php
}
$db2=mysqli_select_db($conn,"cse442_542_2020_spring_teamt_db");
if(isset($_POST['array'])){
		$start="";
		$dest="";
		$json=$_POST['array'];

		$arr=json_decode($json);
		$firstKey = $arr[0];
		$lastKey= end($arr[0]);
		$key1=$firstKey[0];
		$query10="SELECT * FROM shortest where name='$key1'";
		$query_run10=mysqli_query($conn,$query10);
		while($row=mysqli_fetch_array($query_run10)){
			$start=$row['p1'];

		}
		$query11="SELECT * FROM shortest where name='$lastKey'";
		$query_run11=mysqli_query($conn,$query11);
		while($row=mysqli_fetch_array($query_run11)){
			$w=$row['nPoints'];
			$dest=$row['p'.$w];

		}
		$db3=mysqli_select_db($conn,"yingyinl_db");
		 $query12="SELECT * FROM locations where name='$start'";
		$query_run12=mysqli_query($conn,$query12);
		  while($row=mysqli_fetch_array($query_run12)){
    ?>
    <script id="s" startname= "<?php echo $row['name']?>" startlon="<?php echo $row['lon']?>" startlat="<?php echo $row['lat']?>">
      //var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
      //alert(str);
		localStorage.setItem("startlat", <?php echo $row['lat']?>);
		 localStorage.setItem("startlon", <?php echo $row['lon']?>);
    </script>
    <?php
  }
  $query13="SELECT * FROM locations where name='$dest'";
  $query_run13=mysqli_query($conn,$query13);
  while($row=mysqli_fetch_array($query_run13)){
    ?>
    <script id="d" destname="<?php echo $row['name']?>" destlon="<?php echo $row['lon']?>" destlat="<?php echo $row['lat']?>">
      //var str="<?php echo $row['name']?>"+": "+"<?php echo $row['lon']?>"+", "+"<?php echo $row['lat']?>";
      //alert(str);
	  	localStorage.setItem("destlat", <?php echo $row['lat']?>);
		 localStorage.setItem("destlon", <?php echo $row['lon']?>);
    </script>
    <?php
}
}
$db2=mysqli_select_db($conn,"cse442_542_2020_spring_teamt_db");
if(isset($_POST['array'])){
	$option =$_POST['Str'];
	$json=$_POST['array'];
	$points2=[];
    $arr=json_decode($json);
	$data2=[];
	if(strcmp($option, "shortest") === 0){
		foreach($arr as $key => $value){
		 $data=[];
		 foreach($arr[$key] as $element){
			$query3="SELECT * FROM shortest where name='$element'";
			$query_run3=mysqli_query($conn,$query3);
			while($row=mysqli_fetch_array($query_run3)){
				for($x=1;$x<$row['nPoints'];$x++){
					array_push($data,$row['p'.$x]);
				}
			}
		}
		array_push($data2,$data);
		}
		foreach($data2 as $key => $value){
			$points=[];
			foreach($data2[$key] as $element){
		$query4="SELECT * FROM points where name='$element'";

		$query_run4=mysqli_query($conn,$query4);
		while($row=mysqli_fetch_array($query_run4)){
					$array=[$row['lat'],$row['lon'],$row['ins']];
					array_push($points,$array);
				}
			}
			array_push($points2,$points);
		}
	}else if(strcmp($option, "tunnel") === 0){
		foreach($arr as $key => $value){
		 $data=[];
		 foreach($arr[$key] as $element){
			$query3="SELECT * FROM tunnel where name='$element'";
			$query_run3=mysqli_query($conn,$query3);
			while($row=mysqli_fetch_array($query_run3)){
				for($x=1;$x<$row['nPoints'];$x++){
					array_push($data,$row['p'.$x]);
				}
			}
		}
		array_push($data2,$data);
		}
		foreach($data2 as $key => $value){
			$points=[];
			foreach($data2[$key] as $element){
		$query4="SELECT * FROM tunnel_points where name='$element'";

		$query_run4=mysqli_query($conn,$query4);
		while($row=mysqli_fetch_array($query_run4)){
					$array=[$row['lat'],$row['lon'],$row['ins']];
					array_push($points,$array);
				}
			}
			array_push($points2,$points);
		}
	}else if(strcmp($option, "outdoor") === 0){
		foreach($arr as $key => $value){
		 $data=[];
		 foreach($arr[$key] as $element){
			$query3="SELECT * FROM outdoor where name='$element'";
			$query_run3=mysqli_query($conn,$query3);
			while($row=mysqli_fetch_array($query_run3)){
				for($x=1;$x<=$row['nPoints'];$x++){
					array_push($data,$row['p'.$x]);
				}
			}
		}
		array_push($data2,$data);
		}
		foreach($data2 as $key => $value){
			$points=[];
			foreach($data2[$key] as $element){
		$query4="SELECT * FROM Outdoor_points where name='$element'";

		$query_run4=mysqli_query($conn,$query4);
		while($row=mysqli_fetch_array($query_run4)){
					$array=[$row['lat'],$row['lon'],$row['ins']];
					array_push($points,$array);
				}
			}
			array_push($points2,$points);

		}
	}
	  ?>
  <script>
   let option1=localStorage.getItem("OP");
   var str1;
   str1=<?php echo json_encode($points2); ?>;
  let minD=Number.MAX_VALUE;
  let minI=-1;
  let index1=0;
  for(var x of str1){
    let arr=[];
    let dis=0;
    let lat3=x[0][0];
    let lon3=x[0][1];
    for(var y=1; y<x.length;y++){
      let lat4=x[y][0];
      let lon4=x[y][1];
      dis+=distance(lat3,lon3,lat4,lon4);
      lat3=lat4;
      lon3=lon4;
    }
    if(dis<minD) {
      minD=dis;
      minI=index1;
    }
    index1+=1;
  }
  let minArray=str1[minI];
  let minArraySize=minArray.length;
  let startlat;
  let startlon;
  if(option1=="outdoor"){
  startlat=minArray[0][0];
  startlon=minArray[0][1];
  }else{
  startlat=localStorage.getItem("startlat");
  startlon=localStorage.getItem("startlon");
  }
  dis=0;
  //L.marker(startlat,startlon).addTo(map).bindPopup(document.getElementById("s").getAttribute("startname")).openPopup();
  for(var x of minArray){
    if(x[2]!="" || x[2]!=""){
      L.marker([x[0],x[1]]).addTo(map).bindPopup(x[2]).openPopup();
    }
    getRoute(startlat,startlon,x[0],x[1]);
    dis+=distance(startlat,startlon,x[0],x[1]);
    startlat=x[0];
    startlon=x[1];
  }
  //L.marker(document.getElementById("d").getAttribute("destlat"),document.getElementById("d").getAttribute("destlon")).addTo(map).bindPopup(document.getElementById("d").getAttribute("destname")).openPopup();
  if(option1=="outdoor"){
	  getRoute(startlat,startlon,minArray[minArraySize-1][0],minArray[minArraySize-1][1]);
	  dis+=distance(startlat,startlon,minArray[minArraySize-1][0],minArray[minArraySize-1][1]);
  }
  else{
  getRoute(startlat,startlon,localStorage.getItem("destlat"),localStorage.getItem("destlon"));
  dis+=distance(startlat,startlon,localStorage.getItem("destlat"),localStorage.getItem("destlon"));
  }
  var sname=localStorage.getItem("startname");
  var dname=localStorage.getItem("destname");
  var time1 = Math.ceil((dis * 60)/4828.03);
  var info1 = "<b>"+sname+" to "+dname+":</b><br>";
  var info = "Distance: " + dis + "m <br>Estimate walking time: " + time1 + "min";
  var info2="";
  var info3="";
  var current_t = new Date();
  var c_h=current_t.getHours();
  var c_m=checkTime(current_t.getMinutes());
  var h =current_t.getHours();
  var m =current_t.getMinutes()+time1;
  if(checkMin(m)==true){
  	m=m-60;
    if((h+1)>=24){h="0"+(h+1-24);}else {h=h+1;}
  }
  m = checkTime(m);
  info2="<br>Estimate arrival time: "+h + ":" + m ;
function checkMin(i){
	if (i>=60){return true;}
    return false;
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};
  return i;
}
  info3="<br>Current time: "+c_h + ":" +c_m ;
  document.getElementById("callout").innerHTML=info1;
  document.getElementById("callout").innerHTML+=info;
  document.getElementById("callout").innerHTML+=info3;
  document.getElementById("callout").innerHTML+=info2;
 </script>
  <?php
}
?>

<script>
if(document.getElementById("s")!=null){
  var clat = localStorage.getItem("startlat");
  var clon = localStorage.getItem("startlon");
  var cname= localStorage.getItem("startname");
  var dlat = localStorage.getItem("destlat");
  var dlon = localStorage.getItem("destlon");
  var dname= localStorage.getItem("destname");
  if(cname&&dname){
   // getRoute(clat,clon,cname,dlat,dlon,dname);

    var test_dname = dname+": ("+dlat+","+dlon+")";
    var test_cname = "Starting Location"+": ("+clat+","+clon+")";

    L.marker([clat,clon]).addTo(map).bindPopup(test_cname).openPopup();
    L.marker([dlat,dlon]).addTo(map).bindPopup(test_dname).openPopup();
  }
}

</script>

</body>

</html>

<?php
	// check duration time (for testing it is 10 seconds)
	session_start();
	include("duration.php");
	if(isset($_SESSION['did'])){
		if(checkLoginExpired()) {
			header("Location: logout.php?session_expired=1");
		}
	}
	 $message="";
     if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['subject']) && (isset($_POST['building']) || (isset($_POST['latname']) && isset($_POST['lonname'])) )){
       $first=$_POST['firstname'];
       $last=$_POST['lastname'];
	   $build = "Not in list";
	   $lat = 0;
	   $lon = 0;
	   if ($_POST['building'] != ""){
		   $build = $_POST['building'];
	   }
	   if (isset($_POST['latname']) && isset($_POST['lonname'])){
		   $lat = $_POST['latname'];
		   $lon = $_POST['lonname'];
	   }
       $des=$_POST['subject']; //description
	   $verify = 0;
       $mysqli = new mysqli("tethys.cse.buffalo.edu:3306", "yingyinl", "50239602", "cse442_542_2020_spring_teamt_db");
       if ($conn->connect_error) {
         exit("Failed to connect to the database.");
       }
       //if(true){
         $stmt1 = $mysqli->prepare("INSERT INTO construction(First_name, Last_name, location, lat, lon, message, verify) VALUES(?,?,?,?,?,?,?)");
         $stmt1->bind_param("sssddsd", $first, $last, $build, $lat, $lon, $des, $verify);
         $stmt1->execute();
         $stmt1->close();
         $message="Your report has been submitted to the Administrator.";
       //} else{$message= "Something is wrong";}
	   //echo "<script>alert('$message');</script>";
	   //header("Location: account.php");
     }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>Construction Form</title>
	<style>
	html{
		background-image: url("../pic/ub.jpg");
		width:100%;
        height:100%;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
		position:relative;
	}
		* {
		  box-sizing: border-box;
		}

		input[type=text], input[type=number], select, textarea {
		  width: 100%;
		  padding: 12px;
		  border: 1px solid #ccc;
		  border-radius: 4px;
		  resize: vertical;
		}

		label {
		  padding: 12px 12px 12px 0;
		  display: inline-block;
		}

		input[type=submit] {
		  background-color: #4CAF50;
		  color: white;
		  padding: 12px 20px;
		  border: none;
		  border-radius: 4px;
		  cursor: pointer;
		  float: center;
		}

		input[type=submit]:hover {
		  background-color: #45a049;
		}

		.container {
			position:absolute;
			text-align: center;
			align-items: center;
			vertical-align: middle;
			width: 50%;
			height: 95%;
			transform: translate(-50%,-50%);
			top: 50%;
			left:50%;
			opacity:0.8;
			border-radius: 5px;
			background-color: #f2f2f2;
			padding: 15px;
		}

		.col-25 {
		  float: left;
		  width: 30%;
		  margin-top: 3px;
		}

		.col-75 {
		  float: left;
		  width: 70%;
		  margin-top: 3px;
		}
		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}
		.message {
			color: #333;
			border: #22dd22 1px solid;
			background: #d3f8d3;
			padding: 5px 20px;
		}
		@media screen and (max-width: 600px) {
		  .col-25, .col-75, input[type=submit] {
			width: 100%;
			margin-top: 0;
		  }
		}

	</style>
  </head>
  <body>
<?php
session_start();
if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['subject']) && (isset($_POST['building']) || (isset($_POST['latname']) && isset($_POST['lonname'])) )){
	?>
<div class="container" style = "height: 55%">
	<h1>UB North Campus Navigation</h1>
	<?php if($message!="") { ?>
			<div class="message"> <h2>Thank You for Your Submission!</h2> <?php echo $message; ?> </div>
	<?php } ?>
	<br/>
	Click here to <a href="http://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/report_form.php">Submit Another Report.<a/><br/><br/>
	Click here to <a href="http://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account.php">Back to Your Account.<a/><br/><br/>
	Click here to <a href="http://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/">Back to Map.<a/><br/><br/>
</div>
<?php
} else if(isset($_SESSION['did'])){
	?>
<div class="container">
<?php if($message!="") { ?>
		<div class="message"> <?php echo $message; ?> </div>
<?php } ?>
<h2>Construction Report Form</h2>
  <form method = "POST" action="report_form.php">
  <div class="row">
    <div class="col-25">
      <label for="fname">First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="firstname" placeholder="Enter Your First Name.." required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="lastname" placeholder="Enter Your Last Name.." required>
    </div>
  </div>
  <div class="row" id="buildrow">
    <div class="col-25">
      <label for="buildings">Building Name</label>
    </div>
    <div class="col-75">
		<input type="text" id = "build" list="buildings" placeholder="Choose the Building to Report..." name="building" required>
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
    </div>
  </div>
  Location Not in List <input type="checkbox" id="check" onclick="loc()">
  <div class="row" id="latrow" style="display:none">
	<div class="col-25">
      <label for="subject">Latitude</label>
    </div>
    <div class="col-75">
      <input type="number" step="any" id="lat" name="latname" placeholder="Enter Latitude...">
    </div>
  </div>
  <div class="row" id="lonrow" style="display:none">
    <div class="col-25">
      <label for="subject">Longitude</label>
    </div>
    <div class="col-75">
      <input type="number" step="any" id="lon" name="lonname" placeholder="Enter Longitude...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="subject">Description</label>
    </div>
    <div class="col-75">
      <textarea id="subject" name="subject" placeholder="Write your description.." style="height:150px" required></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
  Click here to <a href="http://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account.php">Back to Your Account.<a/><br/>
  Click here to <a href="http://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/">Back to Map.<a/><br/><br/>
</div>
<script>
	function loc(){
		var checkBox = document.getElementById("check");
		var lat = document.getElementById("latrow");
		var lon = document.getElementById("lonrow");
		var latbox = document.getElementById("lat");
		var lonbox = document.getElementById("lon");
		var loca = document.getElementById("build");
		var build = document.getElementById("buildrow");
		if (checkBox.checked == true){
			lat.style.display = "block";
			lon.style.display = "block";
			build.style.display="none";
			loca.removeAttribute("required");
			latbox.setAttribute("required", "");
			lonbox.setAttribute("required", "");
		} else{
			lat.style.display = "none";
			lon.style.display = "none";
			build.style.display="block";
			latbox.removeAttribute("required");
			lonbox.removeAttribute("required");
			loca.setAttribute("required", "");
		}
	}
</script>
</body>
</html>
<?php

} else {
	header("Location: login.php");
}
?>

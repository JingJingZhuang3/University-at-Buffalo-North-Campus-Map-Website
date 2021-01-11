<?php
	// check duration time (for testing it is 10 seconds)
	session_start();
	include("duration.php");
	if(isset($_SESSION['did'])){
		if($_SESSION['did']!='admin'){
			echo "<script>alert('You\'re not authorized!');
	    window.location.href='https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/login.php';
	    </script>";
		}

		if(checkLoginExpired()) {
			header("Location: logout.php?session_expired=1");
		}
	}else{
    echo "<script>alert('You\'re not logged-in!');
    window.location.href='https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/login.php';
    </script>";
  }
?>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>My Inbox</title>
</head>
<body>
	<?php
	session_start();
		echo "<div class='header'>";
		echo "<h1 style='color: White;'>UB North Campus Navigation</h1>";
		echo "</div>";
		echo "<div class='top' id='top'>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/".">Home</a>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/logout.php".">Logout</a>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account_setting_page.php".">Settings</a>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account.php".">Welcome, ".$_SESSION['did']."!</a>";
		echo '<a href="javascript:void(0);" class="icon" onclick="nav()"><i class="fa fa-bars"></i></a>';
		echo "</div>";

		echo "<form  method=\"post\">";
		echo '<div class="box">';
		echo "<table>
					<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Location</th>
					<th>Latitude</th>
					<th>Longitude</th>
					<th class=\"cell\">Description</th>
					<th>Verified</th>
					<th></th>
					</tr>";
		$mysqli = new mysqli("tethys.cse.buffalo.edu:3306", "yingyinl", "50239602", "cse442_542_2020_spring_teamt_db");
		if ($conn->connect_error) {
	    exit("Something is wrong. Please try again");
	  }
		$sql = "SELECT * FROM construction";
		$result = $mysqli->query($sql);
		if($result->num_rows >0){
			while($row = $result->fetch_assoc()) {
				echo '<tr>';
				echo '<td>'.htmlspecialchars($row['First_name']).'</td>';
				echo '<td>'.htmlspecialchars($row['Last_name']).'</td>';
				echo '<td>'.htmlspecialchars($row['location']).'</td>';
				echo '<td>'.htmlspecialchars($row['lat']).'</td>';
				echo '<td>'.htmlspecialchars($row['lon']).'</td>';
				echo '<td>'.htmlspecialchars($row['message']).'</td>';
				if($row['verify']==1){
					echo '<td>True</td>';
				}else{
					echo '<td>False</td>';
				}
				echo "<td><input type=\"checkbox\" name=\"check_list[]\" value='".json_encode(array_map("htmlspecialchars",$row))."'></td>";
			}
		}else{
			echo '<tr>No message</tr>';
		}


		echo '</table>
					<button type="submit" name="delete" formaction="delete.php">Delete</button>
					<button type="submit" name="verify" formaction="verify.php">Verify</button>
					</div>
					</form>';

	?>
	<script type="text/javascript">
	  function nav() {
	  var x = document.getElementById("top");
	  if (x.className === "top") {
	    x.className += " responsive";
	  } else {
	    x.className = "top";
	  }
	}
	</script>
</body>
</html>

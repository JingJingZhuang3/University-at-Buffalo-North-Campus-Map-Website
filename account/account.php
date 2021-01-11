<?php
	// check duration time (for testing it is 10 seconds)
	session_start();
	include("duration.php");
	if(isset($_SESSION['did'])){
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
	<title>My account</title>
</head>
<body>
	<?php
	session_start();
	if(isset($_SESSION['did'])){
		echo "<div class='header'>";
		echo "<h1 style='color: White;'>UB North Campus Navigation</h1>";
		echo "</div>";

		echo "<div class='top' id='top'>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/".">Home</a>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/logout.php".">Logout</a>";
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account_setting_page.php".">Settings</a>";

		if($_SESSION['did']=='admin'){
		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/inbox.php".">Inbox</a>";
		}

		echo "<a href="."https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/account.php".">Welcome, ".$_SESSION['did']."!</a>";
		echo '<a href="javascript:void(0);" class="icon" onclick="nav()"><i class="fa fa-bars"></i></a>';
		echo "</div>";

		echo "<table>";

		echo "<tr>";
		echo "<th>Your Username:</th><td>".htmlspecialchars($_SESSION['did'])."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Your Password:</th><td>".htmlspecialchars($_SESSION['dpwd'])."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<th>Your Email:</th><td>".htmlspecialchars($_SESSION['demail'])."</td>";
		echo "</tr>";
		echo "<tr>";

		echo "<th>Your default route option:</th><td>".htmlspecialchars($_SESSION['route'])."</td>";
		echo "</tr>";
		echo "</table>";
		}

	else {echo "You are not logged in.";}
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

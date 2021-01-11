<?php
  session_start();
  include("duration.php");
  $message="";
if(isset($_POST['userid'])&&isset($_POST['pwd'])){
  $id=$_POST['userid'];
  $pwd=$_POST['pwd'];
  $dpwd;
  $did;
  $demail;
  $mysqli = new mysqli("tethys.cse.buffalo.edu:3306", "yingyinl", "50239602", "cse442_542_2020_spring_teamt_db");
  if ($conn->connect_error) {
    exit("Something is wrong. Please try again");
  }
  $arr = [];
  $stmt = $mysqli->prepare("SELECT * FROM users WHERE userid = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  while($row = $result->fetch_assoc()) {
    $arr[]=$row;
    $dpwd=$row['pwd'];
    $did=$row['userid'];
    $demail=$row['email'];
    $droute=$row['option1'];
  }
  if(!$arr) $message= "Username or Password incorrect";
  else {
    if(!password_verify($pwd,$dpwd)){
        $message=  "Username or Password incorrect";
    }
    else if(password_verify($pwd,$dpwd) && $did==$id){
		$_SESSION['did']=$did;
		$_SESSION['dpwd']=$dpwd;
		$_SESSION['demail']=$demail;
    $_SESSION['route']=$droute;
		$_SESSION['login_time'] = time();
	}
  }
  $stmt->free_result();
  $mysqli->close();
}

if(isset($_SESSION['did'])){
	if(!checkLoginExpired()) {
		header("Location:account.php");
	} else {
		header("Location:logout.php?session_expired=1");
	}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
      html{
        background-image: url("../pic/background.jpg");
        width:100%;
        height:100%;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
		position:relative;
      }
      .box{
          position:absolute;
          text-align:center;
          transform: translate(-50%,-50%);
          top: 50%;
          left:50%;
      }
	  .form{
		  margin-left: 90px;
	  }
      .header {
        position:absolute;
        background-color: #3366cc;
        text-align: center;
        align-items: center;
        vertical-align: middle;
        width: 450px;
        height: 330px;
		transform: translate(-50%,-50%);
		top: 50%;
        left:50%;
		opacity:0.8;
		color: white;
      }
      .returnToHome{
        position: absolute;
        top:-25%;
        left:40.5%;
      }
      .returnToHome a{
        font-size: 50px;
        color: #3366cc;
        text-decoration: none;
        padding: 10px 10px;
        font-family: sans-seri;
        font-weight:bold;
      }
	  .message {
		color: #333;
		border: #FF0000 1px solid;
		background: #FFE7E7;
		padding: 5px 20px;
	  }
    </style>
  </head>
  <body>
    <div class="box">
      <div class ="header">
        <div class="returnToHome">
          <a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/">
          <ion-icon name="home"></ion-icon>
        </a>
        </div>
        <h1>Login Here</h1>
		<p> Only logged in user can save search history<br /></p>
		<?php if($message!="") { ?>
		<div class="message"> <?php echo $message; ?> </div>
		<?php } ?>
		<div class = "form">
          <?php
			session_start();
				// provide form to log in
				echo '<form method="post">';
				echo '<table>';
				echo '<tr><td>Username:</td>';
				echo '<td><input type="text" name="userid" placeholder="Enter Your Username" required></td></tr>';
				echo '<tr><td>Password:</td>';
				echo '<td><input type="password" name="pwd" placeholder="Enter Your Password" required></td></tr>';
				echo '<tr><td colspan="2" align="center">';
				echo '<input type="submit" name="submit" value="Log in"></td></tr>';
				echo '</table></form>';
			?>
		</div>
		<p> Don't have an account yet?</p>
		<a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/signup.php">Sign Up Here</a>
        </div>
    </div>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  </body>
<html>

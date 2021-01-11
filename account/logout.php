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
	  .message {
		color: #333;
		border: #FF0000 1px solid;
		background: #FFE7E7;
		padding: 5px 20px;
	  }
	</style>
  </head>
  <body>
<?php
session_start();
$old_user = $_SESSION['did'];
unset($_SESSION['did']);
unset($_SESSION['dpwd']);
session_destroy();
//$back = "login.php";
$text ="";
if (isset($_GET['session_expired'])){
	//$url .= "?session_expired=" .$_GET["session_expired"];
	//header("Location:$back");
	$text = "Your Login is Expired. Please Login Again";
	//alert($text);
	?>
	<div class="box">
      <div class ="header">
		<h1>UB North Campus Navigation</h1>
		<div class="message"> <?php echo $text; ?> </div>
		<h2>Click here to <a href="login.php" title="Logout">Login</a></h2>
		<h2>Click here to <a href="../index.php" title="home">Back to Map</a></h2>
	</div>
    </div>
<?php
} else if (!empty($old_user)){
	$text ="You are Logged Out";
	//alert($text);
	?>
	<div class="box">
      <div class ="header">
		<h1>UB North Campus Navigation</h1>
		<div class="message"> <?php echo $text; ?> </div>
		<h2>Click here to <a href="login.php" title="Logout">Login</a></h2>
		<h2>Click here to <a href="../index.php" title="home">Back to Map</a></h2>
	</div>
    </div>
	<?php
} else {
	$text = "You were not logged in, and so have not been logged out.";
	//alert($text);
	?>
	<div class="box">
      <div class ="header">
		<h1>UB North Campus Navigation</h1>
		<div class="message"> <?php echo $text; ?> </div>
		<h2>Click here to <a href="login.php" title="Login">Login<br /></a></h2>
		<h2>Click here to <a href="../index.php" title="home">Back to Map</a></h2>
	  </div>
    </div>
<?php
}

function alert($msg){
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>
</body>
<html>

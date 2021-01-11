
<!DOCTYPE html>
<html lang="en">
<head>
<title>UB North Campus Navigation</title>
<meta name="description" content="UB North Campus Navigation for shortest, outdoor, and tunnel routes">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../style.css">

<style>



.buttons{

  width:300px;
  height:300px;

  border: 1px solid #ccc;
  background-color: #f3f3f3;
}


.sbutton{
  background-color: color:#000;
}

.buttons h1{
  text-align: center;
}

table{
  height:auto;
  width: auto;

}
table,td,td{
  border:none;
}
</style>
</head>

<body>

  <div class="header">
    <h1 style="color: White;">UB North Campus Navigation</h1>
  </div>
  <div class="top" id="top">
<a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/" >Home</a>
<a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/Contact">Contact Us</a>
<a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/About_Us">About Us</a>
<a href="javascript:void(0);" class="icon" onclick="nav()">
  <i class="fa fa-bars"></i>
</a>
</div>

  <?php

  // check duration time (for testing it is 10 seconds)
 session_start();
 $sessionid=$_SESSION['did'];
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
  if(isset($_SESSION['did'])&&$_SESSION['dpwd']){
    $message=$_SESSION['message'];
    if($message!=""){
      echo "<script>alert('$message');</script>";
    }
    $_SESSION['message']="";
  }
  else{
    header("Location: ../index.php");
    exit();
  }
  ?>
  <div class="buttons">
      <form method="post" action="account_setting.php">
        <table>
          <h1>Account Setting</h1>
          <tr>
            <td>New Password</td>
            <td><input type="password" class="input-box" name="newpwd"></td>
          </tr>

          <tr>
            <td>Confirm Password</td>
           <td><input type="password" class="input-box" name="confirmpwd"></td>
          </tr>

          <tr>
            <td>New E-mail</td>
            <td><input type="email" class="input-box" name="newemail"></td>
          </tr>
          <tr>
            <label >Default Route Option</label>
            <select  id="routes" class ="drop-box"name="routes">
              <option value=""></option>
              <option value="shortest">shortest</option>
              <option value="outdoor">outdoor</option>
              <option value="tunnel">tunnel</option>
            </select>
          </tr>

          <tr>
            <td colspan="2">
            <input type="submit" class="sbutton" value="Save Changes"></td>
          </tr>
        </table>
      </form>
  </div>

<script>
    let id="<?php echo htmlspecialchars($sessionid);?>"; let a = document.createElement("a");
    a.innerHTML="Welcome! "+id;
    a.href="account.php";
    document.getElementById("top").appendChild(a);
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

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

      .header {
        position:absolute;
        text-align: center;
        align-items: center;
        vertical-align: middle;
		    transform: translate(-50%,-50%);
		    top: 50%;
        left:50%;
      }

	    .signup_form{
        width:300px;
        padding: 20px;
        top: 50%;
        left:50%;
        margin: 8% auto 0;
        text-align: center;
        background-color: #FFF;
        opacity: 0.9;
	    }

      .signup_form h1{
        color:#0040FF;
      }


      .input-box{
        boarder-radius: 25px;
        boarder: 2px solid #609;
        padding: 18px;
        width: 200px;
        height:15px;
      }

      .sbutton{
        background-color: color:#000;
      }

      .returnToHome{
        position: absolute;
        top:12%;
        left:7.5%;
      }
      .returnToHome a{
        font-size: 50px;
        color: #3366cc;
        text-decoration: none;
        padding: 10px 10px;
        font-family: sans-seri;
        font-weight:bold;
      }
}
.message {
color: #333;
border: #FF0000 1px solid;
background: #5EFF33;
padding: 5px 20px;
}
  .error {
    color: #333;
    border: #FF0000 1px solid;
    background: #FFE7E7;
    padding: 5px 20px;
}
    </style>
  </head>

  <body>

    <div class="header">
    	<div class = "signup_form">
        <div class="returnToHome">
          <a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/">
          <ion-icon name="home"></ion-icon>
          </a>
        </div>
        <form method="post" action="signup.php">
          <table>
            <h1>Sign Up</h1>
            <tr>
              <td><input type="text" class="input-box" name="userid" placeholder="Enter username" required></td>
            </tr>
            <tr>
             <td><input type="password" class="input-box" name="pwd" placeholder="Enter password"required></td>
            </tr>

            <tr>
              <td><input type="email" class="input-box" name="email" placeholder="Enter email address"required></td>
            </tr>

            <tr>
              <td colspan="2">
              <input type="submit" class="sbutton" value="Sign Up"></td>
            </tr>
          </table>
          <hr>
          <p><p>Already have an account? Click <a href="https://www-student.cse.buffalo.edu/CSE442-542/2020-Spring/cse-442t/account/login.php">here</a> to log in.</p></p>
        </form>
  	   </div>
     </div>
     <?php
      $message="";
     if(isset($_POST['userid'])&&isset($_POST['pwd'])&&isset($_POST['email'])){
       $id=$_POST['userid'];
       $pwd=$_POST['pwd'];
       $email=$_POST['email'];
       $mysqli = new mysqli("tethys.cse.buffalo.edu:3306", "yingyinl", "50239602", "cse442_542_2020_spring_teamt_db");
       if ($conn->connect_error) {
         exit("Something is wrong");
       }
       $stmt = $mysqli->prepare("SELECT * FROM users WHERE userid = ?");
       $stmt->bind_param("s", $id);
       $stmt->execute();
       $result = $stmt->get_result();
       if($result->num_rows === 0){
         $hash = password_hash($pwd, PASSWORD_BCRYPT);
         $stmt1 = $mysqli->prepare("INSERT INTO users(userid, pwd, email) VALUES(?,?,?)");
         $stmt1->bind_param("sss", $id, $hash, $email);
         $stmt1->execute();
         $stmt1->close();
         $message="Account successfully created! Try logging in!";
         mail($email,"Thank You from UB North Campus Navigation", "Thank you for signing up! Let us know if we can improve!");
       }
       else{$message= "Username already exists";}
       $stmt->close();
       echo "<script>alert('$message');</script>";
     }
      ?>
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  </body>
<html>

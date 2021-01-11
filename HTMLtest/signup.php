<?php
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
    echo "Account successfully created!";
    mail($email,"Thank You from UB North Campus Navigation", "Thank you for signing up! Let us know if we can improve!");
  }
  else{echo "Username already exists";}
  $stmt->close();
}else{
  echo "Nothing is submitted. Please try again";
}

 ?>

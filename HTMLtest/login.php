<?php
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
  }
  if(!$arr) echo "Username or Password incorrect";
  else {
    if(!password_verify($pwd,$dpwd)){
        echo  "Username or Password incorrect";
    }
    else if(password_verify($pwd,$dpwd) && $did==$id){
      echo "<p>You are logged in.";
      echo "</p>";
      echo "<p> Your Username is:";
      echo htmlspecialchars($did);
      echo "</p>";
      echo "<p> Your Password is:";
      echo htmlspecialchars($dpwd);
      echo "</p>";
      echo "<p> Your E-mail is:";
      echo htmlspecialchars($demail);
      echo "</p>";
    }
  }
  $stmt->free_result();
  $mysqli->close();
}else{
  echo "Nothing was submitted";
}
?>

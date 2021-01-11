<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Locations that need immediate attention</title>
    <style media="screen">

      table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
      }
      th, td {
        padding: 5px;
      }
      th {
        text-align: left;
      }
      .box{
        position:absolute;
        transform: translate(-50%,-50%);
        top: 50%;
        left: 50%;
      }
      button{
        float:right;
      }
    </style>
  </head>

  <body>
    <form action="" method="post">
      <div class="box">
        <table>
          <tr>
            <th>Location</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Description</th>
            <th></th>
          </tr>
          <tr>
            <td>Alumni</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" name="check_list[]" value="1"></td>
          </tr>
          <tr>
            <td>Baldy</td>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="checkbox" name="check_list[]" value="2"></td>
          </tr>
        </table>
        <button type="submit" name="delete" formaction="formtest.php">Delete</button>
        <button type="submit" name="verify" formaction="formtest.php">Verify</button>
      </div>
    </form>
    <?php
      if(isset($_POST['verify'])){
        if(!empty($_POST['check_list'])){
          foreach($_POST['check_list'] as $box){
            echo $box."</br>";
          }
        }
      }
    ?>
  </body>
</html>

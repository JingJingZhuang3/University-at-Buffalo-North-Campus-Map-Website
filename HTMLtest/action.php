<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <script src="../js/shortest.js"></script>
    <script src="../js/algo.js"></script>
    <script src="../js/outdoor.js"></script>
    <script src="../js/tunnel.js"></script>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $json=$_POST['array'];
    $arr=json_decode($json,true);
    print_r($arr);
     ?>
    <form id="form" method ="POST" action="">
      <input type="hidden" id="array" name="array" value="" onchange="myfunc()">
     </form>

  </body>
  <script>
    let jsondata = JSON.stringify(BFS(tunnelDict,"Alfiero Center","Baldy Hall"));
    let element=document.getElementById("array");
    element.setAttribute("value",jsondata);
    function myfunc(){    document.getElementById("form").submit();}

</script>
</html>

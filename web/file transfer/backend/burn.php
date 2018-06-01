<?php
include("database.php");
$token = $_POST['token'];

//getting all the files to be burned
$sql = "SELECT * FROM `pivot` WHERE `token` = '$token';";
$result = mysqli_query($link, $sql);

// burning the files
if($result !== false){
  if (mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      unlink($row['filePath']);
    }
  }
}
// removing them from the database
$burnQ = "DELETE FROM `pivot` WHERE `token` = '$token';";
mysqli_query($link, $burnQ);
$_SESSION['token'] = NULL;
header("location: ../");

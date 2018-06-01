<?php
  $target_file = "../uploads/" . basename($_FILES["uploadFile"]['tmp_name']);
  // starting the upload session
  include_once('tokenGen.php');
  include_once("database.php");
  session_start();


  // when there is something to upload
  // checking if there is something
  if(empty($_FILES['uploadFile'])){
    header("location: ../");
    $_SESSION['error'] = "please upload a file";
    die;
  }

  // checking if the upload isn't to big
  if($_FILES['uploadFile']['size'] > 10000000){ // 10 mb
    header("location: ../");
    $_SESSION['error'] = "file to large";
    die;
  }

  // generating a token if there isn't one set
  if(empty($_SESSION['token'])){
    $obj_token = new token;
    $token = $obj_token->generate();
  }
  else{
    $token = $_SESSION['token'];
  }


  // uploading file to server
  if($_FILES['uploadFile']['error'] == UPLOAD_ERR_OK){
    $size = $_FILES['uploadFile']['size'];
    $name = basename($_FILES["uploadFile"]["name"]);
    $tmp_name = $_FILES["uploadFile"]["tmp_name"];
    $path = "/var/www/uploads/$name" . $token;
    move_uploaded_file($tmp_name, $path); // putting file in uploads
  }

  // putting it in the database
  $sql = "INSERT INTO pivot (name, token, filepath, size) VALUES ('$name', '$token', '$path', '$size');";
  mysqli_query($link, $sql);
  echo($token);
  header("location: ../?t=$token");

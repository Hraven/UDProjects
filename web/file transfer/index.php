<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
      session_start();
      include("backend/database.php");
      include("backend/tokenGen.php");
      include("backend/downloadCardClass.php");
      $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      $opj_token = new token;
      $toDownload = [];

      $_SESSION['token'] = (isset($_GET['t'])) ? $_GET['t'] : NULL;
      // checking if the token given is valid
      $token = $_SESSION['token'];
      if(!empty($token)){
        if(!$opj_token->validate($token)){
          header("location: error?error=badtoken");
          die;
        }

        // checking if the token is still in the database
        $sql = "SELECT * FROM `pivot` WHERE `token` = '$token';";
        $result = mysqli_query($link, $sql);
        if(!$result){
          header("location: error?error=expired");
          die;
        }
      }
      $css = "DCard_NEven";
     ?>
    <link rel="stylesheet" href="main.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="">
    </div>


      <div class="downloads">
        <div class="file">
          <form enctype="multipart/form-data" class="form" action="backend/upload.php?t=" method="post">
            <input type="file" name="uploadFile" id="uploadFile">
            <input type="submit">
          </form>
        </div>
        <h1>files</h1>
        <?php
        // going to print all the enrtys with this token
        if(!empty($_GET['t'])){
          $sql = "SELECT * FROM `pivot` WHERE `token` = '$token';";
          $result = mysqli_query($link, $sql);

          if($result !== false){
            if (mysqli_num_rows($result) > 0){
              // output data of each row
              while($row = mysqli_fetch_assoc($result)){
                $opj = new DCard($row);
                $opj->drawCard();
              }
            }
          }
        }
        else{
          echo "<h2>no files</h2>";
        }
      ?>
        <div class="burn">
          <form class="" action="backend/burn.php" method="post">
            <input hidden name="token" value=<?php echo '"'.$token.'"'; ?>>
            <button type="submit" name="button">burn this link</button>
          </form>
        </div>
        <div class="url">
          <?php if(isset($token)){
            echo "your url is:  " . $url;
          } ?>
        </div>
      </div>

      <div class="error">
        <?php
          //print all the stuff uploaded to this token
          if(isset($_SESSION['error'])){
            echo($_SESSION['error']);
            unset($_SESSION['error']);
          }
        ?>
      </div>

  </body>
</html>

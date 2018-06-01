<?php
  class DCard{
    // init global var
    private $name;
    private $path;
    private $token;
    private $size;
    static private $even;  // a boolean to check what color background it should be
    private $css;

    function __construct($row = []){
      // checkig and setting global var
      if(empty($row)){
        return "file not found";
      }
      $this->name = $row['name'];
      $this->path = $row['filePath'];
      $this->token = $row['token'];
      $this->size = $row['size'] / 1000;



      //switching $even
      $this->even = (empty($this->even)) ? false : true;
      $this->even = ($this->even) ? false : true;
      $this->css = ($this->even) ? "DCard_Even" : "DCard_NEven";
    }

    function drawCard(){
      ?>
      <div class="DCard">
        <div class=<?php echo '"'.$this->css.'"'; ?>>
          <div class="DCname">
            <form action="backend/download.php" method="post">
            <?php
              echo $this->name;
            ?>
              <input hidden name="toDownload" value=<?php echo '"'.$this->path.'"'; ?>>
              <input hidden name="token" value=<?php echo '"'.$this->token.'"'; ?>>
              <input hidden name="name" value=<?php echo '"'.$this->name.'"'; ?>>
              <button type="submit"><p>download</p></button>
              <?php
              echo "<br>";
              echo $this->size . "KB";
              ?>
            </form>
          </div>
        </div>
      </div>
      <?php
    }
  }

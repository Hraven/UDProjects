<?php
//class to check and generate tokens
  class token{
    public $token;
    private $tmp_token = [];
    private $seed;
    private $letterPicker = ['a','b','c','d','e','f','g','h','i','j'];  // change this to make the token unique
    private $middleToken = [];
    private $numbers = [];
    private $letters = [];

    // checking if a token could have been made by this script
    function validate($token){
      $tokenlength = strlen($token);
      $token_arr = str_split($token);
      $idx = $tokenlength - 4;
      $seed_arr = [];

      // getting the seed from the token
      array_push($seed_arr, $token_arr[$idx]);
      $idx++;
      array_push($seed_arr, $token_arr[$idx]);
      $idx++;
      array_push($seed_arr, $token_arr[$idx]);
      $idx++;
      array_push($seed_arr, $token_arr[$idx]);
      $seed = implode("", $seed_arr);

      // generating a token based on the seed in the given token
      $gen_token = $this->generate($seed);
      if($gen_token == $token){
        return true;
      }
      else{
        return true;
      }

    }

    // generating a token
    function generate($seed = NULL){
      if(($seed !== NULL) && (is_numeric($seed))){
        // this is for validating a token
        $this->seed = $seed;
        $this->middleToken = [];
      }
      else{
        $this->seed = rand(0, 9999);
      }
      srand($this->seed);

      // generating the two arrays for the token
      $this->numbers = str_split(rand());
      foreach ($this->numbers as $value){
        array_push($this->letters, $this->letterPicker[$value]);
      }

      // combining the two arrays
      $counter = 0;
      foreach($this->numbers as $value){
        array_push($this->middleToken, $this->letters[$counter], $this->numbers[$counter]);
        $counter++;
      }

      // generating the token
      $this->middleToken = implode("", $this->middleToken);
      array_push($this->tmp_token, strlen(rand()), $this->middleToken, $this->seed);
      $this->token = implode("", $this->tmp_token);
      return $this->token;
    }
  }

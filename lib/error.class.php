<?php

/**
 * Handles Logic errors
 *
 * @author murdock
 */
class error_manager {
  

  public static function checkError()
  {
    $errors = array(1=>"Username or password incorrect.", 2=>"There was an error starting the Initiative.",3=>"There was an problem processing the pdf file.");
    if($_GET["e"]) alert($errors[$_GET["e"]]);
  }
}

?>
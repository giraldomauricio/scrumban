<?php

class splunk {
  
  public static function log($message,$detail="")
  {
    $log = "";
      foreach ($message as $key => $value) {
          $log .= $key."=\"".$value."\" ";
      }
      $log .= " ".$detail;
      $log .= " script=\"".$_SERVER["SCRIPT_FILENAME"]." session=\"".$_REQUEST["PHPSESSID"]."\" addr=\"".$_ENV["REMOTE_ADDR"]."\"";
    logFactory::splunk($log);
  }
}
?>
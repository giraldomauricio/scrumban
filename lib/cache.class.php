<?php

/**
 * Controls Application Level Cache for Application Speed Enhancement
 *
 * @author murdock
 */
class cache {

  var $url = "";
  var $cache = "";

  function __construct() {
    $this->url = $_SERVER["REQUEST_URI"];
  }

  public function url2File() {
    global $cacheFolder, $appFolder;
    $cacheFile = $this->url;
    $cacheFile = str_replace($appFolder, "", $cacheFile);
    $cacheFile = str_replace("?", "--QS--", $cacheFile);
    $cacheFile = str_replace("&", "--AND--", $cacheFile);
    $cacheFile = str_replace(".", "__DOT__", $cacheFile);
    $cacheFile = str_replace("=", "__EQ__", $cacheFile);
    $cacheFile .= ".html";
    //return "U-".$_SESSION["id_user"]."__V-".$_SESSION["version_id"]."__F-".$cacheFile;
    return $_SESSION["id_user"] . "/" . $_SESSION["version_id"] . "/" . $cacheFile;
  }

  public function checkUserSession() {
    global $cacheFolder;
    if (!file_exists($cacheFolder . $_SESSION["id_user"]))
      mkdir($cacheFolder . $_SESSION["id_user"]);
    if (!file_exists($cacheFolder . $_SESSION["id_user"] . "/" . $_SESSION["version_id"]))
      mkdir($cacheFolder . $_SESSION["id_user"] . "/" . $_SESSION["version_id"]);
  }

  public function load() {
    global $cacheFolder;
    $cacheFile = $this->url2File();
    if (file_exists($cacheFolder . $cacheFile)) {
      $this->cache = file_get_contents($cacheFolder . $cacheFile);
      return true;
    }
    else return false;
    
  }

  public function save($content) {
    global $cacheFolder;
    $this->checkUserSession();
    $cacheFile = $this->url2File();

    if (!$handle = fopen($cacheFolder . $cacheFile, 'a')) {
      return false;
    }

    if (fwrite($handle, $content) === FALSE) {
      return false;
    }
    fclose($handle);
    return true;
  }

  public function clear() {
    global $cacheFolder;
    $cacheFile = $this->url2File($this->url);
    unlink($cacheFolder.$cacheFile);
  }

}

?>
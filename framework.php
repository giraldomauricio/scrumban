<?
// ###################################################################
// phpEXelerator v.3.3
// Dating Portal Framework v.1.0
// This software was designed to manage dating sites only, is not
// intended to promote, sell or market any kind of sexual solicitation
// of any kind or to exploit of any form sexual activities.
// (R) 2005-2012
// ###################################################################
// Start application configuration

ini_set('max_execution_time', '1800');
ini_set('max_input_time', '1800');
ini_set('memory_limit', '256M');
ini_set('post_max_size', '256M');
ini_set('upload_max_filesize', '256M');

session_start();

error_reporting(0);

define("DEBUG", true);
define("LIBRARY", "lib/");
define("SECURE", false);
define("LOG", true);
define("VERBOSE", false);
define("VISUAL_ERRORS", false);
define("ROOT","/Library/WebServer/Documents/scrumban/");

if ($_SERVER['HTTPS'] != "on" && SECURE) {
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect");
}

// Check if the script is in admin mode
//if($admin && !$_SESSION["id_user"]) header("Location: index.php");
// Declare where the application is located
global $path, $uploadto, $app;

$path = LIBRARY;
// ###################################################################
// ################# FRAMEWORK #######################################
// ###################################################################
// Load all classes

global $log_folder;
$log_folder = "log";

$mydir = dir($path);
require_once $path . "config.php";
require_once $path . "class.php";
require_once $path . "log.php";
require_once $path . "utils.class.php";
while (($file = $mydir->read())) {
    if (substr($file, 0, 1) != "." && substr($file, 0, 1) != "_") {
        if (DEBUG)
            logFactory::log("Framework", " Loading [" . $file . "]..");
        require_once $path . $file;
        if (DEBUG)
            logFactory::log("Framework", "[" . $file . "] loaded successfully.");
    }
}
logFactory::log("Full Framework","Loaded successfully.");
?>
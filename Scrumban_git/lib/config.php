<?
// Configuration File
// Portal Builder 3.0
// (R) 2005-2012
// Software version
$version = 1;
// Database information
$dbserver = "localhost";
$dbuser = "bionet";
$dbpass = "hOOters";
$dbname = "scrumban";
// Global variables
global $res_pag;
$res_pag = 30;
global $upload_folder, $log_folder, $fromMail;
$log_folder = "log/";
$upload_folder = "files/";
$appFolder = "/stg/";
$fromMail = "no-reply@bymurdock.com";

$portalName = "SCRUMBAN v.1.1";

define("PORTAL_NAME", $portalName);
define("PORTAL_URL", "http://www.bymurdock.com/scrumban/");
define("PORTAL_MAIL", "mgiraldo@gmail.com");
define("LOG_FOLDER", "log");
?>
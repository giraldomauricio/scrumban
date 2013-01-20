<?
// Configuration File
// Portal Builder 3.0
// (R) 2005-2013
// Software version
$version = 2;
// Database information
$dbserver = "scrumtasksdb.db.10352174.hostedresource.com";
$dbuser = "scrumtasksdb";
$dbpass = "Scrum2013!";
$dbname = "scrumtasksdb";
// Global variables
global $res_pag;
$res_pag = 30;
global $upload_folder, $log_folder, $fromMail;
$log_folder = "log/";
$upload_folder = "files/";
$appFolder = "/stg/";
$fromMail = "no-reply@bymurdock.com";

$portalName = "ScrumTasks v.1.2";

define("PORTAL_NAME", $portalName);
define("PORTAL_URL", "http://www.scrumtasks.com/");
define("PORTAL_MAIL", "mgiraldo@gmail.com");
define("LOG_FOLDER", "log");
?>
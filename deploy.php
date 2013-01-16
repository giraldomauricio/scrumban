<?php
require 'framework.php';
$git = new github();
$git->owner = "giraldomauricio";
$git->repo = "scrumban";
$git->downloadAndDeployRepository("master");
?>
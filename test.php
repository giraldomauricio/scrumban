<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'framework.php';

$git = new github();
$git->owner = "giraldomauricio";
$git->repo = "scrumban";
//$git->downloadRepository("master");
$git->action = "keys";
$git->load();
print_r($git->obj);
print_r(error_get_last());
?>

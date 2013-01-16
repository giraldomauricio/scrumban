<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

require 'framework.php';

$git = new github();
$git->owner = "giraldomauricio";
$git->repo = "scrumban";
$git->downloadRepository("master");
//print $git->loadLastCommitSha();
?>
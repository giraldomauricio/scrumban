<?
// ######################################################################
// list for main_sprints table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:48
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_sprints = new main_sprints();
$db_main_sprints->getProjectSprints($_GET["project"]);
//
$db_main_projects = new main_projects;
$db_main_projects->getOne($_GET["project"]);
$db_main_projects->load();
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=projects&team=<?=$_GET["team"]?>">Projects</a> <span class="divider">/</span></li>
          
          <li><a href="#"><?=$db_main_projects->get_pro_name();?></a><span class="divider">/</span></li>
          
          <li><a href="#" class="active">Tasks</a></li>
        </ul>


<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">

<tr id="listPager">
    <td colspan="10"><h3><?=$db_main_projects->get_pro_name();?></h3></td>
  </tr>
  <tr id="listInsert">
    <td colspan="6"><a href="index.php?load=sprint.do&do=insert&project=<?=$_GET["project"]?>&team=<?=$_GET["team"]?>" class="btn btn-success btn-large">Add Sprint</a></td>
  </tr>

  <tr id="listHeader">
    <td>Start</td>
    <td>End</td>
    
    <td>Status</td>
    <td>Tasks</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <? while($db_main_sprints->load()){?>
  <tr id="listRow">
    <td><?=$db_main_sprints->get_sprint_start()?></td>
    <td><?=$db_main_sprints->get_sprint_end()?></td>
    <td><?=$db_main_sprints->statusDisplay($db_main_sprints->get_sprint_status())?></td>
    <td><a href="index.php?load=tasks&sprint=<?=$db_main_sprints->get_sprint_id()?>&project=<?=$_GET["project"]?>&team=<?=$_GET["team"]?>" class="btn btn-info btn-large">Tasks <i class="icon-tasks icon-white"></i></a></td>
    <td><a href="index.php?load=sprint.do&do=edit&id=<?=$db_main_sprints->get_sprint_id()?>&project=<?=$_GET["project"]?>&team=<?=$_GET["team"]?>"  class="btn btn-warning btn-large">Edit <i class="icon-edit icon-white"></i></a></td>
    <td><a href="index.php?load=sprint.do&do=delete&id=<?=$db_main_sprints->get_sprint_id()?>&project=<?=$_GET["project"]?>&team=<?=$_GET["team"]?>" class="btn btn-danger btn-large">Delete <i class="icon-trash icon-white"></i></a></td>
  </tr>
  <? }?>
</table>
<?
$db_main_sprints->close()?>

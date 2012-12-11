<?
// ######################################################################
// list for main_projects table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 09:12:38
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
$db_main_projects = new main_projects;
$db_main_projects->getAllProjects($_GET["team"]);
?>

<ul class="breadcrumb">
          <li><a href="#" class="active">Projects</a></li>
        </ul>

<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
  <tr id="listInsert">
    <td colspan="7"><a href="index.php?load=project.do&do=insert&team=<?=$_GET["team"]?>" class="btn btn-success btn-large">Add Project</a></td>
  </tr>
  <tr id="listHeader">
    <td>Name</td>
    <td>Team</td>
    <td>Status</td>
    <td>Sprints</td>
    <td>Tasks</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <? while($db_main_projects->load()){?>
  <tr id="listRow">
    <td><h4><?=$db_main_projects->get_pro_name()?></h4></td>
    <td><h4><?=$db_main_projects->get_team_name()?></h4></td>
    <td><h4><?=$db_main_projects->statusDisplay($db_main_projects->get_pro_status())?></h4></td>
    <td><a href="index.php?load=sprints&project=<?=$db_main_projects->get_pro_id()?>&team=<?=$_GET["team"]?>" class="btn btn-info btn-large">Sprints <i class="icon-calendar icon-white"></i></a></td>
    <td><a href="index.php?load=tasks&project=<?=$db_main_projects->get_pro_id()?>&team=<?=$_GET["team"]?>" class="btn btn-info btn-large">Tasks <i class="icon-tasks icon-white"></i></a></td>
    <td><a href="index.php?load=project.do&do=edit&id=<?=$db_main_projects->get_pro_id()?>&team=<?=$_GET["team"]?>" class="btn btn-warning btn-large">Edit <i class="icon-edit icon-white"></i></a></td>
    <td><a href="index.php?load=project.do&do=delete&id=<?=$db_main_projects->get_pro_id()?>&team=<?=$_GET["team"]?>" class="btn btn-danger btn-large">Delete <i class="icon-trash icon-white"></i></a></td>
  </tr>
  <? }?>
</table>
<?
$db_main_projects->close()?>

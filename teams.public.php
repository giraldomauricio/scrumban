<?
// ######################################################################
// list for main_teams table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 09:12:38
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
$db_main_teams = new main_teams;
$db_main_teams->getAllTeams();
?>

<ul class="breadcrumb">
          <li><a href="#" class="active">Teams</a></li>
        </ul>

<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
  <tr id="listInsert">
    <td colspan="5"><a href="index.php?load=team.do&do=insert" class="btn btn-success btn-large">Add Team</a></td>
  </tr>
  <tr id="listHeader">
    <td>Name</td>
    <td>Leader</td>
    <td>Projects</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <? while($db_main_teams->load()){?>
  <tr id="listRow">
    <td><h4><?=$db_main_teams->get_team_name()?></h4></td>
    <td><h4><?=$db_main_teams->get_use_name()?></h4></td>
    <td><a href="index.php?load=projects&team=<?=$db_main_teams->get_team_id()?>" class="btn btn-warning btn-large">Projects <i class="icon-th-list icon-white"></i></a></td>
    <td><a href="index.php?load=team.do&do=edit&id=<?=$db_main_teams->get_team_id()?>" class="btn btn-warning btn-large">Edit <i class="icon-edit icon-white"></i></a></td>
    <td><a href="index.php?load=team.do&do=delete&id=<?=$db_main_teams->get_team_id()?>" class="btn btn-danger btn-large">Delete <i class="icon-trash icon-white"></i></a></td>
  </tr>
  <? }?>
</table>
<?
$db_main_teams->close()?>

<?
// ######################################################################
// list for main_users table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 11:12:18
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_users = new main_users;
$db_main_users->getAllUsers();
?>

<ul class="breadcrumb">
          <li><a href="#" class="active">Users</a></li>
        </ul>

<table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
  <tr id="listInsert">
    <td colspan="7"><a href="index.php?load=user.do&do=insert" class="btn btn-success btn-large">Add User</a></td>
  </tr>

  <tr id="listHeader">
    <td>Name</td>
    <td>Email</td>
    <td>Team</td>
    <td>WIP Tasks</td>
    <td>Load Units</td>
    <td>Edit</td>
    <td>Delete</td>
  </tr>
  <? while($db_main_users->load()){?>
  <tr id="listRow">
    <td><?=$db_main_users->get_use_name()?></td>
    <td><?=$db_main_users->get_use_email()?></td>
    <td><?=$db_main_users->get_team_name()?></td>
    <td><?=$db_main_users->get_wip_tasks()?></td>
    <td><?=$db_main_users->get_wip_load()?></td>
    <td><a href="index.php?load=user.do&do=edit&id=<?=$db_main_users->get_use_id()?>" class="btn btn-warning btn-large">Edit <i class="icon-edit icon-white"></i></a></td>
    <td><a href="index.php?load=user.do&do=delete&id=<?=$db_main_users->get_use_id()?>" class="btn btn-danger btn-large">Delete <i class="icon-trash icon-white"></i></a></td>
  </tr>
  <? }?>
</table>
<?
$db_main_users->close()?>

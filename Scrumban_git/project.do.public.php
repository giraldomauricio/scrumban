<?
// ######################################################################
// Edit Form for main_projects table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:46
// ClassBuilder classes requires ConDB v.1.1 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_projects = new main_projects;
$return = false;
$db_main_projects->loadParams();
if ($_POST["do"]=="edit_exec")
{
	$db_main_projects->updateOne($_POST["id"]);
	$return = true;
}
if ($_POST["do"]=="insert_exec")
{
	$db_main_projects->insertOne();
	$return = true;
}
if ($_POST["do"]=="delete_exec")
{
	$db_main_projects->deleteOne($_POST["id"]);
	$return = true;
}
if ($return) jsheader("index.php?load=projects&team=".$_GET["team"]);
if ($_GET["do"]=="edit" || $_GET["do"]=="delete"){
	$db_main_projects->getOne($_GET["id"]);
	$db_main_projects->load();
}
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=projects">Projects</a> <span class="divider">/</span></li>
          <li><a href="#" class="active"><?=$db_main_projects->get_pro_name();?></a></li>
          
        </ul>

<script language="javascript" src="js/main.js"></script>
<form action="index.php?load=project.do&team=<?=$_GET["team"]?>" method="post" name="do_main_projects" id="do_main_projects" onSubmit="return validate_types(this);">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
    <tr>
      <td>Name</td>
      <td><input name="pro_name" type="text" id="pro_name" value="<?=$db_main_projects->get_pro_name();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td>Team</td>
      <td>
          <?
          $teams = new main_teams();
          $teams->getAll();
          print $teams->dropdown("pro_team", "team_id", "team_name", $db_main_projects->get_pro_team());
          ?>
          </td>
    </tr>
    <tr>
      <td>Status</td>
      <td>
        <?
        $dd = new utils();
        $dd->renderActivation("pro_status", $db_main_projects->get_pro_status());
        ?>
        </td>
    </tr>
    <tr>
      <td> </td>
      <td>
<?
        $form_name = "do_main_projects";
        include("bottom.edition.php")
        ?>
      <input name="do" type="hidden" id="do" value="<?=$_GET["do"]?>_exec">
      <input name="id" type="hidden" id="id" value="<?=$_GET["id"]?>">
      <input name="val_varchar" type="hidden" id="val_varchar" value="pro_name,">
      <input name="val_int" type="hidden" id="val_int" value="pro_status,"></td>
    </tr>
  </table>
</form>
<?
$db_main_projects->close();
?>
<?
// ######################################################################
// Edit Form for main_sprints table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:47
// ClassBuilder classes requires ConDB v.1.1 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_sprints = new main_sprints;
$return = false;
$db_main_sprints->loadParams();
if ($_POST["do"]=="edit_exec")
{
	$db_main_sprints->updateOne($_POST["id"]);
	$return = true;
}
if ($_POST["do"]=="insert_exec")
{
	$db_main_sprints->insertOne();
	$return = true;
}
if ($_POST["do"]=="delete_exec")
{
	$db_main_sprints->deleteOne($_POST["id"]);
	$return = true;
}
if ($return) jsheader("index.php?load=sprints&project=".$_GET["project"]."&team=".$_GET["team"]);
if ($_GET["do"]=="edit" || $_GET["do"]=="delete"){
	$db_main_sprints->getOne($_GET["id"]);
	$db_main_sprints->load();
}
//
$db_main_projects = new main_projects;
$db_main_projects->getOne($_GET["project"]);
$db_main_projects->load();
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=projects">Projects</a> <span class="divider">/</span></li>
          
          <li><a href="#"><?=$db_main_projects->get_pro_name();?></a><span class="divider">/</span></li>
          
          <li><a href="#" class="active">Sprint</a></li>
        </ul>

<script language="javascript" src="js/main.js"></script>
<form action="index.php?load=sprint.do&project=<?=$_GET["project"]?>&team=<?=$_GET["team"]?>" method="post" name="do_main_sprints" id="do_main_sprints" onSubmit="return validate_types(this);">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
    <tr>
      <td>Project</td>
      <td>
        <?
        $project = new main_projects();
        $project->getAll();
        print $project->dropdown("sprint_project", "pro_id", "pro_name", $_GET["project"]);
        ?>
        
        </td>
    </tr>
    <tr>
      <td>Starts</td>
      <td>
        <?
      $date = new utils();
      $date->renderMobileDates("sprint_start", $db_main_sprints->get_sprint_start());
      ?>
        </td>
    </tr>
    <tr>
      <td>Ends</td>
      <td>
        <?
      $date = new utils();
      $date->renderMobileDates("sprint_end", $db_main_sprints->get_sprint_end());
      ?>
        </td>
    </tr>
    <tr>
      <td>Status</td>
      <td>
        <?
      $date = new utils();
      $date->renderActivation("sprint_status", $db_main_sprints->get_sprint_status());
      ?>
        </td>
    </tr>
    <tr>
      <td> </td>
      <td>
<?
        $form_name = "do_main_sprints";
        include("bottom.edition.php")
        ?>
      <input name="do" type="hidden" id="do" value="<?=$_GET["do"]?>_exec">
      <input name="id" type="hidden" id="id" value="<?=$_GET["id"]?>">
      <input name="val_varchar" type="hidden" id="val_varchar" value="">
      <input name="val_int" type="hidden" id="val_int" value="sprint_project,"></td>
    </tr>
  </table>
</form>
<?
$db_main_sprints->close();
?>
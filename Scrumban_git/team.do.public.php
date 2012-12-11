<?
// ######################################################################
// Edit Form for main_teams table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 11:12:12
// ClassBuilder classes requires ConDB v.1.1 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_teams = new main_teams;
$return = false;
$db_main_teams->loadParams();
if ($_POST["do"]=="edit_exec")
{
	$db_main_teams->updateOne($_POST["id"]);
	$return = true;
}
if ($_POST["do"]=="insert_exec")
{
	$db_main_teams->insertOne();
	$return = true;
}
if ($_POST["do"]=="delete_exec")
{
	$db_main_teams->deleteOne($_POST["id"]);
	$return = true;
}
if ($return) jsheader("index.php?load=teams");
if ($_GET["do"]=="edit" || $_GET["do"]=="delete"){
	$db_main_teams->getOne($_GET["id"]);
	$db_main_teams->load();
}
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=users">Teams</a> <span class="divider">/</span></li>
          <li><a href="#" class="active"><?=$db_main_teams->get_team_name();?></a></li>
          
        </ul>

<script language="javascript" src="js/main.js"></script>
<form action="index.php?load=team.do" method="post" name="do_main_teams" id="do_main_teams" onSubmit="return validate_types(this);">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
    <tr>
      <td>Name</td>
      <td><input name="team_name" type="text" id="team_name" value="<?=$db_main_teams->get_team_name();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td> </td>
      <td>
<?
        $form_name = "do_main_teams";
        include("bottom.edition.php")
        ?>
        
        
        
      <input name="do" type="hidden" id="do" value="<?=$_GET["do"]?>_exec">
      <input name="id" type="hidden" id="id" value="<?=$_GET["id"]?>">
      <input name="val_varchar" type="hidden" id="val_varchar" value="team_name,">
      <input name="val_int" type="hidden" id="val_int" value=""></td>
    </tr>
  </table>
</form>
<?
$db_main_teams->close();
?>
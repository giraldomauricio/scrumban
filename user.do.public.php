<?
// ######################################################################
// Edit Form for main_users table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 11:12:12
// ClassBuilder classes requires ConDB v.1.1 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_users = new main_users;
$return = false;
$db_main_users->loadParams();
if ($_POST["do"]=="edit_exec")
{
	$db_main_users->updateOne($_POST["id"]);
	$return = true;
}
if ($_POST["do"]=="insert_exec")
{
    $db_main_users->set_use_key($db_main_users->seed("20"));
	$db_main_users->insertOne();
	$return = true;
}
if ($_POST["do"]=="delete_exec")
{
	$db_main_users->deleteOne($_POST["id"]);
	$return = true;
}
if ($return) jsheader("index.php?load=users");
if ($_GET["do"]=="edit" || $_GET["do"]=="delete"){
	$db_main_users->getOne($_GET["id"]);
	$db_main_users->load();
}
if($_GET["sendKey"])
{
  $mail = new sendmail();
  $link = PORTAL_URL."scrum.php?key=".$db_main_users->get_use_key();
  $message = "<strong>Welcome to Scrumban</strong><hr>Your access key is ".$db_main_users->get_use_key()."<hr>Your access link is <a href=\"".$link."\">".$link."</a>";
  $mail->from = PORTAL_MAIL;
  $mail->to = $db_main_users->get_use_email();
  $mail->subject = "Scrumban access key";
  $mail->message($message);
}
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=users">Users</a> <span class="divider">/</span></li>
          <li><a href="#" class="active"><?=$db_main_users->get_use_name();?></a></li>
          
        </ul>

<script language="javascript" src="js/main.js"></script>
<form action="index.php?load=user.do" method="post" name="do_main_users" id="do_main_users" onSubmit="return validate_types(this);">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
    <tr>
      <td>Name</td>
      <td><input name="use_name" type="text" id="use_name" value="<?=$db_main_users->get_use_name();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><input name="use_email" type="text" id="use_email" value="<?=$db_main_users->get_use_email();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td>Team</td>
      <td>
          <?
          $teams = new main_teams();
          $teams->getAll();
          print $teams->dropdown("use_team", "team_id", "team_name", $db_main_users->get_use_team());
          ?>
          </td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="use_password" type="text" id="use_password" value="<?=$db_main_users->get_use_password();?>" maxlength="40"></td>
    </tr>
    <?
        if($_GET["id"])
        {
          ?>
    
    <?
        }
        ?>
    <tr>
      <td>Pushover Key</td>
      <td><input name="use_pushover" type="text" id="use_pushover" value="<?=$db_main_users->get_use_pushover();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td>Key</td>
      <td><a href="index.php?load=user.do&do=edit&id=<?=$_GET["id"]?>&sendKey=true" class="btn btn-info">Send key to user</a></td>
    </tr>
    <tr>
      <td> </td>
      <td>
<?
        $form_name = "do_main_users";
        include("bottom.edition.php")
        ?>
        
        
        
      <input name="do" type="hidden" id="do" value="<?=$_GET["do"]?>_exec">
      <input name="id" type="hidden" id="id" value="<?=$_GET["id"]?>">
      <input name="val_varchar" type="hidden" id="val_varchar" value="use_email,use_password,use_key,use_name,">
      <input name="val_int" type="hidden" id="val_int" value=""></td>
    </tr>
  </table>
</form>
<?
$db_main_users->close();
?>
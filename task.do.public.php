<?
// ######################################################################
// Edit Form for main_tasks table
// Built with ListBuilder by Mauricio Giraldo Mutis
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:25
// ClassBuilder classes requires ConDB v.1.1 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
require "framework.php";
$db_main_tasks = new main_tasks;
$return = false;
$db_main_tasks->loadParams();
if ($_POST["do"]=="edit_exec")
{
	$db_main_tasks->updateOne($_POST["id"]);
        $log = new main_logs();
        $log->trackState($_POST["id"], $_POST["task_state"], $_POST["task_user"]);
	$return = true;
}
if ($_POST["do"]=="insert_exec")
{
	$db_main_tasks->insertOne();
        $id = $db_main_tasks->getLastId();
        $log = new main_logs();
        $log->trackState($id, $_POST["task_state"], $_POST["task_user"]);
	$return = true;
}
if ($_POST["do"]=="delete_exec")
{
	$db_main_tasks->deleteOne($_POST["id"]);
	$return = true;
}
if ($return) jsheader("index.php?load=tasks&project=".$_GET["project"]."&sprint=".$_GET["sprint"]."&team=".$_GET["team"]);
if ($_GET["do"]=="edit" || $_GET["do"]=="delete"){
	$db_main_tasks->getOne($_GET["id"]);
	$db_main_tasks->load();
}
$dd = new utils();
//
$db_main_projects = new main_projects;
$db_main_projects->getOne($_GET["project"]);
$db_main_projects->load();
?>

<ul class="breadcrumb">
          <li><a href="index.php?load=projects&team=<?=$_GET["team"]?>">Projects</a> <span class="divider">/</span></li>
          
          <li><a href="#"><?=$db_main_projects->get_pro_name();?></a><span class="divider">/</span></li>
          
          <li><a href="#" class="active">Task</a></li>
        </ul>


<script language="javascript" src="js/main.js"></script>
<form action="index.php?load=task.do&project=<?=$_GET["project"]?>&sprint=<?=$_GET["sprint"]?>&team=<?=$_GET["team"]?>" method="post" name="do_main_tasks" id="do_main_tasks" onSubmit="return validate_types(this);">
  <table width="100%"  border="0" cellspacing="1" cellpadding="1" class="table table-striped table-bordered">
    <tr>
      <td>Project</td>
      <td>
        <?
        $project = new main_projects();
        $project->getAll();
        print $project->dropdown("task_project", "pro_id", "pro_name", $_GET["project"]);
        ?>
        
        </td>
    </tr>
    <tr>
      <td>Sprint</td>
      <td>
        <?
        $dd->custom = array();
        $sprints = new main_sprints();
        $sprints->getProjectSprints($_GET["project"]);
        while ($sprints->load())
        {
          $dd->custom[$sprints->get_sprint_id()] = $sprints->usformatdate($sprints->get_sprint_start())." to ".$sprints->usformatdate($sprints->get_sprint_end());
        }
        $dd->renderCustom("task_sprint", $db_main_tasks->get_task_sprint());
        ?>
        
        </td>
    </tr>
    <tr>
      <td>Title</td>
      <td><input name="task_title" type="text" id="task_title" value="<?=$db_main_tasks->get_task_title();?>" maxlength="100"></td>
    </tr>
    <tr>
      <td>Detail</td>
      <td><textarea name="task_detail" type="text" id="task_detail"><?=$db_main_tasks->get_task_detail();?></textarea></td>
    </tr>
    <tr>
      <td>User</td>
      <td>
        <?
        $users = new main_users();
        $users->getAll();
        print $users->dropdown("task_user", "use_id", "use_name", $db_main_tasks->get_task_user());
        ?>
        </td>
    </tr>
    <tr>
      <td>Status</td>
      <td>
        <?
        $dd->custom = array(0 => "Backlog", 1=>"WIP", 2=>"Done");
        $dd->renderCustom("task_state", $db_main_tasks->get_task_state());
        ?>
        </td>
    </tr>
    <tr>
      <td>Units</td>
      <td><input name="task_units" type="text" id="task_units" value="<?=$db_main_tasks->get_task_units();?>" maxlength="9"></td>
    </tr>
    
    <tr>
      <td>GitHub Issue</td>
      <td><input type="checkbox" id="github_issue" name="github_issue" <? if($db_main_tasks->get_task_github_issue() != "") print "checked=\"checked\"";?>> <?=$db_main_tasks->get_task_github_issue();?></td>
    </tr>
    
    <tr>
      <td> </td>
      <td>
<?
        $form_name = "do_main_tasks";
        include("bottom.edition.php")
        ?>
      <input name="do" type="hidden" id="do" value="<?=$_GET["do"]?>_exec">
      <input name="id" type="hidden" id="id" value="<?=$_GET["id"]?>">
      <input name="val_varchar" type="hidden" id="val_varchar" value="task_title,">
      <input name="val_int" type="hidden" id="val_int" value="task_project,task_sprint,task_user,task_state,task_units,"></td>
    </tr>
  </table>
</form>
<?
$db_main_tasks->close();
?>
<?
// Actions
$tasks = new main_tasks();
if($_GET["release"])
{
  $tasks->autoRelease($_GET["release"]);
}
if($_GET["finish"])
{
  $tasks->autoFinish($_GET["finish"]);
}
if($_GET["wip"])
{
  $tasks->autoWip($_GET["wip"]);
}
// Display
$tasks = new main_tasks();
$sprint = new main_sprints();
$status = $sprint->getVelocity();
$projects = new main_projects();
$projects->getActiveProjects($_GET["team"]);
$teamName = " All Teams";
if($_GET["team"]){
    $team = new main_teams();
    $team->getOne($_GET["team"]);
    $team->load();
    $teamName = "Team ".$team->get_team_name();
}
?>
<div class="alert alert-success"><h4><?=$teamName?> : Sprint <?=$status["sprint"]?> <a href="<?=  str_replace("load=sprint.print", "load=sprint", $_SERVER["REQUEST_URI"])?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i> View edit version</a></h4></div>
<div class="row">
  <div class="span4"><h2>Backlog</h2></div>
  <div class="span4"><h2>WIP</h2></div>
  <div class="span4"><h2>Done</h2></div>
</div>

<?
while($projects->load())
{
?>

<div class="row">
  
  <div class="span4">
    <?
    $tasks->getSprintTasks(0,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-block">
        <h5><i class="icon-list"></i> <?=$projects->get_pro_name()?></h5>
        <h4><i class="icon-tasks"></i> <?=$tasks->get_task_title()?></h4>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      
    </div>
    <?
    }
    ?>
  </div>
  
  <div class="span4">
    <?
    $tasks->getSprintTasks(1,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-info">
      <h5><i class="icon-list"></i> <?=$projects->get_pro_name()?></h5>
        <h4><i class="icon-tasks"></i> <?=$tasks->get_task_title()?></h4>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      
    </div>
    <?
    }
    ?>
  </div>
  
  <div class="span4">
    <?
    $tasks->getSprintTasks(2,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-success">
      <h5><i class="icon-list"></i> <?=$projects->get_pro_name()?></h5>
        <h4><i class="icon-tasks"></i> <?=$tasks->get_task_title()?></h4>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      
    </div>
    <?
    }
    ?>
  </div>
  
</div>
<hr />
<?
}
?>
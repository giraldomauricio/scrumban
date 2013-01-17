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
if($_GET["move"] && $_GET["to"])
{
  $tasks->moveToSprint($_GET["move"],$_GET["to"]);
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
<div class="alert alert-success"><h4><?=$teamName?> : Sprint <?=$status["sprint"]?> <a href="<?=  str_replace("load=sprint", "load=sprint.print", $_SERVER["REQUEST_URI"])?>" class="btn btn-small btn-info"><i class="icon-print icon-white"></i> View print version</a></h4></div>
<div class="row">
  <div class="span3"><h2>Project</h2></div>
  <div class="span3"><h2>Backlog</h2></div>
  <div class="span3"><h2>WIP</h2></div>
  <div class="span3"><h2>Done</h2></div>
</div>

<?
while($projects->load())
{
?>

<div class="row">
  <div class="span3"><h3><?=$projects->get_pro_name()?></h3>
      <a href="index.php?load=task.do&do=insert&project=<?=$projects->get_pro_id()?>&sprint=&team=<?=$_GET["team"]?>" class="btn btn-info">Add task</a>
  </div>
  <div class="span3">
    <?
    $tasks->getSprintTasks(0,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-block">
        <h5><a href="index.php?load=task.do&do=edit&id=<?=$tasks->get_task_id()?>&project=<?=$tasks->get_task_project()?>&sprint=<?=$tasks->get_task_sprint()?>&team=<?=$tasks->get_use_team()?>" class="btn btn-small btn-small"><i class="icon-edit"></i></a> <?=$tasks->get_task_title()?></h5>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      
      <div>
      <!--Sprint change-->
      <div class="btn-group">
          
          <a href="index.php?load=sprint&wip=<?=$tasks->get_task_id()?>&team=<?=$_GET["team"]?>&project=<?=$_GET["project"]?>" class="btn btn-small btn-info">Move to WIP</a>
          
                <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">Transfer<span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <?
                    $db_main_sprints = new main_sprints();
                    $db_main_sprints->getProjectSprints($projects->get_pro_id());
                    while($db_main_sprints->load()){
                  ?>
                  <li><a href="index.php?load=sprint&team=<?=$_GET["team"]?>&move=<?=$tasks->get_task_id()?>&to=<?=$db_main_sprints->get_sprint_id()?>"><?=$db_main_sprints->get_sprint_start()?>-<?=$db_main_sprints->get_sprint_end()?></a></li>
                  <?
                    }
                  ?>
                </ul>
              </div>
      <!--Sprint change-->
    </div>
    </div>
    <?
    }
    ?>
  </div>
  
  <div class="span3">
    <?
    $tasks->getSprintTasks(1,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-info">
      <h5><a href="index.php?load=task.do&do=edit&id=<?=$tasks->get_task_id()?>&project=<?=$tasks->get_task_project()?>&sprint=<?=$tasks->get_task_sprint()?>&team=<?=$tasks->get_use_team()?>" class="btn btn-small btn-small"><i class="icon-edit"></i></a> <?=$tasks->get_task_title()?></h5>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      <div class="btn-group">
          <a href="index.php?load=sprint&release=<?=$tasks->get_task_id()?>&team=<?=$_GET["team"]?>&project=<?=$_GET["project"]?>" class="btn btn-small btn-warning">Move to backlog</a>
          
          <a href="index.php?load=sprint&finish=<?=$tasks->get_task_id()?>&team=<?=$_GET["team"]?>&project=<?=$_GET["project"]?>" class="btn btn-small btn-success">Done</a>
      
          <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">Transfer<span class="caret"></span></button>
                <ul class="dropdown-menu">
                  <?
                    $db_main_sprints = new main_sprints();
                    $db_main_sprints->getProjectSprints($projects->get_pro_id());
                    while($db_main_sprints->load()){
                  ?>
                  <li><a href="index.php?load=sprint&team=<?=$_GET["team"]?>&move=<?=$tasks->get_task_id()?>&to=<?=$db_main_sprints->get_sprint_id()?>"><?=$db_main_sprints->get_sprint_start()?>-<?=$db_main_sprints->get_sprint_end()?></a></li>
                  <?
                    }
                  ?>
                </ul>
          
      </div>
    </div>
    <?
    }
    ?>
  </div>
  
  <div class="span3">
    <?
    $tasks->getSprintTasks(2,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="alert alert-success">
      <h5><a href="index.php?load=task.do&do=edit&id=<?=$tasks->get_task_id()?>&project=<?=$tasks->get_task_project()?>&sprint=<?=$tasks->get_task_sprint()?>&team=<?=$tasks->get_use_team()?>" class="btn btn-small btn-small"><i class="icon-edit"></i></a> <?=$tasks->get_task_title()?></h5>
      <?=$tasks->get_task_detail()?>
      <blockquote><i class="icon-time"></i> <?=$tasks->get_task_units()?><br/><i class="icon-user"></i><?=$tasks->get_use_name()?><br/><i class="icon-calendar"></i><?=$tasks->usformatdate($tasks->get_last_modification())?></blockquote>
      <div class="btn-group"><a href="index.php?load=sprint&wip=<?=$tasks->get_task_id()?>&team=<?=$_GET["team"]?>&project=<?=$_GET["project"]?>" class="btn btn-small btn-danger">Move to WIP</a></div>
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
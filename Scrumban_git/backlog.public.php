<?
$tasks = new main_tasks();
if($_GET["assign"])
{
  $tasks->autoAssign($_GET["assign"]);
}
$sprint = new main_sprints();
$status = $sprint->getVelocity();
$projects = new main_projects();
$projects->getActiveProjects();
?>
<div class="well well-small"><h3>Sprint <?=$status["sprint"]?> (<?=$status["velocity"]?>)</h3></div>
<div class="row">
  <div class="span4"><h2>Backlog (<?=$status["backlog"]?>)</h2></div>
</div>
<?
while($projects->load())
{
?>
<div class="row">
  
  <div class="span4 well well-small">
    <h3><?=$projects->get_pro_name()?></h3>
    <?
    $tasks->getSprintTasks(0,$projects->get_pro_id());
    while($tasks->load())
    {
    ?>
    <div class="well well-small">
      <h4><?=$tasks->get_task_title()?> <i class="icon-time"></i> <?=$tasks->get_task_units()?></h4>
      <p><?=$tasks->get_task_detail()?></p>
      <a href="scrum.php?load=backlog&assign=<?=$tasks->get_task_id()?>" class="btn btn-large btn-warning">Assign to me</a>
    </div>
    <?
    }
    ?>
  </div>
  
</div>
<?
}
?>
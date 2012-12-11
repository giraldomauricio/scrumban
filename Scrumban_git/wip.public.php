<?
$tasks = new main_tasks();
if($_GET["release"])
{
  $tasks->autoRelease($_GET["release"]);
}
if($_GET["finish"])
{
  $tasks->autoFinish($_GET["finish"]);
}
$sprint = new main_sprints();
$status = $sprint->getVelocity();
?>
<div class="well well-small"><h3>Sprint <?=$status["sprint"]?> (<?=$status["velocity"]?>)</h3></div>
<div class="row">
  <div class="span4"><h2>WIP</h2></div>
</div>

<div class="row">
  <div class="span4">
    <?
    $tasks->getUserTasks();
    while($tasks->load())
    {
    ?>
    <div class="well well-small">
      <h4><?=$tasks->get_task_title()?> <i class="icon-time"></i> <?=$tasks->get_task_units()?></h4>
      <p><?=$tasks->get_task_detail()?></p>
      <a href="scrum.php?load=wip&release=<?=$tasks->get_task_id()?>" class="btn btn-large btn-danger">Move to Backlog</a>
      <a href="scrum.php?load=wip&finish=<?=$tasks->get_task_id()?>" class="btn btn-large btn-success">Done!</a>
    </div>
    <?
    }
    ?>
  </div>
  
</div>
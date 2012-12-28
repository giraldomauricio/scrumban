<?
// START CORE CLASS
// To allow future updates, do not change the code between the 
// START and END CORE lines
// ######################################################################
// class for main_tasks table
// Built with ClassBuilder by Mauricio Giraldo Mutis <me@bymurdock.com>
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:17
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
class main_tasks extends conDb{
	var $task_id;
	var $task_project;
	var $task_sprint;
	var $task_user;
	var $task_state;
	var $task_units;
	var $task_title;
	var $task_detail;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_tasks";
	var $idName = "task_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
    
    public function getAllByProject($project)
    {
      $this->sql = "SELECT * FROM main_tasks, main_sprints, main_users WHERE use_id = task_user AND task_sprint = sprint_id AND task_project = ".$project;
      $this->query();
    }
    
    public function getAllBySprint($sprint)
    {
      $this->sql = "SELECT * FROM main_tasks, main_sprints, main_users WHERE use_id = task_user AND task_sprint = sprint_id AND task_sprint = ".$sprint;
      $this->query();
    }
    
    public function getSprintTasks($status,$project)
    {
      $this->sql = "SELECT *, (SELECT log_date FROM main_logs WHERE log_task = task_id ORDER BY log_id ASC LIMIT 0,1) as last_modification FROM main_tasks, main_sprints, main_users WHERE use_id = task_user AND task_sprint = sprint_id AND sprint_status = 1 AND task_state = ".$status." AND task_project = ".$project;
      $this->query();
    }
    
    public function getUserTasks()
    {
      $this->sql = "SELECT * FROM main_tasks, main_users WHERE use_id = task_user AND task_state = 1 AND use_key = '".$_SESSION["key"]."'";
      $this->query();
    }
    
    public function getBacklog()
    {
      $this->sql = "SELECT * FROM main_tasks, main_users WHERE use_id = task_user AND sprint_status = 1 AND task_state = 0";
      $this->query();
    }
    
    public function autoAssign($task)
    {
      $user = new main_users();
      $user->getUserByKey($_SESSION["key"]);
      $this->sql = "UPDATE main_tasks SET task_user = ".$user->get_use_id().", task_state = 1 WHERE task_id = ".$task;
      if($user->get_use_pushover() != "")
      {
          $push = new pushover();
          $push->key = $user->get_use_pushover();
          $push->message = "New task assigned.";
          $push->push();
      }
      $this->query();
      // Log
      $log = new main_logs();
      $log->trackState($task, 1);
      
    }
    
    public function autoRelease($task)
    {
      $this->sql = "UPDATE main_tasks SET task_user = 1, task_state = 0 WHERE task_id = ".$task;
      $this->query();
      // Log
      $log = new main_logs();
      $log->trackState($task, 0);
      $push = new pushover();
      $push->notifyLeader($task, "Task moved to backlog");
    }
    
    public function autoFinish($task)
    {
      $this->sql = "UPDATE main_tasks SET task_state = 2 WHERE task_id = ".$task;
      $this->query();
      // Log
      $log = new main_logs();
      $log->trackState($task, 2);
      $push = new pushover();
      $push->notifyLeader($task, "Task finished");
    }
    
    public function autoWip($task)
    {
      $this->sql = "UPDATE main_tasks SET task_state = 1 WHERE task_id = ".$task;
      $this->query();
      // Log
      $log = new main_logs();
      $log->trackState($task, 1);
      $push = new pushover();
      $push->notifyLeader($task, "Task moved to WIP");
    }
}
?>
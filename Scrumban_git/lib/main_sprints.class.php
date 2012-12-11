<?
// START CORE CLASS
// To allow future updates, do not change the code between the 
// START and END CORE lines
// ######################################################################
// class for main_sprints table
// Built with ClassBuilder by Mauricio Giraldo Mutis <me@bymurdock.com>
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:59
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
class main_sprints extends conDb{
	var $sprint_id;
	var $sprint_project;
	var $sprint_start;
	var $sprint_end;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_sprints";
	var $idName = "sprint_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
    
    public function getProjectSprints($project)
    {
      $this->sql = "SELECT * FROM main_sprints WHERE sprint_project = ".$project;
      
      $this->query();
    }
    
    public function getVelocity()
    {
      
      $this->sql = "SELECT *, (SELECT SUM(task_units) FROM main_tasks WHERE task_sprint = sprint_id) AS velocity, (SELECT SUM(task_units) FROM main_tasks WHERE task_state = 0 AND task_sprint = sprint_id) AS backlog, (SELECT SUM(task_units) FROM main_tasks WHERE task_state = 1 AND task_sprint = sprint_id) AS wip, (SELECT SUM(task_units) FROM main_tasks WHERE task_state = 2 AND task_sprint = sprint_id) AS done FROM main_sprints WHERE sprint_status = 1";
      $this->query();
      $this->load();
      $result = array("sprint" => $this->get_sprint_start()." to ".$this->get_sprint_end() , "velocity" => $this->field->velocity, "backlog" => $this->field->backlog , "wip" => $this->field->wip , "done" => $this->field->done);
      return $result;
    }
}
?>
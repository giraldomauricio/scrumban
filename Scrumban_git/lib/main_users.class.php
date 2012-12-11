<?
// START CORE CLASS
// To allow future updates, do not change the code between the 
// START and END CORE lines
// ######################################################################
// class for main_users table
// Built with ClassBuilder by Mauricio Giraldo Mutis <me@bymurdock.com>
// http://www.bymurdock.com
// This class was built on: 12/03/2012 11:12:59
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
class main_users extends conDb{
	var $use_id;
	var $use_email;
	var $use_password;
	var $use_key;
	var $use_name;
        var $use_team;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_users";
	var $idName = "use_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
    
    public function getUserByKey()
    {
      $this->sql = "SELECT * FROM main_users WHERE use_key = '".$_SESSION["key"]."'";
      $this->query();
      $this->load();
      $_SESSION["name"] = $this->get_use_name();
    }
    
    public function getAllUsers()
    {
        $this->sql = "SELECT *, (SELECT COUNT(*) FROM main_tasks WHERE task_user = use_id AND task_state = 1) AS wip_tasks, (SELECT SUM(task_units) FROM main_tasks WHERE task_user = use_id AND task_state = 1) AS wip_load FROM main_users, main_teams WHERE use_team = team_id";
        $this->query();
    }
}
?>
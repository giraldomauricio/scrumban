<?
// START CORE CLASS
// To allow future updates, do not change the code between the 
// START and END CORE lines
// ######################################################################
// class for main_projects table
// Built with ClassBuilder by Mauricio Giraldo Mutis <me@bymurdock.com>
// http://www.bymurdock.com
// This class was built on: 12/03/2012 10:12:44
// ClassBuilder classes requires ConDB v.2.0 or later
// Class builder is Open Source, but for copyright issues, please keep
// this copy on any class that uses it.
// (R) 2005-2012
// ######################################################################
class main_projects extends conDb{
	var $pro_id;
	var $pro_name;
	var $pro_status;
        var $pro_team;
        var $pro_github_repo;
        var $pro_github_user;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_projects";
	var $idName = "pro_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
    
    public function getActiveProjects($team = 0)
    {
      $this->sql = "SELECT * FROM main_projects WHERE pro_status = 1";
      if($team) $this->sql .= " AND pro_team = ".$team;
      $this->query();
    }
    
    public function getAllProjects($team=0)
    {
      $this->sql = "SELECT * FROM main_projects, main_teams WHERE pro_team = team_id";
      if($team) $this->sql .= " AND team_id = ".$team;
      $this->query();
    }
}
?>
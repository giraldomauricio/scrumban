<?php

class main_teams extends conDb{
	var $team_id;
	var $team_name;
        var $team_leader;
        var $team_notify;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_teams";
	var $idName = "team_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
        
        public function getAllTeams()
        {
            $this->sql = "SELECT * from main_teams, main_users WHERE team_leader = use_id";
            $this->query();
        }
}
?>
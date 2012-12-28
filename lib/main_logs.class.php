<?php

class main_logs extends conDb{
	var $log_id;
	var $log_task;
	var $log_user;
	var $log_state;
	var $log_date;
	// ######################################################################
	// Class specific variables
	// ######################################################################
	var $tableName = "main_logs";
	var $idName = "log_id";
	// ######################################################################
	// User defined functions
	// ######################################################################
	// END CORE CLASS
	// Use the next lines to insert your own functions
    
    public function trackState($task, $state, $userId = 1)
    {
        $this->set_log_date(date("Y-m-d"));
        $this->set_log_state($state);
        $this->set_log_task($task);
        if($userId == 1)
        {
            $user = new main_users();
            $user->getUserByKey();
            $this->set_log_user($user->get_use_id());
        }
        else $this->set_log_user($userId);
        $this->insertOne();
    }
}
?>

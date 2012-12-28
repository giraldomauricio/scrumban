<?php

/**
 * Library to push messages to Pushover devices
 *
 * @author mgiraldo
 */
class pushover extends conDb{

    var $url = "https://api.pushover.net/1/messages.json";
    var $token = "7WWQ8VQUB5ZJa9ZLW9uUIB2ehm41m1";
    var $key;
    var $message;

    public function send() {
        print "Sending...";
        curl_setopt_array($ch = curl_init(), array(CURLOPT_URL => $this->url, CURLOPT_POSTFIELDS => array("token" => $this->token, "user" => $this->key, "message" => $this->message)));
        curl_exec($ch);
        curl_close($ch);
        print_r(error_get_last());
    }

    public function push() {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $this->url);
        curl_setopt($c, CURLOPT_HEADER, false);
        /*
          if possible, set CURLOPT_SSL_VERIFYPEER to true..
          - http://www.tehuber.com/phps/cabundlegen.phps
         */
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, array(
            'token' => $this->token,
            'user' => $this->key,
            'title' => "Scrumban",
            'message' => $this->message
        ));

        $response = curl_exec($c);
        $xml = simplexml_load_string($response);

        return ($xml->status == 1) ? true : false;
    }
    
    public function notifyLeader($task,$message)
    {
        $this->sql = "SELECT * FROM main_users, main_teams, main_projects, main_tasks WHERE task_project = pro_id AND pro_team = team_id AND team_leader = use_id AND task_id = ".$task;
        $this->query();
        $this->load();
        if($this->get_use_pushover() && $this->get_team_notify())
        {
            $this->key = $this->get_use_pushover();
            $this->message = $this->get_pro_name().":".$this->get_task_title().":".$message;
            $this->push();
        }
    }
}

?>

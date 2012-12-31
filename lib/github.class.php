<?php

/**
 * Library to support basic GitHub API commands using curl
 *
 * @author mgiraldo
 * @uses:
 * $git = new github();
   $git->owner = "owner";
   $git->repo = "respository_name";
   $git->getIssues();
   print_r($git->obj);
 */


class github {

    var $version = 3;
    var $owner = "";
    var $repo = "";
    var $uri = "https://api.github.com/";
    var $app = "repos/";
    var $action = "";
    var $obj;
    var $raw;

    public function github($owner, $repo) {
        $this->owner = $owner;
        $this->repo = $repo;
    }

    // Load Json result into the object
    // Uses curl in order to avoid ssl wrapper problems
    private function loadJson() {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $this->uri.$this->app.$this->owner."/".$this->repo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "/".$this->action);
        $this->raw = curl_exec($ch);
        $this->obj = json_decode($this->raw);
        curl_close($ch);
    }

    public function getIssues() {
        $this->action = "issues";
        $this->loadJson();
    }

}

?>

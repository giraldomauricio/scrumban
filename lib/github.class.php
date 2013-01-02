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
    var $git = "https://github.com/";
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
        curl_setopt($ch, CURLOPT_URL, $this->uri . $this->app . $this->owner . "/" . $this->repo);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "/" . $this->action);
        $this->raw = curl_exec($ch);
        $this->obj = json_decode($this->raw);
        curl_close($ch);
    }

    public function downloadRepository($branch) {

        $url = $this->git . $this->owner . "/" . $this->repo . "/archive/" . $branch . ".zip";

        $path1 = ROOT . "git_repos/" . $branch . ".zip";

        //$url  = 'https://github.com/giraldomauricio/scrumban/archive/master.zip';
        
        
        
        $path = '/home/bionet/www/scrumban/git_repos/test3.zip';
        
        print $path1."<br />";
        print $path."<br />";
        
        $fp = fopen($path, 'w');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FILE, $fp);

        $data = curl_exec($ch);

        curl_close($ch);
        fclose($fp);

        print_r(error_get_last());
    }

    public function getIssues() {
        $this->action = "issues";
        $this->loadJson();
    }

}

?>

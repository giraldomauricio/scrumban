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
    var $url = "";
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
        if ($this->url == "")
            $this->url = $this->uri . $this->app . $this->owner . "/" . $this->repo;
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        if ($this->action != "")
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

        print $path1 . "<br />";
        print $path . "<br />";

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

        $sha = $this->loadLastCommitSha();

        print "Saving to ".$sha."<br />";
        
        $zip = new ZipArchive;
        $res = $zip->open($path);
        if ($res === TRUE) {
            print "Extracting to ".$sha."<br />";
            $zip->extractTo("/home/bionet/www/scrumban/git_repos/".$sha);
            $zip->close();
            $dir = dir("/home/bionet/www/scrumban/git_repos/".$sha);
            $branch = "";
            while (($file = $dir->read())) {
                if (substr($file, 0, 1) != ".") {
                    $branch = $file;
                    break;
                }
            }
            if($branch != "")
            {
                print "Moving ".$branch." to ".$sha."<br />";
                rename("/home/bionet/www/scrumban/git_repos/".$sha."/".$branch, "/home/bionet/www/scrumban/".$sha);
                
                $filename = "/home/bionet/www/scrumban/shaversion.php";
                $shaversion = "<"."? $"."version = \"".$sha."\";?".">";
                $handle = fopen($filename, "w");
                fwrite($handle, $shaversion);
                print "New version written <br />";
            }
            
        } else {
            echo 'doh!';
        }


        print_r(error_get_last());
    }

    public function getIssues() {
        $this->action = "issues";
        $this->loadJson();
    }

    public function loadLastCommitSha() {
        $this->url = $this->uri . "repos/" . $this->owner . "/" . $this->repo . "/commits";
        $this->loadJson();
        return $this->obj[0]->sha;
    }

}

?>

<?php

class zipMaker {

    var $files = array();
    var $zip_name = "";
    var $mode = "terminal";

    function zip() {
        return true;
    }

    function compress() {
        logFactory::log($this, "Using " . $this->mode);
        global $upload_folder, $zip_folder;
        if ($this->mode == "terminal") {
            $res = array();
            $command = "zip " . $zip_folder . $this->zip_name . " " . implode(" ", $this->files);
            exec($command, $res);
            logFactory::log($this, $command);
            logFactory::log($this, implode(",", $res));
        } else {
            $zip = new ZipArchive();
            $filename = $zip_folder . $this->zip_name;
            if ($zip->open($filename, ZIPARCHIVE::CREATE) == TRUE) {
                foreach ($this->files as $file) {
                    $zip->addFile($upload_folder . $file);
                }
                $zip->close();
            }
        }
    }

}

?>
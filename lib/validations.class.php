<?php

/**
 * Class to create JavaScript validations
 *
 * @author mgiraldo
 */
class validations {

    var $fields = array();
    var $formName = "";
    var $functionName = "validator_";
    var $formCall = "";
    var $html = "";
    var $randomizerLimit = 10;

    public function validations($formName = "") {
        $this->formName = $formName;
        $result = "";
        $haystack = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIOPQRSTUVWXYZ0123456789";
        for ($i = 1; $i <= $this->randomizerLimit; $i++) {
            $result .= substr($haystack, rand(0, strlen($haystack)), 1);
        }
        $this->functionName .= $result;
        if ($this->formName == "") {
            $this->formCall = " onSubmit=\"return " . $this->functionName . "(this);\"";
        } else {
            $this->formCall = " onSubmit=\"return " . $this->functionName . "();\"";
        }
    }

    public function basicValidations() {
        $this->html .= "<script>\n";
        if ($this->formName == "") {
            $this->html .= "function " . $this->functionName . "(form){\n";
        } else {
            $this->html .= "function " . $this->functionName . "(){\n";
            $this->html .= "\t var form = document.getElementById(\"" . $this->formName . "\");\n";
        }
        $this->html .= "\t var err = \"\";\n";
        foreach ($this->fields as $key => $value) {
            $this->html .= "\t if(form." . $key . ".value == \"\") err += \"" . $value . "\\n\"".";\n";
        }
        $this->html .= "\t if(err != \"\"){\n";
        $this->html .= "\t\t alert(err);\n";
        $this->html .= "\t\t return false;\n";
        $this->html .= "\t }\n";
        $this->html .= "\t else{\n";
        $this->html .= "\t\t return true;\n";
        $this->html .= "\t }\n";
        $this->html .= "}\n";
        $this->html .= "</script>\n";
    }

}

?>

<?php

/**
 * @author Mauricio Giraldo
 * @desc PHPExcelerator 3.1
 * @desc This class connects and manages the database functions
 * @desc Compatibility: MySQL
 * @version 1.1 03/09/2010
 * This code is protected and cannot be used without authors permission
 * @token: 987458027349830498=02385-98345-9083490687=90586586-89-50986-095460
 * @authorizes: DMR
 */
class conDb {

    var $dbserver = "";
    var $dbusername = "";
    var $dbpassword = "";
    var $dbname = "";
    var $recordCount = 0;
    var $RES = "";
    var $ID = "";
    var $lastID = "";
    var $field = "";
    var $data = array();
    var $sql = "";
    var $tableName = "";
    var $idName = "";
    var $searchFields = array();
    var $onChange = "";

    /**
     * @author Mauricio Giraldo
     * @desc Object constructor
     * @version 1.0 03/05/2010
     * @param None
     * @return Boolean
     */
    function __construct() {
        global $dbserver, $dbuser, $dbpass, $dbname;
        $this->dbserver = $dbserver;
        $this->dbusername = $dbuser;
        $this->dbpassword = $dbpass;
        $this->dbname = $dbname;
        return $this->connect();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Connects to the database and returns a pointer to the connection
     * @version 1.0 03/05/2010
     * @param None
     * @return Resultset pointer
     */
    public function connect() {
        logFactory::log($this, "Connecting to " . $this->dbusername . "@" . $this->dbserver . "/" . $this->dbname);
        $this->ID = mysql_connect($this->dbserver, $this->dbusername, $this->dbpassword) or logFactory::error($this, mysql_error());
        mysql_select_db($this->dbname) or logFactory::error($this, mysql_error());
    }

    /**
     * @author Mauricio Giraldo
     * @desc Executes a query stores in $sql variable
     * @version 1.0 03/05/2010
     * @param None
     * @return Boolean
     */
    public function query($sql = "") {
        if (!$sql)
            $sql = $this->sql;
        // Validate malicious code is not present:
        if (!strpos(strtolower($sql), "alter") && !strpos(strtolower($sql), "drop") && !strpos(strtolower($sql), "create")) {
            logFactory::log($this, $sql);
            $this->RES = mysql_query($sql) or logFactory::error($this, mysql_error());
            //$this->RES = mysql_query($sql) or print(mysql_error().":".$sql);
            $cache = new cache();
            if($$_POST["do"]=="insert_exec" && $_POST["do"]!="insert_exec" && $_POST["do"]!="edit_exec") $cache->clear ();
            return true;
        }
        else
            return false;
    }

    /**
     * @author Mauricio Giraldo
     * @desc Returns the last ID of the inserted value
     * @version 1.0 03/05/2010
     * @param None
     * @return Last ID
     */
    public function getLastId() {
        $this->last_id = mysql_insert_id();
        return $this->last_id;
    }

    /**
     * @author Mauricio Giraldo
     * @desc Returns the number of records of the query
     * @version 1.0 03/05/2010
     * @param None
     * @return Last ID
     */
    public function lines() {
        //$this->filas = mysql_num_rows($this->RES) or die(mysql_error());
        $this->recordCount = mysql_num_rows($this->RES) or print(mysql_error());
        return $this->recordCount;
    }

    /**
     * @author Mauricio Giraldo
     * @desc Returns the number of affected records by the query
     * @version 1.0 07/15/2010
     * @return count of affected rows
     */
    public function affected() {
        return mysql_affected_rows($this->RES);
    }

    /**
     * @author Mauricio Giraldo
     * @desc Returns the number of records of the query
     * @version 1.0 03/05/2010
     * @param None
     * @return Last ID
     */
    public function load() {
        if ($this->field = mysql_fetch_object($this->RES)) {
            $class_vars = get_class_vars(get_class($this));
            foreach ($class_vars as $name => $value) {
                //$$name = $this->field->$name;
            }
            return true;
        }
        else
            return false;
    }
    /**
     * @author Mauricio Giraldo
     * @desc Returns and assigns the keys to the properties
     * @version 1.0 16/12/2011
     * @param None
     * @return Last ID
     */
//    public function smartLoad() {
//        if ($this->field = mysql_fetch_object($this->RES)) {
//            $class_vars = get_class_vars(get_class($this));
//            foreach ($class_vars as $name => $value) {
//                if($this->field->$name && $this->$name) $this->$name = $this->field->$name;
//            }
//            return true;
//        }
//        else
//            return false;
//    }

    /**
     * @author Mauricio Giraldo
     * @desc Returns the number of records of the query
     * @version 1.0 03/05/2010
     * @param None
     * @return Last ID
     */
    public function restart() {
        mysql_data_seek($this->RES, 0);
    }

    /**
     * @author Mauricio Giraldo
     * @desc Error management
     * @version 1.0 03/05/2010
     * @param $error The error reported
     * @return NONE
     */
    private function errorLog($error) {
        logFactory::error($this, $error);
    }

    /**
     * @author Mauricio Giraldo
     * @desc Encloses a value correctly and try to remove any malicious code
     * @version 1.0 03/05/2010
     * @param $data the data to process
     * @return $data the processed string
     */
    public function enclose($data) {
        if (is_numeric($data))
            return $data;
        else {
            return "'" . addslashes(htmlentities($data)) . "'";
        }
    }

    /**
     * @author Mauricio Giraldo
     * @desc Frees the mysql pointer
     * @version 1.0 03/05/2010
     * @param None
     * @return None
     */
    function free() {
        @mysql_free_result($this->RES);
        $this->RES = 0;
    }

    /**
     * @author Mauricio Giraldo
     * @desc Closes the connection with the database
     * @version 1.0 03/05/2010
     * @param None
     * @return Last ID
     */
    function close() {
        $this->free();
        mysql_close();
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function gets all POST and GET parameters and initializes the variables
     * @version 1.0 03/05/2010
     * @version 1.1 05/26/2010: optimized using table columns
     * @param None
     * @return Boolean
     */
    function loadParams() {
        // Only capture properties of valid fields
        $this->sql = "SHOW COLUMNS FROM " . $this->tableName;
        $this->query();
        while ($this->field = mysql_fetch_object($this->RES)) {
            //print $this->field->Field."<br />";
          $fieldName = $this->field->Field;
          
            if ($_POST[$this->field->Field] != "") {
                if (is_array($_POST[$this->field->Field]))
                    $this->data[$this->field->Field] = $this->enclose(implode(",", $_POST[$this->field->Field]));
                else
                    $this->data[$this->field->Field] = $this->enclose($_POST[$this->field->Field]);
                $this->$fieldName = $_POST[$this->field->Field];
            }
            else if ($_GET[$this->field->Field] != "") {
                if (is_array($_GET[$this->field->Field]))
                    $this->data[$this->field->Field] = $this->enclose(implode(",", $_GET[$this->field->Field]));
                else
                    $this->data[$this->field->Field] = $this->enclose($_GET[$this->field->Field]);
                $this->$fieldName = $_GET[$this->field->Field];
            }
        }
    }

    /**
     * @author Mauricio Giraldo
     * @desc Insert one record in the database
     * @version 1.0 03/05/2010
     * @param None
     * @return Boolean
     */
    public function insertOne() {
        $d = $this->getInsertValues();
        $this->sql = "INSERT INTO " . $this->tableName . " (" . $d[0] . ") VALUES (" . $d[1] . ")";
        return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Get one record in the database based on the ID passed
     * @version 1.0 05/20/2010
     * @param $mode: Selection mode: default=all, paged
     * @return Boolean
     */
    public function getAll($mode="all") {
        $this->sql = "SELECT * FROM " . $this->tableName;
        if ($mode == "all")
            return $this->query();
        else
            return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Get one record in the database based on the ID passed
     * @version 1.0 03/05/2010
     * @param $id of the record to retrieve
     * @return Boolean
     */
    public function getOne($id) {
        $this->sql = "SELECT * FROM " . $this->tableName . " WHERE " . $this->idName . " = " . $id;
        return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Search for records in the table
     * @version 1.0 03/08/2010
     * @param $keyWord of the record to retrieve
     * @return Resultset pointer
     */
    public function searchTable($keyWord) {
        $search = "";
        foreach ($this - searchFields as $field) {
            $search .= $field . " like '%" . $keyWord . "%' OR";
        }
        $search = substr($search, 0, strlen($search) - 3);
        $this->sql = "SELECT * FROM " . $this->tableName . " WHERE " . $search;
        return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Updates one record in the database
     * @version 1.0 03/05/2010
     * @param $id of the record to update
     * @return Boolean
     */
    public function updateOne($id) {
        $d = $this->getUpdateValues();
        $this->sql = "UPDATE " . $this->tableName . " SET " . $d[0] . " WHERE " . $this->idName . " = " . $id;
        return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc Delete one record in the database
     * @version 1.0 03/05/2010
     * @param $id of the record to delete
     * @return Boolean
     */
    public function deleteOne($id) {
        $d = $this->getInsertValues();
        $this->sql = "DELETE FROM " . $this->tableName . " WHERE " . $this->idName . " = " . $id;
        return $this->query();
    }
	
	/**
     * @author Mauricio Giraldo
     * @desc Delete one record in the database
     * @version 1.0 03/05/2010
     * @param $id of the record to delete
     * @return Boolean
     */
    public function deleteOneLogic($field,$id) {
        $this->sql = "UPDATE " . $this->tableName . " SET " . $field . " = 0 WHERE ". $this->idName . " = " . $id;
        return $this->query();
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function dynamically gets and sets the variables
     * @version 1.1 03/09/2010
     * @param $metod (SET/GET)
     * @param $arguments (Value)
     * @return None
     */
    public function __call($method, $arguments) {

        $prefix = strtolower(substr($method, 0, 4));
        $property = substr($method, 4);
        if (empty($prefix) || empty($property)) {
            //return;
        }

        
        if ($prefix == "get_") {
          if($this->field->$property)
			//if($this->field->$property)
            {
              return trim($this->field->$property);
            }
            else if ($this->$property)
                return trim($this->$property);
            else if ($_POST[$this->$property])
                return trim($_POST[$this->$property]);
            else
                return false;
        }

        if ($prefix == "set_") {
			if($this->field->$property) $this->$property = $arguments[0];
            $this->data[$property] = $this->enclose($arguments[0]);
        }
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function get a value from the database and formats the output
     * @version 1.0 03/05/2010
     * @param $fieldName
     * @param $format (null[default],date,currency)
     * @return field formatted
     */
    function get($fieldName, $format="null") {
        if ($format == "null")
            return $this->field->$fieldName;
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function returns the data keys
     * @version 1.0 03/05/2010
     * @param None
     * @return Array of fields
     */
    private function getDataKeys() {
        return array_keys($this->data);
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function get the values for the select query
     * @version 1.0 03/05/2010
     * @param None
     * @return Array of fields
     */
    public function getSelectValues() {
        $keys = "";
        if ($this->data == null || count($this->data) == 0)
            return "";
        while (list ($key, $val) = each($this->data)) {
            $keys .= " AND " . $key . " = " . $val;
        }
        return array($keys);
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function get the values for the insert query
     * @version 1.0 03/05/2010
     * @param None
     * @return Array of fields
     */
    public function getInsertValues() {
        $keys = "";
        $values = "";
        while (list ($key, $val) = each($this->data)) {
            $keys .= $key . ",";
            $values .= $val . ",";
        }

        return array(substr($keys, 0, -1), substr($values, 0, -1));
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function get the values for the update query
     * @version 1.0 03/05/2010
     * @param None
     * @return Array of fields
     */
    public function getUpdateValues() {
        $sets = "";
        while (list ($key, $val) = each($this->data)) {
            $sets .= $key . " = " . $val . ",";
        }
        return array(substr($sets, 0, -1));
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function converts a database date in a US date
     * @version 1.0 03/05/2010
     * @param $mysqldate date in yyyy-mm-dd format
     * @return String formatted date in mm/dd/yy
     */
    public function usformatdate($mysqldate) {
        $dateA = split("-", $mysqldate);
        $realPDate = mktime(0, 0, 0, $dateA[1], $dateA[2], $dateA[0]);
        return $dateA[1] . "/" . $dateA[2] . "/" . $dateA[0];
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function converts a US date in Database date
     * @version 1.0 03/05/2010
     * @param $usdate the date in mm/dd/yyyy format
     * @return String formatted date in yyyy-mm-dd
     */
    public function mysqlformatdate($usdate) {
        $dateA = split("/", $usdate);
        return $dateA[2] . "-" . $dateA[0] . "-" . $dateA[1];
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function shows a dropdown menu
     * @version 1.0 03/05/2010
     * @param $usdate the date in mm/dd/yyyy format
     * @return String formatted date in yyyy-mm-dd
     */
    public function dropdown($field_name, $id_field, $label_field, $default=0) {
        $validator = 0;
        $res = "";
        $selected = "";
        $res .= "<select name=\"" . $field_name . "\" id=\"" . $field_name . "\"";
        if ($this->onChange != "")
            $res .= " onChange=\"" . $this->onChange . "\"";
        $res .= " >\n";
        $res .= "<option value=\"\">Please select...</option>\n";
        while ($this->load()) {
            $validator++;
            if ($this->field->$id_field == $default)
                $selected = " selected";
            else
                $selected = "";
            $res .= "<option value=\"" . $this->field->$id_field . "\"" . $selected . ">" . $this->field->$label_field . "</option>\n";
        }
        $res .= "</select>\n";
        //if($validator==0) return "No records available.";
        if ($validator == 0)
            return "&nbsp;";
        else
            return $res;
    }

    /**
     * @author Mauricio Giraldo
     * @desc This function generates a random string
     * @version 1.0 08/07/2010
     * @param $size the size of the random string
     * @return String
     */
    function seed($size, $append=false) {
        //var $haystack;
        $result = "";
        $haystack = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNIOPQRSTUVWXYZ0123456789";
        for ($i = 1; $i <= $size; $i++) {
            $result .= substr($haystack, rand(0, strlen($haystack)), 1);
        }
        if ($append)
            $result .= date("Ymdhmi");
        return $result;
    }

    function numericseed($size, $user) {
        $result = "";
        $haystack = "01234567899876543210";
        for ($i = 1; $i <= $size; $i++) {
            $result .= substr($haystack, rand(0, strlen($haystack)), 1);
        }
        $result .= "-" . $user;
        return $result;
    }
    
    public function grid($sql)
    {
        $html = "<table border=\"1\">\n";
        $this->sql = $sql;
        $this->query();
        $html .= "<tr>\n";
        $field_count = mysql_num_fields($this->RES);
        $i = 0;
        while ($i < $field_count)
        {
            $html .= "<td>\n";
            $meta = mysql_fetch_field($this->RES, $i);
            $html .= $meta->name;
            $html .= "</td>\n";
            $i++;
        }
        $i = 0;
        $html .= "</tr>\n";
        while ($this->load())
        {
            $html .= "<tr>\n";
            $i = 0;
            while ($i < $field_count)
            {
                $html .= "<td>\n";
                $meta = mysql_fetch_field($this->RES, $i);
                $field = $meta->name;
                $html .= $this->field->$field;
                $html .= "</td>\n";
                $i++;
            }
            $html .= "</tr>\n";
        }
        $html .= "</table>";
        return $html;
    }
    
    public function typeAhead($table,$field)
    {
      $this->sql = "SELECT DISTINCT(".$field.") FROM ".$table;
      $this->query();
      $values = array();
      while ($this->load())
      {
        array_push($values, "\"".$this->field->$field."\"");
      }
      return "[".implode(",", $values)."]";
    }
	
	public function statusDisplay($status)
	{
		$result = "";
		switch($status)
		{
			case 1: $result = "Active"; break;
			case 0: $result = "Inactive"; break;
			default: $result = "Unknown"; break;
		}
		return $result;
	}

	// Bootstrap specific functions
	
	function BTAlert($message)
	{
		print "<div class=\"alert alert-error\">".$message."</div>";
	}

}

?>
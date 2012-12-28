<?

// This class renders different elements useful in forms

class utils {

  var $months = array("January" => "January", "February" => "February", "March" => "March", "April" => "April", "May" => "May", "June" => "June", "July" => "July", "August" => "August", "September" => "September", "October" => "October", "November" => "November", "December" => "December");
  var $shortMonths = array("Jan" => "Jan", "Feb" => "Feb", "Mar" => "Mar", "Apr" => "Apr", "May" => "May", "Jun" => "Jun", "Jul" => "Jul", "Aug" => "Aug", "Sep" => "Sep", "Oct" => "Oct", "Nov" => "Nov", "Dec" => "Dec");
  var $days = array("Monday" => "Monday", "Tuesday" => "Tuesday", "Wednesday" => "Wednesday", "Thursday" => "Thursday", "Friday" => "Friday", "Saturday" => "Saturday", "Sunday" => "Sunday");
  var $shortDays = array("Mon" => "Mon", "Tue" => "Tue", "Wed" => "Wed", "Thu" => "Thu", "Fri" => "Fri", "Sat" => "Sat", "Sun" => "Sun");
  var $workingdays = array("Monday" => "Monday", "Tuesday" => "Tuesday", "Wednesday" => "Wednesday", "Thursday" => "Thursday", "Friday" => "Friday");
  var $shortWorkingdays = array("Mon" => "Mon", "Tue" => "Tue", "Wed" => "Wed", "Thu" => "Thu", "Fri" => "Fri");
  var $weekDaysOrdered = array("2" => "Mon", "3" => "Tue", "4" => "Wed", "5" => "Thu", "6" => "Fri", "7" => "Sat", "1" => "Sun");
  var $boolean = array("True" => "True", "False" => "False");
  var $yesNo = array(0 => "No", 1 => "Yes");
  var $activation = array(1 => "Active", 0 => "Inactive");
  var $custom = array();
  var $daysOfMonth = array();
  var $minutes = array();
  var $hours = array();
  var $hoursMil = array();
  var $minutesIntervals = 0;
  var $monthsFullDisplay = true;
  var $yearsPast = array();
  var $yearsFuture = array();
  var $yearsPastFuture = array();
  var $maxYear = 1900;
  var $minYear = 1900;
  var $startAgeRestriction = 0;
  var $series = array();
  var $onChange = "";
  var $states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "DC", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", "LA", "ME", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "MD", "MA", "MI", "MN", "MS", "MO", "PA", "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
  var $countries = array(
      "United States",
      "Afghanistan",
      "Albania",
      "Algeria",
      "Andorra",
      "Angola",
      "Antigua and Barbuda",
      "Argentina",
      "Armenia",
      "Australia",
      "Austria",
      "Azerbaijan",
      "Bahamas",
      "Bahrain",
      "Bangladesh",
      "Barbados",
      "Belarus",
      "Belgium",
      "Belize",
      "Benin",
      "Bhutan",
      "Bolivia",
      "Bosnia and Herzegovina",
      "Botswana",
      "Brazil",
      "Brunei",
      "Bulgaria",
      "Burkina Faso",
      "Burundi",
      "Cambodia",
      "Cameroon",
      "Canada",
      "Cape Verde",
      "Central African Republic",
      "Chad",
      "Chile",
      "China",
      "Colombi",
      "Comoros",
      "Congo (Brazzaville)",
      "Congo",
      "Costa Rica",
      "Cote d'Ivoire",
      "Croatia",
      "Cuba",
      "Cyprus",
      "Czech Republic",
      "Denmark",
      "Djibouti",
      "Dominica",
      "Dominican Republic",
      "East Timor (Timor Timur)",
      "Ecuador",
      "Egypt",
      "El Salvador",
      "Equatorial Guinea",
      "Eritrea",
      "Estonia",
      "Ethiopia",
      "Fiji",
      "Finland",
      "France",
      "Gabon",
      "Gambia, The",
      "Georgia",
      "Germany",
      "Ghana",
      "Greece",
      "Grenada",
      "Guatemala",
      "Guinea",
      "Guinea-Bissau",
      "Guyana",
      "Haiti",
      "Honduras",
      "Hungary",
      "Iceland",
      "India",
      "Indonesia",
      "Iran",
      "Iraq",
      "Ireland",
      "Israel",
      "Italy",
      "Jamaica",
      "Japan",
      "Jordan",
      "Kazakhstan",
      "Kenya",
      "Kiribati",
      "Korea, North",
      "Korea, South",
      "Kuwait",
      "Kyrgyzstan",
      "Laos",
      "Latvia",
      "Lebanon",
      "Lesotho",
      "Liberia",
      "Libya",
      "Liechtenstein",
      "Lithuania",
      "Luxembourg",
      "Macedonia",
      "Madagascar",
      "Malawi",
      "Malaysia",
      "Maldives",
      "Mali",
      "Malta",
      "Marshall Islands",
      "Mauritania",
      "Mauritius",
      "Mexico",
      "Micronesia",
      "Moldova",
      "Monaco",
      "Mongolia",
      "Morocco",
      "Mozambique",
      "Myanmar",
      "Namibia",
      "Nauru",
      "Nepa",
      "Netherlands",
      "New Zealand",
      "Nicaragua",
      "Niger",
      "Nigeria",
      "Norway",
      "Oman",
      "Pakistan",
      "Palau",
      "Panama",
      "Papua New Guinea",
      "Paraguay",
      "Peru",
      "Philippines",
      "Poland",
      "Portugal",
      "Qatar",
      "Romania",
      "Russia",
      "Rwanda",
      "Saint Kitts and Nevis",
      "Saint Lucia",
      "Saint Vincent",
      "Samoa",
      "San Marino",
      "Sao Tome and Principe",
      "Saudi Arabia",
      "Senegal",
      "Serbia and Montenegro",
      "Seychelles",
      "Sierra Leone",
      "Singapore",
      "Slovakia",
      "Slovenia",
      "Solomon Islands",
      "Somalia",
      "South Africa",
      "Spain",
      "Sri Lanka",
      "Sudan",
      "Suriname",
      "Swaziland",
      "Sweden",
      "Switzerland",
      "Syria",
      "Taiwan",
      "Tajikistan",
      "Tanzania",
      "Thailand",
      "Togo",
      "Tonga",
      "Trinidad and Tobago",
      "Tunisia",
      "Turkey",
      "Turkmenistan",
      "Tuvalu",
      "Uganda",
      "Ukraine",
      "United Arab Emirates",
      "United Kingdom",
      "Uruguay",
      "Uzbekistan",
      "Vanuatu",
      "Vatican City",
      "Venezuela",
      "Vietnam",
      "Yemen",
      "Zambia",
      "Zimbabwe",
      "Caribbean",
      "Puerto Rico"
  );

  function __construct() {
    $this->maxYear = date("Y") - 100;
    for ($i = 1; $i <= 31; $i++)
      array_push($this->daysOfMonth, $i);
    for ($i = date("Y") - $this->startAgeRestriction; $i >= $this->maxYear; $i--)
      array_push($this->yearsPast, $i);
    for ($i = date("Y"); $i <= date("Y") + 10; $i++)
      array_push($this->yearsFuture, $i);
    for ($i = 0; $i <= 23; $i++)
      $this->hoursMil [sprintf("%02d", $i) . ":00:00"] = sprintf("%02d", $i) . ":00:00";
    for ($i = 0; $i <= 59; $i++)
      array_push($this->minutes, sprintf("%02d", $i) . ":00:00");
    for ($i = 0; $i <= 23; $i++) {
      if ($i < 12)
        array_push($this->hours, sprintf("%02d", $i) . ":00 AM");
      if ($i == 12)
        array_push($this->hours, sprintf("%02d", $i) . ":00 PM");
      if ($i > 12)
        array_push($this->hours, sprintf("%02d", $i - 12) . ":00 PM");
    }
  }

  function dropdown($id, $array, $selected) {
    if ($this->onChange)
      $res = "<select name=\"" . $id . "\" id=\"" . $id . "\" onChange=\"" . $this->onChange . "\">\n";
    else
      $res = "<select name=\"" . $id . "\" id=\"" . $id . "\">\n";
    foreach ($array as $key => $value) {
      if ($selected == $key)
        $res .= "<option value=\"" . $key . "\" selected>" . $value . "</option>\n";
      else
        $res .= "<option value=\"" . $key . "\">" . $value . "</option>\n";
    }
    $res .= "</select>";
    return $res;
  }

  function renderYearsPastFuture($id, $selected=0) {
    for ($i = $this->minYear; $i <= $this->maxYear; $i++) {

      array_push($this->yearsPastFuture, $i);
    }
    print $this->dropdown($id, $this->yearsPastFuture, $selected);
  }

  function renderYearsPast($id, $selected=0) {
    print $this->dropdown($id, $this->yearsPast, $selected);
  }

  function renderYearsFuture($id, $selected=0) {
    print $this->dropdown($id, $this->yearsFuture, $selected);
  }

  function renderMonths($id, $selected=0) {
    print $this->dropdown($id, $this->shortMonths, $selected);
  }

  function renderMonthsShort($id, $selected=0) {
    print $this->dropdown($id, $this->months, $selected);
  }

  function renderFullWeek($id, $selected=0) {
    print $this->dropdown($id, $this->days, $selected);
  }

  function renderFullWeekShort($id, $selected=0) {
    print $this->dropdown($id, $this->shortDays, $selected);
  }

  function renderWorkingWeek($id, $selected=0) {
    print $this->dropdown($id, $this->workingdays, $selected);
  }

  function renderWorkingWeekShort($id, $selected=0) {
    print $this->dropdown($id, $this->shortWorkingdays, $selected);
  }

  function renderDays($id, $selected=0) {
    print $this->dropdown($id, $this->days, $selected);
  }

  function renderDaysShort($id, $selected=0) {
    print $this->dropdown($id, $this->shortDays, $selected);
  }

  function render12Hours($id, $selected=0) {
    print $this->dropdown($id, $this->hours, $selected);
  }

  function render24Hours($id, $selected=0) {
    print $this->dropdown($id, $this->hoursMil, $selected);
  }

  function renderDaysOfMonth($id, $selected=0) {
    print $this->dropdown($id, $this->daysOfMonth, $selected);
  }

  function renderSeries($id, $start, $end, $selected=0) {
    for ($i = $start; $i <= $end; $i++)
      $this->series[$i] = $i;
    print $this->dropdown($id, $this->series, $selected);
  }

  function renderBoolean($id, $selected=0) {
    print $this->dropdown($id, $this->boolean, $selected);
  }

  function renderActivation($id, $selected=0) {
    print $this->dropdown($id, $this->activation, $selected);
  }

  function renderCustom($id, $selected=0) {
    print $this->dropdown($id, $this->custom, $selected);
  }

  function renderYesNo($id, $selected=0) {
    print $this->dropdown($id, $this->yesNo, $selected);
  }

  function renderCountries($id, $selected=0) {
    print $this->dropdown($id, $this->countries, $selected);
  }

  function renderStates($id, $selected=0) {
    print $this->dropdown($id, $this->states, $selected);
  }

  function renderDirectory($id, $selected, $directory) {
    $this->custom = array();
    $mydir = dir($directory);
    while ($file = $mydir->read()) {
      if (substr($file, 0, 1) != "." && substr($file, 0, 1) != "_") {
        $this->custom[$file] = $file;
      }
    }
    print $this->renderCustom($id, $selected);
  }

  function mobileHours()
    {
      $this->hours = array();
      $time = "";
      for($i=0;$i<=23;$i++)
      {
        if($i<12) $this->hours["0".$i.":00:00"] = sprintf("%02d", $i).":00 AM";
        if($i==12) $this->hours[$i.":00:00"] = sprintf("%02d", $i).":00 PM";
        if($i>12) $this->hours[$i.":00:00"] = sprintf("%02d", $i-12).":00 PM";
        
        if($i<12) $this->hours["0".$i.":15:00"] = sprintf("%02d", $i).":15 AM";
        if($i==12) $this->hours[$i.":15:00"] = sprintf("%02d", $i).":15 PM";
        if($i>12) $this->hours[$i.":15:00"] = sprintf("%02d", $i-12).":15 PM";
        
        if($i<12) $this->hours["0".$i.":30:00"] = sprintf("%02d", $i).":30 AM";
        if($i==12) $this->hours[$i.":30:00"] = sprintf("%02d", $i).":30 PM";
        if($i>12) $this->hours[$i.":30:00"] = sprintf("%02d", $i-12).":30 PM";
        
        if($i<12) $this->hours["0".$i.":45:00"] = sprintf("%02d", $i).":45 AM";
        if($i==12) $this->hours[$i.":45:00"] = sprintf("%02d", $i).":45 PM";
        if($i>12) $this->hours[$i.":45:00"] = sprintf("%02d", $i-12).":45 PM";
      }
    }
    
    function mobileWeek()
    {
      for($i=0;$i<=15;$i++)
      {
        $date1 = date("Y-m-d",  mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")));
        $date2 = date("D M d/Y",  mktime(0, 0, 0, date("m"), date("d") + $i, date("Y")));
        $this->custom[$date1] = $date2;
      }
    }
  
  function renderMobileHours($id,$selected=0)
	{
      $this->mobileHours();
		print $this->dropdown($id,$this->hours,$selected);
	}
    
    function renderMobileDates($id,$selected=0)
	{
      $this->mobileWeek();
		print $this->dropdown($id,$this->custom,$selected);
	}
  
}

?>
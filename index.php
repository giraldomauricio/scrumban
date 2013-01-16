<?
include("framework.php");
if($_GET["sandbox"]) $_SESSION["sandbox"] = $_GET["sandbox"];
if(file_exists("shaversion.php") && $_SESSION["sandbox"] != "true")
{
    include("shaversion.php");
    if($shaversion != "" and file_exists($shaversion)) header ("Location: ".$shaversion);
}
if(file_exists("../shaversion.php")) include "../shaversion.php";

if($_GET["key"]) $_SESSION["key"] = $_GET["key"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?=$portalName?></title>

<!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 750px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="assets/css/datepicker.css" rel="stylesheet">


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

<div class="container">

  <div class="row">
    <div class="span12">
      
      
        <div class="btn-toolbar" style="margin: 0;">
            
            
            <a href="index.php?load=projects" class="btn btn-large btn-success span2">Projects</a>
      <a href="index.php?load=users" class="btn btn-large btn-success span2">Users</a>
      <a href="index.php?load=teams" class="btn btn-large btn-success span2">Teams</a>
      <a href="index.php?load=sprint" class="btn btn-large btn-success span2">Current Sprint</a>
            
       <div class="btn-group">
           
           
           
           
                <button class="btn btn-large btn-success dropdown-toggle span2" data-toggle="dropdown">Sprint by Teams <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <?
                    $teams = new main_teams();
                    $teams->getAll();
                    while($teams->load()){
                    ?>
                  <li><a href="index.php?load=sprint&team=<?=$teams->get_team_id()?>"><?=$teams->get_team_name()?></a></li>
                    <?
                    }
                    ?>
                </ul>
              </div>
      </div>
      
    </div>
  </div>
  

      <hr>

		<?
        $script = $_GET["load"].".public.php";
        if($script != "" && $script != null && file_exists($script)) include($script);
        else include("main.index.php");
        ?>

      <hr>

        <?
        if(!strpos($_SERVER["SCRIPT_URL"], $shaversion)){
        ?>
            <div class="alert alert-error">You are not using the most recent release of <?=$portalName?>. Last release is available <a href="../<?=$shaversion?>">here</a>.</div>
        <?
        }
        ?>
      
        <?
        if($_SESSION["sandbox"] == "true")
        {
        ?>
        <div class="alert alert-block">
            <h4>Running in Sandbox Mode</h4>
        </div>
        <?
        }
        ?>  
            
      <div class="footer">
        <p>&copy; <?=$portalName?> <?=date("Y")?> sha <?=$shaversion?></p>
      </div>

    </div> <!-- /container -->

<!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap-transition.js"></script>
<script src="assets/js/bootstrap-alert.js"></script>
<script src="assets/js/bootstrap-modal.js"></script>
<script src="assets/js/bootstrap-dropdown.js"></script>
<script src="assets/js/bootstrap-scrollspy.js"></script>
<script src="assets/js/bootstrap-tab.js"></script>
<script src="assets/js/bootstrap-tooltip.js"></script>
<script src="assets/js/bootstrap-popover.js"></script>
<script src="assets/js/bootstrap-button.js"></script>
<script src="assets/js/bootstrap-collapse.js"></script>
<script src="assets/js/bootstrap-carousel.js"></script>
<script src="assets/js/bootstrap-typeahead.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
    
    <script language="javascript">
	$(function(){
			$('#dp3').datepicker({format: 'yyyy-mm-dd'});
			$('#dp4').datepicker({format: 'yyyy-mm-dd'});
		});
	</script>

 <?
 $modal = false;
 if($_GET["m"])
 {
   $modal = true;
  
 }
 
 ?>  
</body>
</html>
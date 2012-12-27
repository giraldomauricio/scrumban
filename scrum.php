<?
include("framework.php");
if($_GET["key"])
{
  $_SESSION["key"] = $_GET["key"];
  $users = new main_users();
  $user = $users->getUserByKey();
}
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

  <?
  if($_SESSION["key"]){
  ?>
  
<div class="container">

  <div class="row">
    <div class="span12">
      <a href="scrum.php?load=backlog" class="btn btn-large btn-success span2">Backlog</a>
      <a href="scrum.php?load=wip" class="btn btn-large btn-success span2">Tasks</a>
    </div>
  </div>
  <h3><?=$_SESSION["name"]?></h3>

      <hr>

		<?
        $script = $_GET["load"].".public.php";
        if($script != "" && $script != null && file_exists($script)) include($script);
        else include("main.index.php");
        ?>

      <hr>

      <div class="footer">
        <p>&copy; <?=$portalName?> <?=date("Y")?></p>
      </div>

    </div> <!-- /container -->
<?
  }else{
?>
    <h3>You need a key to use this application. Please refer to your welcome email.</h3>
    <?
  }
    ?>
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
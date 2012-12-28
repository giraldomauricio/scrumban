
    
    
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="admin.php?load=main"><?=$portalName?></a>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?=$_SESSION["name"]?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div>
          <div class="nav-collapse">
            <ul class="nav">
              
              <li><a href="admin.php?load=users"> Users</a></li>
              
              <li><a href="admin.php?load=categories"> Categories</a></li>
              
              <li><a href="admin.php?load=menu"> Menu</a></li>
              
              <li><a href="admin.php?load=banners"> Banners</a></li>
              
              <li><a href="admin.php?load=screens"> Screens</a></li>
              
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

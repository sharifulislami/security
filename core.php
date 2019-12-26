<?php
$configfile = 'config.php';
if (!file_exists($configfile)) {
    echo '<meta http-equiv="refresh" content="0; url=install" />';
    exit();
}

require 'config.php';

session_start();

if ($client == 'Yes') {
    echo '
<script>
if (window!=window.top) {
  //Access Granted
}
else {
  alert("Direct access is not allowed.");
  window.stop();
}
</script>
';
}

$version = "15.0";

if ($client == 'No') {
    if (isset($_SESSION['sec-username'])) {
        $uname = $_SESSION['sec-username'];
        $table = $prefix . 'users';
        $suser = mysqli_query($connect, "SELECT * FROM `$table` WHERE username='$uname'");
        $count = mysqli_num_rows($suser);
        if ($count < 0) {
            echo '<meta http-equiv="refresh" content="0; url=index" />';
            exit;
        }
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index" />';
        exit;
    }
}

$_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$table = $prefix . 'settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_array($query);

//Error Reporting
if ($row['error_reporting'] == 1) {
    error_reporting(0);
}
if ($row['error_reporting'] == 2) {
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
}
if ($row['error_reporting'] == 3) {
    error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
}
if ($row['error_reporting'] == 4) {
    error_reporting(E_ALL & ~E_NOTICE);
}
if ($row['error_reporting'] == 5) {
    error_reporting(E_ALL);
}

//Displaying Errors
if ($row['display_errors'] == 1) {
    @ini_set('display_errors', '1');
} else {
    @ini_set('display_errors', '0');
}

function get_banned($ip)
{
    require 'config.php';
    $table = $prefix . 'bans';
    $query = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        return 'Yes';
    } else {
        return 'No';
    }
}

function get_bannedid($ip)
{
    require 'config.php';
    $table = $prefix . 'bans';
    $query = mysqli_query($connect, "SELECT * FROM `$table` WHERE ip='$ip' LIMIT 1");
    $row   = mysqli_fetch_array($query);
    return $row['id'];
}

function head()
{
    require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>Project SECURITY &rsaquo; Admin Panel</title>


    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <!--Bootstrap Stylesheet-->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	
<?php
    if ($client == 'No') {
        echo '<link rel="stylesheet" href="assets/css/blue-skin.min.css">';
    } else {
        echo '<link rel="stylesheet" href="assets/css/purple-skin.min.css">';
    }
?>
    
	<!--Font Awesome-->
    <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
    echo '
    <!--Morris.js-->
    <link href="assets/plugins/morris-js/morris.min.css" rel="stylesheet">';
}
?>
	
    <!--Switchery-->
    <link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet">
        
<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
    echo '
    <!--Select2-->
    <link href="assets/plugins/select2/select2.min.css" rel="stylesheet">';
}
?>
	
	<!--Stylesheet-->
    <link href="assets/css/admin.min.css" rel="stylesheet">

<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'password-generator.php') {
    echo '
    <!--noUiSlider-->
    <link href="assets/plugins/noUiSlider/nouislider.min.css" rel="stylesheet">';
}
?>

    <!--DataTables-->
    <link href="assets/plugins/datatables/datatables.min.css" rel="stylesheet">
    
    <!--Flags-->
    <link href="assets/plugins/flags/flags.css" rel="stylesheet">

    <!--SCRIPT-->
    <!--=================================================-->

    <!--jQuery-->
    <script src="assets/js/jquery-3.1.1.min.js"></script>
        
<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
    echo '
    <!--Google Charts-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>';
}
?>
    
</head>

<body class="hold-transition <?php
    if ($client == 'No') {
        echo 'skin-blue';
    } else {
        echo 'skin-purple';
    }
?> sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <a href="dashboard" class="logo">
      <span class="logo-mini">P<strong>SEC</strong></span>
      <span class="logo-lg">Project <strong>SECURITY</strong></span>
    </a>

    <nav class="navbar navbar-static-top">

      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
             <a href="<?php
    echo $site_url;
?>" target="_blank">
			 <span><i class="fa fa-desktop"></i>&nbsp;&nbsp;View Site</span>
			 </a>
          </li>
          <li>
             <a href="settings"><span><i class="fa fa-cogs"></i>&nbsp;&nbsp;Settings</span></a>
          </li>
<?php
    if ($client == 'No') {
        $uname = $_SESSION['sec-username'];
        $table = $prefix . 'users';
        $suser = mysqli_query($connect, "SELECT * FROM `$table` WHERE username='$uname'");
        $urow  = mysqli_fetch_array($suser);
?>
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/img/avatar.png" class="user-image" alt="Admin Image">
              <span class="hidden-xs"><?php
        echo $_SESSION['sec-username'];
?></span>
            </a>
            <ul class="dropdown-menu">

              <li class="user-header">
                <img src="assets/img/avatar.png" class="img-circle" alt="Admin Image">

                <p>
                  <?php
        echo $_SESSION['sec-username'];
?>
                  <small><?php
        echo $urow['email'];
?></small>
                </p>
              </li>

              <li class="user-footer">
                <div class="pull-left">
                  <a href="users?edit-id=<?php
        echo $urow['id'];
?>" class="btn btn-default btn-flat"><i class="fa fa-user fa-fw fa-lg"></i> Edit Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout" class="btn btn-default btn-flat"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </div>
              </li>
            </ul>
          </li>
<?php
    }
?>
        </ul>
      </div>
    </nav>
  </header>

  <aside class="main-sidebar">

    <section class="sidebar">
<?php
    if ($client == 'No') {
?>
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php
        echo $_SESSION['sec-username'];
?></p>
          <a href="#"><i class="fa fa-envelope-o"></i> <?php
        echo $urow['email'];
?></a>
        </div>
      </div>
<?php
    }
?>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>

      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
        echo 'class="active"';
    }
?>>
           <a href="dashboard">
              <i class="fa fa-home"></i> <span>Dashboard</span>
           </a>
        </li>
          
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'site-info.php') {
        echo 'class="active"';
    }
?>>
           <a href="site-info">
              <i class="fa fa-info-circle"></i> <span>Site Info</span>
           </a>
        </li>
          
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'ip-whitelist.php') {
        echo 'class="active"';
    }
?>>
           <a href="ip-whitelist">
              <i class="fa fa-flag-o"></i> <span>IP Whitelist</span>
           </a>
        </li>

<?php
    if ($client == 'No') {
?>
        <li <?php
        if (basename($_SERVER['SCRIPT_NAME']) == 'users.php') {
            echo 'class="active"';
        }
?>>
           <a href="users">
              <i class="fa fa-users"></i> <span>Users</span>
           </a>
        </li>
<?php
    }
?>
      <li class="header">SECURITY</li>    
           
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'sql-injection.php') {
        echo 'class="active"';
    }
?>>
           <a href="sql-injection">
              <i class="fa fa-code"></i> <span>SQL Injection</span>
<?php
    $table = $prefix . 'sqli-settings';
    $query = mysqli_query($connect, "SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 'Yes') {
        echo '
              <small class="label pull-right bg-green">ON</small>
';
    } else {
        echo '
              <small class="label pull-right bg-red">OFF</small>
';
    }
?>     
           </a>
        </li>

          
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'spam.php') {
        echo 'class="active"';
    }
?>>
           <a href="spam">
              <i class="fa fa-keyboard-o"></i> <span>Spam</span>
<?php
    $table = $prefix . 'spam-settings';
    $query = mysqli_query($connect, "SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 'Yes') {
        echo '
              <small class="label pull-right bg-green">ON</small>
';
    } else {
        echo '
              <small class="label pull-right bg-red">OFF</small>
';
    }
?>     
           </a>
        </li>
          
        <li <?php
    if (basename($_SERVER['SCRIPT_NAME']) == 'proxy.php') {
        echo 'class="active"';
    }
?>>
           <a href="proxy">
              <i class="fa fa-globe"></i> <span>Proxy</span>
<?php
    $table = $prefix . 'proxy-settings';
    $query = mysqli_query($connect, "SELECT * FROM `$table`");
    $row   = mysqli_fetch_array($query);
    if ($row['protection'] == 'Yes') {
        echo '
              <small class="label pull-right bg-green">ON</small>
';
    } else {
        echo '
              <small class="label pull-right bg-red">OFF</small>
';
    }
?>     
           </a>
        </li>
          

 <!-- cutjnsngmbke -->  
      </ul>
    </section>

  </aside>
<?php
}

function footer()
{
    require('config.php');
?>
<footer class="main-footer">
    <strong>&copy; <?php
    echo date("Y");
?> <a href="https://codecanyon.net/item/project-security-website-security-antivirus-firewall/15487703?ref=Antonov_WEB" target="_blank">Project SECURITY</a></strong>
    
    <a href="#" class="go-top"><i class="fa fa-arrow-up"></i></a>
</footer>

</div>

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--BootstrapJS-->
    <script src="assets/js/bootstrap.min.js"></script>

    <!--Fast Click-->
    <script src="assets/plugins/fast-click/fastclick.min.js"></script>

    <!--Admin-->
    <script src="assets/js/admin.min.js"></script>

<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'dashboard.php') {
    echo '
    <!--Morris.js-->
    <script src="assets/plugins/morris-js/morris.min.js"></script>
	<script src="assets/plugins/morris-js/raphael-js/raphael.min.js"></script>';
}
?>

    <!--Switchery-->
    <script src="assets/plugins/switchery/switchery.min.js"></script>
    
<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'bans-country.php') {
    echo '
    <!--Select2-->
    <script src="assets/plugins/select2/select2.min.js"></script>';
}
?>
    
<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'password-generator.php') {
    echo '
    <!--noUiSlider-->
    <script src="assets/plugins/noUiSlider/jquery.nouislider.all.min.js"></script>';
}
?>
    
    <!--DataTables-->
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    
<?php
if (basename($_SERVER['SCRIPT_NAME']) == 'log-details.php') {
    echo '
    <!--Google Maps-->
    <script src="https://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="assets/plugins/gmaps/gmaps.min.js"></script>';
}
?>

</body>
</html>
<?php
}
?>
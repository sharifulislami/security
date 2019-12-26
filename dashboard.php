<?php
require("core.php");
head();
?>
<div class="content-wrapper">

			<!--CONTENT CONTAINER-->
			<!--===================================================-->
			<div id="content-container">
				
				<section class="content-header">
    			  <h1><i class="fa fa-home"></i> Dashboard</h1>
    			  <ol class="breadcrumb">
   			         <li><a href="dashboard"><i class="fa fa-home"></i> Admin Panel</a></li>
    			     <li class="active">Dashboard</li>
    			  </ol>
    			</section>


				<!--Page content-->
				<!--===================================================-->
				<section class="content">
                    
<h3 class="text-thin">Today's Stats</h3>
<?php


$table = $prefix . 'users';
$query = mysqli_query($connect, "SELECT * FROM $table");
$count = mysqli_num_rows($query);
?>
                <div class="row">
                
					    <div class="col-sm-6 col-lg-3">
                            <div class="small-box bg-aqua">
                               <div class="inner">
                                   <h3><?php
echo $count;
?></h3>
                                   <p>Users</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-user"></i>
                               </div>
                               <a href="users" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-red">
                               <div class="inner">
                                   <h3><?php
echo "No";
?></h3>
                                   <p>Proxy Protection</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-retweet"></i>
                               </div>
                               <a href="proxy" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-green">
                               <div class="inner">
                                   <h3><?php
echo "No";
?></h3>
                                   <p>Whitelist IP</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-globe"></i>
                               </div>
                               <a href="ip-whitelist" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					    <div class="col-sm-6 col-lg-3">
					        <div class="small-box bg-yellow">
                               <div class="inner">
                                   <h3><?php
echo "No";
?></h3>
                                   <p>Spam Protection</p>
                               </div>
                               <div class="icon">
                                   <i class="fa fa-keyboard-o"></i>
                               </div>
                               <a href="spam" class="small-box-footer">View Logs <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
					    </div>
					</div>

                    
                    <div class="box">
						<div class="box-header">
								<h3 class="box-title">Modules & Functions</h3>
						</div>
						<div class="box-body">
<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-cog"></i> &nbsp;Security Modules</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />Protection
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />Protection 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
                    
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />Protection 
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['protection'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-list-ul"></i> &nbsp;Logging Settings</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />Logging
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />Logging 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>

					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />Logging
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['logging'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>
					
					<div class="row">
					<div class="col-md-4">
                        <div class="well">
						    <center>
							<h3><i class="fa fa-ban"></i> &nbsp;AutoBan Settings</h3>
                            </center>
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-code"></i> SQL Injection</strong><br />AutoBan
<?php
$table = $prefix . 'sqli-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>							
						</div>
					</div>
					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-globe"></i> Proxy</strong><br />AutoBan 
<?php
$table = $prefix . 'proxy-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>

					<div class="col-md-2">
                        <div class="well">
						    <center>
							<strong><i class="fa fa-keyboard-o"></i> Spam</strong><br />AutoBan
<?php
$table = $prefix . 'spam-settings';
$query = mysqli_query($connect, "SELECT * FROM `$table`");
$row   = mysqli_fetch_assoc($query);
if ($row['autoban'] == 'Yes') {
    echo '
					        <h3><span class="label label-success"><i class="fa fa-check"></i> ON</span></h3>
';
} else {
    echo '
                            <h3><span class="label label-danger"><i class="fa fa-times"></i> OFF</span></h3>
';
}
?>
                            </center>
						</div>
					</div>
					</div>   
						</div>
				   </div>

                    
				</div>
				<!--===================================================-->
				<!--End page content-->


			</div>
			<!--===================================================-->
			<!--END CONTENT CONTAINER-->


<?php
footer();
?>
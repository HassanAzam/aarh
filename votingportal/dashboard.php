<?php
	require('../admin/scripts/connection.php');
	session_start();
	if(isset($_SESSION['valid']))
	{
		if($_SESSION['valid']==true)
		{
			$cnic = $_SESSION['cnic'];
			$pkey = $_SESSION['pkey'];
			
			//getting data from DB
			
			$q = "SELECT R.ro_ID, V.voter_name, P.poll_Name
			      FROM ro R, voter V, pollingstation P
				  WHERE R.CNIC = '$cnic'
				  and   R.CNIC = V.CNIC
				  and   R.poll_ID = P.poll_ID";
			$r = $mysqli->query($q);
			
			$result = $r->fetch_row();
			
			$roid = $result[0];
			$name = $result[1];
			$pollname = $result[2];
			
?>

<!DOCTYPE html>
<html lang="en">
 <head>
  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
</head>
 
 


<body>



<div id="wrapper">
       
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu" >

                    <li>
                        <a class="active-menu" href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="votingarea.php"><i class="fa fa-desktop"></i> Voting Area</a>
                    </li>
					<li>
                        <a href="chart.html"><i class="fa fa-bar-chart-o"></i>Voting Trends</a>
                    </li>
					<li>
                        <a href="logout.php"><i class="fa fa-bar-chart-o"></i>Logout</a>
                    </li>
                    <!-- <li>
                        <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs &amp; Panels</a>
                    </li>
                    
                    <li>
                        <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
                    </li> -->
                    


                    <!-- <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li>
                                <a href="first.html">Second Level Link</a>
                            </li>
                            <li>
                                <a href="second.html">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li> -->
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">


                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                            Dashboard <small>Summary of this Polling Station</small>
                        </h1>
                    </div>
                </div>
                
				
				<!-- First Row -->
	<div class="row">
	
								<!-- First Block  -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-brown">
				<div class="panel-body">
					<i class="fa fa-users fa-5x"></i>
					<h3><?php echo $name; ?></h3>
				</div>
					<div class="panel-footer back-footer-brown">Name of Returning Officer</div>
			</div>
		</div>
								<!-- First Block -->
								
								
								<!-- Second Block -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-blue">
				<div class="panel-body">
					<i class="fa fa-expeditedssl fa-5x"></i>
					<h3><?php echo $roid; ?> </h3>
				</div>
				<div class="panel-footer back-footer-blue">ID of R.O.</div>
			</div>
		</div>
								<!-- Second Block -->
								
								
								<!-- Third Block -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-red">
				<div class="panel-body">
					<i class="fa fa fa-foursquare fa-5x"></i>
					<h3><?php echo $pollname; ?></h3>
				</div>
				<div class="panel-footer back-footer-red">Name of Polling Station</div>
			</div>
		</div>
								<!-- Third Block -->
								
								
								<!-- Fourth Block -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-green">
				<div class="panel-body">
					<i class="fa fa-pie-chart fa-5x"></i>
					<h3>12,630</h3>
				</div>
				<div class="panel-footer back-footer-green">Number of votes cast</div>
			</div>
			</div>
								<!-- Fourth Block -->
			
		
	</div>
								<!-- First Row -->
																
								
								
	
				<footer><p>All right reserved to WebThemez. AARH <a href="#">Online Voting System</a></p></footer>
            </div>
            <!-- /. PAGE INNER  -->
        <!-- /. PAGE WRAPPER  -->
    </div>


								
								
								
								<!-- Custom Scripts -->
								
								<script src="scripts/jquery-1.10.2.js"></script>
								<script src="scripts/bootstrap.min.js"></script>
								<script src="scripts/jquery.metisMenu.js"></script>
								<script src="scripts/morris/raphael-2.1.0.min.js"></script>
								<script src="scripts/morris/morris.js"></script>
								<script src="scripts/custom-scripts.js"></script>
								
								<!-- Custom Scripts -->

</body>
</html>


                
            </div>
<?php

		}
	}
	else
	{
		header("Location: ../");
	}
?>
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
			
			// Get total number of votes casted in current polling station
			$q = "SELECT COUNT(*) FROM vote WHERE poll_ID = 
					(SELECT poll_ID FROM pollingstation WHERE poll_name='$pollname')";
			$r = $mysqli->query($q);
			$result = $r->fetch_row();
			$totalvotes = $result[0];
			
			// Get pollid of current R.O.
			$q1 = "SELECT poll_ID FROM pollingstation WHERE poll_name = '$pollname'";
			$r1 = $mysqli->query($q1);
			$result = $r1->fetch_row();
			$pollid = $result[0];
			
			// Get const_ID of current R.O.
			$q2 = "SELECT const_ID FROM town WHERE town_ID = 
								(SELECT town_ID FROM voter WHERE cnic = '$cnic')";
			$r2 = $mysqli->query($q2);
			$result = $r2->fetch_row();
			$constid = $result[0];
			
			// Get Nominee's and Party ID's of current constituency
			$q3 = "SELECT nominee_ID, party_ID FROM nominee WHERE const_ID = '$constid'";
			$r3 = $mysqli->query($q3);
			$i=0;
			$nominees = array();
			while($row = $r3->fetch_assoc()) {
				$nominees[$i++] = [$row['nominee_ID'], $row['party_ID']];
			}
			$tempNomID;
			$votecount = array();
			for ($x=0 ; $x<sizeof($nominees) ; $x++){
				$tempNomID = $nominees[$x][0]; 
				$q4 = "SELECT COUNT(*) FROM vote WHERE poll_ID = '$pollid' AND nominee_ID = '$tempNomID'";
				$r4 = $mysqli->query($q4);
				$result = $r4->fetch_row();
				$votecount[$x] = $result[0];
			}
			// $nominees[0][0] = First nominees ID
			// $nominees[0][1] = First nominees party ID
			// $nominees[1][0] = Second nominees ID
			// $nominees[1][1] = Second nominees party ID
			
			for($k=0;$k<sizeof($nominees);$k++)
			{			
				//Get party names for chart
				$partyid = $nominees[$k][1];
				$query = "SELECT party_Name FROM party WHERE party_ID = '$partyid'";
				$re = $mysqli->query($query);
				$par = $re->fetch_row();
				$partyNames[$k] = $par[0];
			}
			
			for($a=0;$a<sizeof($nominees);$a++)
			{			
				//Get party names for chart
				$partyid = $nominees[$a][0];
				$query = "SELECT COUNT(*) FROM vote WHERE nominee_ID = '$partyid' AND poll_ID='$pollid'";
				$re = $mysqli->query($query);
				$par = $re->fetch_row();
				$partyVotes[$a] = $par[0];
			}
			
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
	<!-- Chart JS -->
  <script src="../chartjs/Chart.js"></script>
	<!-- Chart JS -->
</head>
 
 


<body>



<div id="wrapper">
       
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu" >

                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="votingarea.php"><i class="fa fa-desktop"></i> Voting Area</a>
                    </li>
					<li>
                        <a class="active-menu" href="rograph.php"><i class="fa fa-bar-chart-o"></i>Voting Trends</a>
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
			
			<!-- First Row -->
	<div class="row">
	
								<!-- First Block  -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-brown">
				<div class="panel-body">
					<i class="fa fa-hashtag fa-5x"></i>
					<h3><?php echo $pollid; ?></h3>
				</div>
					<div class="panel-footer back-footer-brown">Polling Station ID</div>
			</div>
		</div>
								<!-- First Block -->
								
								
								<!-- Second Block -->
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div class="panel panel-primary text-center no-boder bg-color-blue">
				<div class="panel-body">
					<i class="fa fa-building-o fa-5x"></i>
					<h3><?php echo $constid; ?></h3>
				</div>
				<div class="panel-footer back-footer-blue">Constituency ID</div>
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
					<h3><?php echo $totalvotes; ?></h3>
				</div>
				<div class="panel-footer back-footer-green">Number of votes cast</div>
			</div>
			</div>
								<!-- Fourth Block -->
			
		
	</div>
								<!-- First Row -->
			
			
			

				<div width="400px" height="200px">
	<canvas id="myChart"></canvas>
</div>	

	<script>
			
			var partyNamesArray = [<?php echo '"'.implode('","', $partyNames).'"' ?>];
			var partyVotesArray = [<?php echo '"'.implode('","', $partyVotes).'"' ?>];
			var colors = ["#FF6384", "#36A2EB", "#FFCE56", "#E7E9ED", "#4B0082", "#F5DEB3"];
			var colorsToShow=[];
			for (var i=0; i<partyNamesArray.length ; ++i)
			{
				colorsToShow[i] = colors[i];
			}

			var ctx = document.getElementById("myChart");
			var data = {
			labels: partyNamesArray,
			datasets: [
				{
					data: partyVotesArray,
					backgroundColor: colorsToShow,
					hoverBackgroundColor: colorsToShow
				}]
		};
			var options = {
			
			}
			
			new Chart(ctx, {
			data: data,
			type: 'doughnut',
			options: options
		});
	</script>
			
		
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
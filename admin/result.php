<?php
require("scripts/connection.php");
session_start();

	if(isset($_SESSION['valid']))
	{
		if($_SESSION['valid']==true)
		{
			$cnic = $_SESSION['cnic'];
			$adminid = $_SESSION['adminid'];
			
			//Golden Query for counting votes
			$query = "SELECT P.party_Name, COUNT( V.vote_ID ) AS votes
					FROM party P, vote V, nominee N
					WHERE V.nominee_ID = N.nominee_ID
					AND N.party_ID = P.party_ID
					GROUP BY P.party_Name";
					
			$re = $mysqli->query($query);
			$u=0;
			while($row = $re->fetch_assoc())
			{
				$partyNames[$u] = $row['party_Name'];
				$partyVotes[$u++] = $row['votes'];
			}
			
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AAHR Online Voting System</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Chart JS -->
    <script src="../chartjs/Chart.js"></script>
	<!-- Chart JS -->
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	
	<style>
		.customicon
		{
			width:30px;
			height:20px;
		}
		
		.dcard
		{
			height:150px;
			border-right:1px solid #fff;
			margin-bottom:1px;
		}
		.dcard h3{
			color:#fff;
			font-size:50px;
			margin:0 auto;
			width:50%;
			text-align:center;
			padding-top:50px;
			display:inline-block;
		}
		.dcarddiv
		{
			
			display:inline-block;
			width:120px;
			float:right;
			margin:10px 0 0 0;
			height:130px;
			padding:5px;
		}
		.dcarddiv h4{
			color:#fff;font-weight:bold;
			text-align:center;
			text-transform:uppercase;
		}
		.dcarddiv img{
			
			margin-left:15px;
			width:70%;
			
		}
	</style>
  </head>

  <?php require('sidenav.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Voting Results and Trends</h3>
              </div>

              
            </div>

            <div class="clearfix"></div>

            
			  
			  <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="font-weight:bold;">OverAll Result</h2>
                    
                    <div class="clearfix"></div>
                  </div>
				  
				  
				  
				  <!-- Content -->
                  <div class="x_content">
				  
				  
				  <div style="width:50%; height:400px; margin-top:50px; float:left; ">
					<canvas style="height:400px;" id="myChart"></canvas>
				  </div>
				  
                      
					  <div style="float:right; width:40%;">
					  
					  
					  
					  <div class="row" id="vr">
							<div class="col-xs-12 dcard" style="background-color:#F5233E;">
							<h3 id="votescount"></h3>
							<div class="dcarddiv">
								<h4>Total Number Of Votes Casted</h4>
								
							</div>
							</div>
						<div class="col-xs-12 dcard" style="background-color:#1EBFAE;">
							<h3 id="leadingparty"></h3>
							<div class="dcarddiv">
								<h4>Leading Party</h4>
								
							</div>
						</div>
						<div class="col-xs-12 dcard" style="background-color:#F5233E;">
							<h3 id="leadingpartyvotes"></h3>
							<div class="dcarddiv">
								<h4>Leading Party Votes</h4>
								
							</div>
						</div>
					  </div>
					  </div>
					  
					  
					  
                  </div>
				  <!-- /Content --> 
                </div>
              </div>
            </div>
			
			
			<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="font-weight:bold;">Result By Constituency</h2>
                    
                    <div class="clearfix"></div>
                  </div>
				  
				  
				  
				  <!-- Content -->
                  <div class="x_content">
				  
				  
				  
				  <div style="width:50%; height:400px; margin-top:50px; float:left; ">
					<div id="constselect" style="padding-bottom:80px;">
					<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Constituency</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="constid" id="listconst">
                           
                          </select>
						  <button id="rbcbutton">Load Result</button>
                        </div>
                      </div>
				  </div>	
					<canvas style="height:400px; " id="constChart"></canvas>
				  </div>
				  
                      
					  <div style="float:right; width:40%;">
					  
					  
					  
					  <div class="row" id="vr">
							<div class="col-xs-12 dcard" style="background-color:#F5233E;">
							<h3 id="votescount"></h3>
							<div class="dcarddiv">
								<h4>Total Number Of Votes Casted</h4>
								
							</div>
							</div>
						<div class="col-xs-12 dcard" style="background-color:#1EBFAE;">
							<h3 id="leadingparty"></h3>
							<div class="dcarddiv">
								<h4>Leading Party</h4>
								
							</div>
						</div>
						<div class="col-xs-12 dcard" style="background-color:#F5233E;">
							<h3 id="leadingpartyvotes"></h3>
							<div class="dcarddiv">
								<h4>Leading Party Votes</h4>
								
							</div>
						</div>
					  </div>
					  </div>
					  
					  
					  
                  </div>
				  <!-- /Content --> 
                </div>
              </div>
            </div>
			
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            2016 &copy; AAHR Voting System
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    
	<script>
		function indexOfMax(arr) {
    if (arr.length === 0) {
        return -1;
    }

    var max = arr[0];
    var maxIndex = 0;

    for (var i = 1; i < arr.length; i++) {
        if (arr[i] > max) {
            maxIndex = i;
            max = arr[i];
        }
    }

    return maxIndex;
}
	</script>
	
	<!-- ChartJS Code -->
		<script>
			function drawChart(){
				
			var partyNamesArray = [<?php echo '"'.implode('","', $partyNames).'"' ?>];
			var partyVotesArray = [<?php echo '"'.implode('","', $partyVotes).'"' ?>];
			
			
			
			var leadingPartyIndex = indexOfMax(partyVotesArray);
			
			$('#leadingparty').text(partyNamesArray[leadingPartyIndex]);
			$('#leadingpartyvotes').text(partyVotesArray[leadingPartyIndex]);
			
			var ctx = document.getElementById("myChart");
			var data = {
			labels: partyNamesArray,
			datasets: [
				{
					data: partyVotesArray,
					backgroundColor: [
						"#FF6384",
						"#36A2EB",
					    "#FFCE56",
					],
					hoverBackgroundColor: [
						"#FF6384",
						"#36A2EB",
					    "#FFCE56",
					]
				}]
		};
			var options = {
				responsive : true
			}
			
			new Chart(ctx, {
			data: data,
			type: 'pie',
			options: options
		});
			}
			
			function drawconstChart(){
				
			var partyNamesArray = [<?php echo '"'.implode('","', $partyNames).'"' ?>];
			var partyVotesArray = [<?php echo '"'.implode('","', $partyVotes).'"' ?>];
			
			
			
			var leadingPartyIndex = indexOfMax(partyVotesArray);
			
			$('#leadingparty').text(partyNamesArray[leadingPartyIndex]);
			$('#leadingpartyvotes').text(partyVotesArray[leadingPartyIndex]);
			
			var ctx = document.getElementById("constChart");
			var data = {
			labels: partyNamesArray,
			datasets: [
				{
					data: partyVotesArray,
					backgroundColor: [
						"#FF6384",
						"#36A2EB",
					    "#FFCE56",
					],
					hoverBackgroundColor: [
						"#FF6384",
						"#36A2EB",
					    "#FFCE56",
					]
				}]
		};
			var options = {
				responsive : true
			}
			
			new Chart(ctx, {
			data: data,
			type: 'pie',
			options: options
		});
			}
	</script>
	<!-- ChartJS Code /-->

	
	
	<!-- Custom AJAX request jquery code -->
	
		<script>
			
			$( document ).ready(function() {
				
					$.ajax({
			   type: "POST",
			   url: 'scripts/const.php',
			   data: { listallconst : 'listallconst'}, // serializes the form's elements.
			   success: function(data)
			   {
					$('#listconst').html(data);	
			   }
			 });
			 
			 $('#rbcbutton').click(function(){
				 
				 var constid = $('#listconst').val();
				 alert(constid);
				 $.ajax({
					   type: "POST",
					   url: 'scripts/vote.php',
					   data: {action : 'constvotescount', constid : constid},		//sending 'countvoter' token so that php know what to do
					   success: function(data)
					   {
							
							
							alert(data);						
							
							drawconstChart();
					   }
					});
				 
			 });
				
					function getTR(){	
					$.ajax({
					   type: "POST",
					   url: 'scripts/vote.php',
					   data: {action : 'totalvotescount'},		//sending 'countvoter' token so that php know what to do
					   success: function(data)
					   {
							$('#votescount').text(data);
							
							//calculating turnout ratio
					
							var tv = $('#regvoters').text();
							var vc = $('#votescount').text();
							var tr = vc/tv*100;
							tr += '%';
							$('#turnout').text(tr);
							drawChart();
							drawconstChart();
					   }
					});
				}
				
					$.ajax({
					   type: "POST",
					   url: 'scripts/voter.php',
					   data: {countvoter : 'countvoter'},		//sending 'countvoter' token so that php know what to do
					   success: function(data)
					   {
							$('#totalVoters').text(data);
							$('#regvoters').text(data);
							getTR();
					   }
					});
					
					
				
					
							
			});
			
		</script>
	
	<!-- Custom AJAX request jquery code -->
	
	
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>

<?php
		}
	}
	else
	{
		header("Location: login.php");
	}

?>

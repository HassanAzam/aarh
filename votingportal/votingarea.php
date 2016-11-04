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
			
			$q = "SELECT R.ro_ID, V.voter_name, P.poll_Name, R.poll_ID
			      FROM ro R, voter V, pollingstation P
				  WHERE R.CNIC = '$cnic'
				  and   R.CNIC = V.CNIC
				  and   R.poll_ID = P.poll_ID";

			$r = $mysqli->query($q);
			
			$result = $r->fetch_row();
			
			
			
			$roid = $result[0];
			$name = $result[1];
			$pollname = $result[2];
			$pollid = $result[3];
			

			echo "<div id='pollid' style='display:none;'>".$pollid."</div>";
			
			$q1 = "SELECT C.const_Name
				   FROM constituency C
				   WHERE const_ID = (SELECT const_ID from town WHERE town_ID = (SELECT town_ID FROM pollingstation WHERE poll_ID = (SELECT poll_ID FROM ro WHERE ro_ID = '$roid') ) )";
			$r1 = $mysqli->query($q1);
			
			$result1 = $r1->fetch_row();
			$constname = $result1[0];
			
			$q2 = "SELECT party_ID
				   FROM nominee
				   WHERE const_ID = ( 
				   SELECT const_ID
				   FROM constituency
				   WHERE const_Name =  '$constname' )";
				   
			$r2 = $mysqli->query($q2);
			$j=0;
			while($r2row=$r2->fetch_assoc())
			{
				$party[$j] = $r2row['party_ID'];
				$j++;
			}
			
		}
?>
<!DOCTYPE html>
<html>
<head>
</head>

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
  <link rel="stylesheet" href="scripts/image-picker.css">
  
  <style>
	.notification
		{
			background-color:#1ABB9C; color:white; padding:10px; margin-bottom:20px; font-weight:bold;
			display:none;
		}
		
		.panel
		{
			width:100%;
			height:500px;
			
		}
		
		#startvoting
		{
			background-color:#333;
			padding-top:230px;
			
		}
		
		#validatecnic
		{
			background-color:#fff;
			border:1px solid #333;
		}
		
		#castvote
		{
			background-color:#fff;
			border:1px solid #333;
		}
		
		#v{
			text-align:center;
			margin:0 auto;
			background-color:#fff;
			font-size:20px;
			text-transform:uppercase;
			color:#fff;
			width:200px;
			color:#333;
			height:50px;
			padding:10px;
		}
		#vc
		{
			background-color:#333;
			color:#fff;
			text-align:center;
			text-transform:uppercase;
			padding:10px 0 10px 0;
		}
		
		.hidden
		{
			display:none;
		}
		
		.image_picker_image {
			width: 250px;
			height: 150px !important;
		}
   
		.party{
			width:60%;
			padding:10px;
			margin:20px 20px 10px 20px;
			float:left;
		}
		
		.constname
		{
			background-color:#333;
			float:right;
			margin:20px 60px 20px 0;
			width:300px;
			height:380px;
		}

		
  </style>
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
                        <a class="active-menu" href="votingarea.php"><i class="fa fa-desktop"></i> Voting Area</a>
                    </li>
					<li>
                        <a href="rograph.php"><i class="fa fa-bar-chart-o"></i>Voting Trends</a>
                    </li>
                    <!-- <li>
                        <a href="tab-panel.html"><i class="fa fa-qrcode"></i> Tabs &amp; Panels</a>
                    </li>
                    
                    <li>
                        <a href="table.html"><i class="fa fa-table"></i> Responsive Tables</a>
                    </li> -->
                    <li>
                        <a href="logout.php"><i class="fa fa-edit"></i>Logout</a>
                    </li>


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
        <div id="page-wrapper" style="background-color:#fff;">
            <div id="page-inner">
				<div class="panel" id="startvoting">
					
						<div id="v">
							Start Voting
						</div>
					
				</div>
				
				<div class="panel" id="validatecnic">
					
						<div id="vc">
							Validate CNIC
						</div>
						
					<div style="padding:150px 300px;">
					<label> Enter your CNIC </br>
						<input id="cnic" style="width:400px; margin-top:10px;" type="text" class="form-control" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="Enter CNIC" required>
					</label>
					
					<button style="background-color:#225081; border:none; color:#fff; padding:10px; margin-top:10px;" id="vald">Validate CNIC</button>
					<img src="processing.gif" style=" width:30px; height:30px;" id="prgif"/>
					<div id="e" style="margin:10px 0 0 0; padding:8px; background-color:red; color:#fff;"></div>
					</div>
					
				</div>
				
				<div class="panel" id="castvote">
					
						<div id="vc">
							Cast your Vote
						</div>
						
					<h3 id="vname" style="color:#225081; padding:5px;"></h3>
					<div id="evote" style="margin:10px 0 0 0; padding:8px; background-color:red; color:#fff;"></div>
					
					<div class="party">
						
						<select id="selectImage" class="image-picker">
							<option value=""></option>
							<?php
								 for($i=0; $i<sizeof($party); $i++)
								{
									$partyid = $party[$i];
									
									$query = "SELECT * FROM party where party_ID = '$partyid'";
									$rq = $mysqli->query($query);
									$partydata = $rq->fetch_assoc();
									
									echo '<option data-img-src="../admin/scripts/'.$partydata['party_Flag'].'" value="'.$partydata['party_ID'].'">'.$partydata['party_Name'].'</option>';
								} 
							?>
							
    
						</select>
						
					</div>
					
					<div class="constname">
					
						<div style="color:#fff; font-size:40px; text-align:center;"><?php echo $constname; ?></div>
						<button style="color:#333; margin:10px auto; border:none; background-color:#fff; padding:10px;" id="castvote1">Cast your VOTE</button>

					</div>
					
				</div>
				
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>


								
								
								
								<!-- Custom Scripts -->
								
								<script src="scripts/jquery-1.10.2.js"></script>
								<script src="scripts/bootstrap.min.js"></script>
								<script src="scripts/jquery.metisMenu.js"></script>
								<script src="scripts/morris/raphael-2.1.0.min.js"></script>
								<script src="scripts/morris/morris.js"></script>
								<script src="scripts/custom-scripts.js"></script>
								<script src="scripts/image-picker.min.js"></script>
								
								<script>
								
								$(document).ready(function () {
    $("#selectImage").imagepicker({
        hide_select: true
    });

    var $container = $('.image_picker_selector');
    // initialize
    $container.imagesLoaded(function () {
        $container.masonry({
            columnWidth: 30,
            itemSelector: '.thumbnail'
        });
    });
});
									
									var flag;
								
									$("select").imagepicker();
									
									$(document).ready(function(){
										
									
										
									
									
										$.ajax({
			   type: "POST",
			   url: '../scripts/party.php',
			   data: { listallparty : 'listallparty'}, 
			   success: function(data)
			   {
					$('#listallparty').html(data);	
					
			   }
			 });
									
										
										
			$( document ).ready(function() {
				$('#listallparty').change(function(){
					//getConst($(this).val());
					console.log($(this).val());
				});
			});
			});
			
		
		//--------------------------------------------------------------------------------------
		
		
		//***************************************************************
		//Script for Panel Switching Effects
		//***************************************************************
		
		$('#validatecnic').hide();
		$('#e').hide();
		$('#prgif').hide();
		$('#castvote').hide();
		
		$('#v').click(function(){
			
			$('#startvoting').slideToggle(function(){
				$('#validatecnic').slideDown();
			});
			
		});
		
		function getVoterName(cnic)
		{
			$("select").imagepicker();
			$.ajax({
					   type: "POST",
					   url: '../admin/scripts/voter.php',
					   data: { action : 'getvotername', cnic : cnic},
					   success: function(data)
					   {
						   
						   $('#vname').text('Welcome, ' + data);
					   }
				 });
		}
		
		$('#vald').click(function(){
			
						
			var cnic = $('#cnic').val();
			var pollid = $('#pollid').text();
			
			
			if(cnic == ''){
				$('#e').html('Please provide CNIC number');
				$('#e').show().delay(2000).fadeOut();
			}
			else{
				$('#prgif').show();
				$.ajax({
					   type: "POST",
					   url: '../admin/scripts/voter.php',
					   data: { action : 'cnicexist', cnic : cnic, pollid : pollid}, // serializes the form's elements.
					   success: function(data)
					   {
						   
						   $('#prgif').hide();
							if(data==0)
							{
								$('#e').html('CNIC number is not in VoterList!');
								$('#e').show().delay(2000).fadeOut();
							} 
							else if(data==1){
																
								$('#validatecnic').slideToggle(function(){
									$('#castvote').slideDown();
									getVoterName(cnic);
								});
							}
							else if(data==2){
																
								$('#e').html('You cannot vote in this pollingstation!');
								$('#e').show().delay(2000).fadeOut();
							}
							else if(data==3){
																
								$('#e').html('You already casted your vote!');
								$('#e').show().delay(2000).fadeOut();
							}
							console.log(data);
					   }
				 });
			}
			
		});

	$('#castvote1').click(function(){
			
			
			var cnic1 = $('#cnic').val();
			var pollid1 = $('#pollid').text();
			var partyid = $('#selectImage').val();

			$.ajax({
					   type: "POST",
					   url: '../admin/scripts/vote.php',
					   data: { action : 'addvote', cnic : cnic1, pollid : pollid1, partyid : partyid}, // serializes the form's elements.
					   success: function(data)
					   {
						   
						   alert(data);
							if(data==1)
							{
								$('#evote').html('Your Vote has been casted successfully!');
								$('#evote').show().delay(2000).fadeOut();
								$('#cnic').val('');
								$('#castvote').delay(2000).slideToggle(function(){
									$('#validatecnic').slideDown();
								});
							} 
							else{
																
								$('#evote').html('Theres some error in casting your vote! Please try again');
								$('#evote').show().delay(2000).fadeOut();
							}
							
					   }
				 });

		});



    </script>
    <!-- /jquery.inputmask -->
	    <script>
      $(document).ready(function() {
        $(":input").inputmask();
      });
    </script>
			
			
										
										
									
								</script>
								
								<!-- Custom Scripts -->

</body>
</html>

<?php

		
	}
	else
	{
		header("Location: ../");
	}
?>
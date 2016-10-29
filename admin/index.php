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
                <h3>HOME</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>DASHBOARD</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
				  <!-- Content -->
                  <div class="x_content">
                      
					  <div class="row">
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#F5233E;">
							<h3>15</h3>
							<div class="dcarddiv">
								<h4>Cities</h4>
								<img src="images/icons/city.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#1EBFAE;">
							<h3>75</h3>
							<div class="dcarddiv">
								<h4>Constituency</h4>
								<img src="images/icons/constituency.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#FFB53E;">
							<h3>150</h3>
							<div class="dcarddiv">
								<h4>Towns</h4>
								<img src="images/icons/town.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#30A5FF;">
							<h3>150</h3>
							<div class="dcarddiv">
								<h4>Polling Stations</h4>
								<img src="images/icons/polling.png" alt="cities" />
							</div>
						</div>
					  </div>
					  
					  <div class="row">
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#30A5FF;">
							<h3 id="totalVoters">150k</h3>
							<div class="dcarddiv">
								<h4>Voters</h4>
								<img src="images/icons/voter.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#FFB53E;">
							<h3>15</h3>
							<div class="dcarddiv">
								<h4>R.O</h4>
								<img src="images/icons/ro.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#1EBFAE;">
							<h3>7</h3>
							<div class="dcarddiv">
								<h4>Political Parties</h4>
								<img src="images/icons/party.png" alt="cities" />
							</div>
						</div>
						<div class="col-xs-12 col-md-3 dcard" style="background-color:#F5233E;">
							<h3>525</h3>
							<div class="dcarddiv">
								<h4>Nominees</h4>
								<img src="images/icons/nominee.png" alt="cities" />
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
    
	<!-- Custom AJAX request jquery code -->
	
		<script>
			
			$( document ).ready(function() {
				
					$.ajax({
					   type: "POST",
					   url: 'scripts/voter.php',
					   data: {countvoter : 'countvoter'},		//sending 'countvoter' token so that php know what to do
					   success: function(data)
					   {
							$('#totalVoters').text(data);
					   }
					});
				
			});
			
		</script>
	
	<!-- Custom AJAX request jquery code -->

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>

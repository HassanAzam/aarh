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
	<!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Switchery -->
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">

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
		.notification
		{
			background-color:#1ABB9C; color:white; padding:10px; margin-bottom:20px; font-weight:bold;
			display:none;
		}
	</style>
  </head>

    <?php require('sidenav.php'); ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Voters</h3>
				</br>
				<div class="notification" id="notif">
				
				</div>
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
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Voter</h2>
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
				  
				  <div class="x_content">
                    <br>
                    <form class="form-horizontal form-label-left" id="addVoterForm">

						<input type="hidden" name="action" value="addvoter" />
						
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Enter CNIC</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" name="cnic" data-inputmask="'mask': '99999-9999999-9'" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
					
					
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Name</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="name" placeholder="Enter your name" required>
                        </div>
                      </div>
					  
					  
                      <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Gender
                        </label>

                        <div class="col-md-9 col-sm-9 col-xs-12">
                          
                          
                          <div class="radio">
                            <label>
                              <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="gender" value="m" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> MALE
                            </label>
                          </div>
                          <div class="radio">
                            <label>
                              <div class="iradio_flat-green" style="position: relative;"><input type="radio" class="flat" name="gender" vlaue="f" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> FEMALE
                            </label>
                          </div>
                        </div>
                      </div>
					  
					  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <input type="text" class="form-control" name="address" placeholder="Enter your address" required>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Enter Mobile Number</label>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                          <input type="text" class="form-control" name="mobile" data-inputmask="'mask': '9999-9999999'" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select City</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="cityID" id="listcities">
                            <!-- data from DB -->
                          </select>
                        </div>
                      </div>
					  
					  <!--
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Custom</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_single form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option></option>
                            <option value="AK">Alaska</option>
                            <option value="HI">Hawaii</option>
                            <option value="CA">California</option>
                            <option value="NV">Nevada</option>
                            <option value="OR">Oregon</option>
                            <option value="WA">Washington</option>
                            <option value="AZ">Arizona</option>
                            <option value="CO">Colorado</option>
                            <option value="ID">Idaho</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NM">New Mexico</option>
                            <option value="ND">North Dakota</option>
                            <option value="UT">Utah</option>
                            <option value="WY">Wyoming</option>
                            <option value="AR">Arkansas</option>
                            <option value="IL">Illinois</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="OK">Oklahoma</option>
                            <option value="SD">South Dakota</option>
                            <option value="TX">Texas</option>
                          </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 343px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-embn-container"><span class="select2-selection__rendered" id="select2-embn-container"><span class="select2-selection__placeholder">Select a state</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                      </div>
					  -->
					  
					  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Town</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_group form-control select2-hidden-accessible" id="listtown" name="townid" tabindex="-1" aria-hidden="true">
                            
                          </select>
                        </div>
                      </div>
                                     

                        

                      


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          
                          <button type="submit" class="btn btn-success">Add Voter</button>
                        </div>
                      </div>

                    </form>
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
	<!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
	<script src="vendors/switchery/dist/switchery.min.js"></script>
	<!-- jquery.inputmask -->
    <script src="vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    
	<!-- custom jquery for ajax requests -->
	
	
	<script>
		
		//------------------------------------------------------------------------------------
		//AddVoterScript
		
		$("#addVoterForm").submit(function(e) {

		var url = "scripts/voter.php"; // the script we handle the form input.

		$.ajax({
			   type: "POST",
			   url: url,
			   data: $("#addVoterForm").serialize(), // serializes the form's elements.
			   success: function(data)
			   {
					$('#notif').text(data);	
					$('#notif').show().delay(2000).fadeOut();
			   }
			 });

		e.preventDefault(); // avoid to execute the actual submit of the form.
			});
			
			function getTown(cityid){
			//get constituencies of selected city
			$('#listtown').html('');
				$.ajax({
				   type: "POST",
				   url: 'scripts/town.php',
				   data: { listtown : 'listtown', cid : cityid}, 
				   success: function(data)
				   {
						$('#listtown').html(data);	
						
				   }
				 });
			}
			
		$( document ).ready(function() {
				
				$.ajax({
				   type: "POST",
				   url: 'scripts/city.php',
				   data: { listcities : 'listcities'}, // serializes the form's elements.
				   success: function(data)
				   {
						$('#listcities').html(data);	
				   }
			 });
		
				$('#listcities').change(function(){
					getTown($(this).val());
					console.log($(this).val());
				});
			});
			
		
		//--------------------------------------------------------------------------------------
			
	</script>
	<!-- /custom jquery for ajax requests -->
	
	
	
	<!-- jquery.inputmask -->
    <script>
      $(document).ready(function() {
        $(":input").inputmask();
      });
    </script>
    <!-- /jquery.inputmask -->
	
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>

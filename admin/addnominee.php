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
                <h3>Manage Nominees</h3>
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add Nominee </h2>
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


                    <!-- Smart Wizard -->
                    <p>Process to Select Nominee</p>
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                                              Step 1<br />
                                              <small>Select person by entering CNIC</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                                              Step 2<br />
                                              <small>Choose Party</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Assign Constituency</small>
                                          </span>
                          </a>
                        </li>
                        
                      </ul>
                      <div id="step-1" style="overflow:hidden;">
                        <form class="form-horizontal form-label-left">
							</br></br>
                          <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-3">Enter CNIC</label>
                        <div class="col-md-6 col-sm-6 col-xs-9">
                          <input type="text" class="form-control" id="cnic" data-inputmask="'mask': '99999-9999999-9'" required>
                          <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                        </div>
                      </div>
					  
					  			  
					  
                        </form>

                      </div>
                      <div id="step-2" style="overflow:hidden;">
                        
						<h2>Choose Party</h2>
						
						<div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Party</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="partyid" id="listparty">
                            
                          </select>
                        </div>
                      </div>
						
                      </div>
					  
                      <div id="step-3">
                        <form class="form-horizontal form-label-left">
							</br></br>
                          
						  <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Constituency</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="constid" id="listconst">
                           
                          </select>
                        </div>
                      </div>
					  
					  
                    </form>
                      </div>
                     

                    </div>
                    <!-- End SmartWizard Content -->

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
    <!-- jQuery Smart Wizard -->
    <script src="vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	
	
	
	<!-- jquery.inputmask -->
    <script>
      $(document).ready(function() {
        $(":input").inputmask();
		
		$.ajax({
			   type: "POST",
			   url: 'scripts/const.php',
			   data: { listallconst : 'listallconst'}, // serializes the form's elements.
			   success: function(data)
			   {
					$('#listconst').html(data);	
			   }
			 });
			 
		$.ajax({
			   type: "POST",
			   url: 'scripts/party.php',
			   data: { listallparty : 'listallparty'}, // serializes the form's elements.
			   success: function(data)
			   {
					$('#listparty').html(data);	
					alert(data);
			   }
			 });
		
		
		
		
      });
    </script>
    <!-- /jquery.inputmask -->
	
	<!-- jQuery Smart Wizard -->
    <script>
      $(document).ready(function() {
        $('#wizard').smartWizard();

        $('#wizard_verticle').smartWizard({
          transitionEffect: 'slide'
        });

        $('.buttonNext').addClass('btn btn-success');
        $('.buttonPrevious').addClass('btn btn-primary');
        $('.buttonFinish').addClass('btn btn-default');
		$('.buttonFinish').attr('id','finish');

		
		
		
		$('#finish').click(function(){
			var cnic = $('#cnic').val();
			var partyid = $('#listparty').val();
			var constid = $('#listconst').val();
			console.log(cnic);
			console.log(partyid);
			console.log(constid);
			$.ajax({
				   type: "POST",
				   url: 'scripts/nominee.php',
				   data: {action : 'addnominee', cnic: cnic, partyid:partyid, constid : constid}, 
				   success: function(data)
				   {
						$('#notif').text(data);
						$('#notif').show().delay(2000).fadeOut();
						
				   }
				 });
			});
		

      });
	  
    </script>
    <!-- /jQuery Smart Wizard -->
	
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
  </body>
</html>

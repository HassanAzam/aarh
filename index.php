
<!doctype html>
<html>
	<head>
		<title>HOME - E-Voting System</title>
		
		<style>
		
			*
			{
				margin:0;
				padding:0;
			}
			
			.bg
			{
				background-image:url('images/mainbg.jpg');
				background-size:cover;
				
			}
			
			.sidepanel
			{
				background-color:#166AB3;
				width:500px;
				height:600px;
			}
			
			
			.form {
				  position: relative;
				  z-index: 1;
				  background: #FFFFFF;
				  max-width: 360px;
				  margin: 0 auto 30px;
				  padding: 45px;
				  text-align: center;
				  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
				}
				.form input {
				  font-family: "Roboto", sans-serif;
				  outline: 0;
				  background: #f2f2f2;
				  width: 100%;
				  border: 0;
				  margin: 0 0 15px;
				  padding: 15px;
				  box-sizing: border-box;
				  font-size: 14px;
				}
				.form button {
				  font-family: "Roboto", sans-serif;
				  text-transform: uppercase;
				  outline: 0;
				  background: #166AB3;
				  width: 100%;
				  border: 0;
				  padding: 15px;
				  color: #FFFFFF;
				  font-size: 14px;
				  -webkit-transition: all 0.3 ease;
				  transition: all 0.3 ease;
				  cursor: pointer;
				}
				.form button:hover,.form button:active,.form button:focus {
				  background: #166AFF;
				}
				.form .message {
				  margin: 15px 0 0;
				  color: #b3b3b3;
				  font-size: 12px;
				}
				.form .message a {
				  color: #166AB3;
				  text-decoration: none;
				}
				
				
			.headline{
				background-color:#fff;
				height:50px;
				text-align:center;
				color:#166AB3;
				font-size:25px;
				font-family:sans-serif;
				font-weight:bold;
				text-transform:uppercase;
				padding-top:20px;
			}
			
			.m{
				  font-family: "Roboto", sans-serif;
				  text-transform: uppercase;
				  outline: 0;
				  background: red;
				  text-align:left;
				  border: 0;
				  padding: 15px;
				  color: #FFFFFF;
				  font-size: 14px;
				  -webkit-transition: all 0.3 ease;
				  transition: all 0.3 ease;
				  cursor: pointer;
				}
			
		</style>
	</head>
	
	<?php
	
	require('admin/scripts/connection.php');
	session_start();

	
	$msg = "";
	$m = false;
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['cnic']) && isset($_POST['pkey']))
		{
				$cnic = $_POST['cnic'];
				$pkey = $_POST['pkey'];
				
				//Validating CNIC and key from database
				
				$q = "SELECT CNIC,proctoringKey FROM ro WHERE CNIC='$cnic'";
				
				$r = $mysqli->query($q);
				
				$row = $r->fetch_row();
				
				if($row[1]==$pkey)
				{
					echo $row[1];
					$_SESSION['valid'] = true;
					$_SESSION['cnic'] = $row[0];
					$_SESSION['pkey'] = $row[1];
					
					header('Location: votingportal/dashboard.php');
				}
				else
				{
					$msg = "Please provide correct CNIC or Proctoring Key";
					$m = true;
				}
		}
		
		/*else
		{
			$msg = "Error";
			$m = true;
		}*/
		
	}
		  
    ?>
	
	<body class="bg">
	
	
	
		<div class="sidepanel">
		
			<div class="headline">
			Welcome to E-Voting System
			</div>
			
			</br></br></br></br>
			
			<div class="headline" style="color:#fff; background-color:#166AB3;">
			Login to Voting Portal
			</div>
			
			
			
			<div class="form">
				
				<form class="login-form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
				<input type="text" class="form-control" name="cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="Enter CNIC" required>
				<input type="password" placeholder="Proctoring Key" name="pkey" required/>
				  <button type="submit" name="submit">login</button>
				  <p class="message">Forgot Key? <a href="#">Click Here</a></p>
				  </br>
				  
				  <?php
				  
				  if($m == true)
					echo '<div class="m">'.$msg.'</div>';
				
				  ?>
				  
				</form>
			</div>
			
			<div class="headline" style="background-color:#5F5A61; color:#fff; font-size:15px;">
			Election Commission - ALL RIGHTS RESERVED
			</div>
			
		</div>
		
	<!-- jQuery -->
    <script src="admin/vendors/jquery/dist/jquery.min.js"></script>
		
	<!-- jquery.inputmask -->
    <script src="admin/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
	<!-- jquery.inputmask -->
    <script>
      $(document).ready(function() {
        $(":input").inputmask();
      });
    </script>
    <!-- /jquery.inputmask -->
	
	</body>
</html>
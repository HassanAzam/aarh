<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin | Login</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
	<style>
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
	
	require('scripts/connection.php');
	session_start();

	
	$msg = "";
	$m = false;
	
	if(isset($_POST['submit']))
	{
		if(isset($_POST['uname']) && isset($_POST['pw']))
		{
				$uname = $_POST['uname'];
				$pw = $_POST['pw'];
				
				//Validating CNIC and key from database
				
				$q = "SELECT password,CNIC FROM admin WHERE admin_Name = '$uname' and password = '$pw'";
				
				$r = $mysqli->query($q);
				
				$row = $r->fetch_row();
				
				if($row[0]==$pw)
				{
					echo $row[1];
					$_SESSION['valid'] = true;
					$_SESSION['adminid'] = $row[0];
					$_SESSION['cnic'] = $row[1];
					
					header('Location: index.php');
				}
				else
				{
					$msg = "Please provide correct Username or Password";
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

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form method="post" action="">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="uname" required />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="pw" required />
              </div>
              <div>
                <button class="btn btn-default submit" type="submit" name="submit">Log in</button>
                
              </div>
				<?php
				  
				  if($m == true)
					echo '<div class="m">'.$msg.'</div>';
				
				  ?>
              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Election Commission</h1>
                  <p>©2016 All Rights Reserved. </p>
                </div>
              </div>
            </form>
          </section>
        </div>

        
      </div>
    </div>
  </body>
</html>

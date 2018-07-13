<?php
require_once('../includes/php/header.php');

?>

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Registration | Unify - Responsive Website Template</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="../../assets/css/headers/header-default.css">
    <link rel="stylesheet" href="../../assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="../../assets/plugins/animate.css">
    <link rel="stylesheet" href="../../assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="../../assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="../../assets/css/pages/page_log_reg_v1.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../../assets/css/custom.css">
    
    <?php
		require_once('../includes/php/navmenu.php');
		
		
		

	?>
</head> 

<body>    

<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header">
        
            

           
    </div>
    <!--=== End Header ===-->

    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Registration</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Pages</a></li>
                <li class="active">Registration</li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->
    
<?php

if (isset($_SESSION['user_id'])) {
	
	require('../includes/php/connectwrite.php');
	$query = "SELECT user_type FROM users WHERE user_id = " . $_SESSION['user_id'] . "";
				
	$data = mysqli_query($dbc, $query);
	if (mysqli_num_rows($data) == 1) { 
		while ($row = mysqli_fetch_array($data)) {
			
			$user_type = $row['user_type'];
			
			if($user_type>=3) {	//User is an admin and can do stuff on this page.
			require_once('../includes/php/adminmenu.php');	
				
				if (isset($_POST['add_duration'])) {//admin submitted to add a new duration
					$duration_added = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['duration'])));
					
					$query = "SELECT duration FROM course_duration WHERE duration = '" . $duration_added . "'";
					
					
					$data = mysqli_query($dbc, $query);
					
					if (mysqli_num_rows($data) == 0) {
						
						
						
						$query="INSERT INTO course_duration(duration) VALUES('" . $duration_added . "')";
						
						mysqli_query($dbc,$query);
						
						
						;
					}
					else {//duration already exists
						echo 'Duration already exists';
					}
				}
				
				if (isset($_POST['delete_duration'])) {//admin submitted to delete selected duration
					$duration_deleted = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['duration'])));
					
					$query = "SELECT course_name FROM course_catalog WHERE duration_id = '" . $duration_deleted . "'";
					
					
					$data = mysqli_query($dbc, $query);
					
					if (mysqli_num_rows($data) == 0) {
						
						
						
						$query="UPDATE course_duration SET deleted = true WHERE duration_id = '" . $duration_deleted . "'";
						
						mysqli_query($dbc,$query);
						
						
						
					}
					else {//courses are using duration, cannot delete
						echo 'Duration is being used, cannot delete';
					}
				}
				
				?>
				<div class="container">
						<form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
							<div class="modal-header">
								<h4>Admin <small>Manage Durations</small></h4>
								
							</div> <!-- modal-header -->
							<div class="modal-body">
							
								<!-- First Name -->
								<div class="form-group">
									
										<label for="duration" class="col-lg-2 control-label">Add Duration</label>
										<div class="col-lg-12">
											<input type="text" class="form-control" maxlength="40" name="duration" id="duration" />
										</div>
									
								</div>
											
							</div>  <!-- Modal Body -->
                            
                            
                            
                            
                            
							<div class="modal-footer">
								
								<input type="submit" id="add_duration" class = "btn btn-danger" name="add_duration" value="Add" />
								
								
								
								
								
								
							</div> <!-- moda-footer -->
							<span class='msg'><?php echo $sign_up_msg; ?></span>
						</form>
                        <form class="form-horizontal col-lg-4" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                        <?php
									
								echo '<table class="table table-striped">';
								
									$query2 = "SELECT duration_id, duration FROM course_duration WHERE deleted != 1";
									$data2 = mysqli_query($dbc, $query2);
										while ($row = mysqli_fetch_array($data2)) {
											
											$duration_id = $row['duration_id'];
											$duration_name = $row['duration'];
											
											
										
										echo '<tr><td>' . $duration_name . '</td><td>Delete? <input type="radio" name="duration" value="' . $duration_id . '" /></td></tr>';
										echo '</br>';
									}
								echo '</table>';
								?>
								<div class="modal-footer">
									<input type="submit" id="delete_duration" class = "btn btn-danger" name="delete_duration" value="Delete Selected" />
								</div> <!-- moda-footer -->
							</form>
						</div>
						<?php
				
				
				
				
				
			}
			else {
			//redirect out of page
			}
	
		
		
		}//end while ($row = mysqli_fetch_array($data)) {
	}//end if (mysqli_num_rows($data) == 1) { 
	mysqli_close($dbc);
}
else {
echo 'not logged in';	
}

?>

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="../../assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->            
<script type="text/javascript" src="../../assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../../assets/plugins/smoothScroll.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="../../assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="../../assets/js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        });
</script>
<!--[if lt IE 9]>
    <script src="../../assets/plugins/respond.js"></script>
    <script src="../../assets/plugins/html5shiv.js"></script>
    <script src="../../assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
<?php require_once('../includes/php/footer.php'); ?>
</html> 
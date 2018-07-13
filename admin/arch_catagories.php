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
				
				if (isset($_POST['add_arch_catagory'])) {//admin submitted to add a new duration
					$arch_catagory_added = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['arch_catagory'])));
					
					
					$query = "SELECT arch_catagory_name FROM arch_catagories WHERE arch_catagory_name = '" . $arch_catagory_added . "'";
					
					
					$data = mysqli_query($dbc, $query);
					
					if (mysqli_num_rows($data) == 0) {
						
						
						
						$query="INSERT INTO arch_catagories(arch_catagory_name) VALUES('" . $arch_catagory_added . "')";
						
						mysqli_query($dbc,$query);
						
						
						
					}
					else {//duration already exists
						echo 'Catagory already exists';
					}
				}
				
				if (isset($_POST['delete_arch_catagory'])) {//admin submitted to delete selected catagory
					$arch_catagory_deleted = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['arch_catagory_id'])));
					
					$query = "SELECT catagory_name FROM catagories WHERE arch_catagory_id = '" . $arch_catagory_deleted . "'";
					
					
					$data = mysqli_query($dbc, $query);
					
					if (mysqli_num_rows($data) == 0) {
						
						
						
						$query="UPDATE arch_catagories SET deleted = true WHERE arch_catagory_id = '" . $arch_catagory_deleted . "'";
						
						mysqli_query($dbc,$query);
						echo 'Catagory Deleted!';
						
						
					}
					else {//courses are using duration, cannot delete
						echo 'Arch Catagory has attached catagories, it cannot be deleted';
					}
				}
				if (isset($_POST['update_arch_catagory'])) {//admin submitted to update selected catagory
					$arch_catagory_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['arch_catagory_id'])));
					$arch_catagory_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['arch_catagory'])));
					
					
					$query="UPDATE arch_catagories SET arch_catagory_name = '" . $arch_catagory_name . "' WHERE arch_catagory_id = '" . $arch_catagory_id . "'";
						
						mysqli_query($dbc,$query);
					
					
						echo 'Arch Catagory Updated!';
					
				}
				
				?>
				<div class="container">
						<form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
							<div class="modal-header">
								<h4>Admin <small>Manage Catagories</small></h4>
								
							</div> <!-- modal-header -->
							<div class="modal-body">
							
								
								<div class="form-group">
									
										<label for="arch_catagory" class="col-lg-2 control-label">Arch Catagory Name</label>
										<div class="col-lg-12">
											<input type="text" class="form-control" maxlength="40" name="arch_catagory" id="arch_catagory" />
										</div>
                                        <div class="col-lg-12">
										<input type="submit" id="add_arch_catagory" class = "btn btn-danger" name="add_arch_catagory" value="Add" />
                                        </div>
								</div>
											
							</div>  <!-- Modal Body -->
                            
                            
                            
                            
                            
							<div class="modal-footer">
								
								
							</div> <!-- moda-footer -->
							
                            
                            
                            <span class='msg'><?php echo $sign_up_msg; ?></span>
						</form>
                       
                        <?php
									
								echo '<table class="table table-striped">';
								
									$query2 = "SELECT arch_catagory_id, arch_catagory_name FROM arch_catagories WHERE deleted != 1";
									$data2 = mysqli_query($dbc, $query2);
										while ($row = mysqli_fetch_array($data2)) {
											
											$arch_catagory_id = $row['arch_catagory_id'];
											$arch_catagory_name = $row['arch_catagory_name'];
											
											
										echo '<form class="form-horizontal" method="post" action="' . $_SERVER['../PHP_SELF'] . '">';		
										echo '<tr><td><div class="modal-body">';
							
											
											echo '<div class="form-group">';
													echo '<div class="col-lg-12">';
														echo '<input type="hidden" class="form-control" maxlength="40" name="arch_catagory_id" id="arch_catagory_id" value="' . $arch_catagory_id . '" />';
													echo '</div>';
													echo '<label for="arch_catagory" class="col-lg-2 control-label">Arch Catagory Name</label>';
													echo '<div class="col-lg-12">';
														echo '<input type="text" class="form-control" maxlength="40" name="arch_catagory" id="arch_catagory" value="' . $arch_catagory_name . '" />';
													echo '</div>';
													
													
													echo '<input type="submit" id="update_arch_catagory" class = "btn btn-danger" name="update_arch_catagory" value="Update" />';
													echo '<input type="submit" id="delete_arch_catagory" class = "btn btn-danger pull-right" name="delete_arch_catagory" value="Delete" />';
											echo '</div>';
														
										echo '</div>  <!-- Modal Body -->';
										
										
										
										
										
										
										echo '<div class="modal-footer">';
											
											
										echo '</div> <!-- moda-footer --></td></tr>';
										echo '</br>';
										echo '</form>';
									}
								echo '</table>';
								?>
								
							
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
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
				if (isset($_POST['schedule-sessions'])) {//admin submitted to add a new class
					$course_selection = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['Course Selection'])));
					$instructor_selection = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['instructor_selection'])));
					$capacity = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['capacity'])));
					$sessions = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['sessions'])));
					
					
					$query="INSERT INTO scheduled_classes(course_id, instructor_id, capacity, sessions) VALUES('" . $course_selection . "','" . $instructor_selection . "','" . $capacity . "','" . $sessions . "')";
						
					mysqli_query($dbc,$query);
					
					for ($x = 0; $x <= $sessions; $x++) {
						echo "The number is: $x <br>";
					}
				
				}
				
				
					?>			
						
						
						
						
						
						
						
						
						
								
					
					<?php			
								
				
				
				
				
			}
			else {
			echo 'hmm';
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
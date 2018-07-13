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
			
			if (isset($_POST['delete_course'])) {//admin submitted to delete selected duration
					$course_deleted = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course'])));
					
					//$query = "SELECT course_name FROM course_catalog WHERE duration_id = '" . $duration_deleted . "'";
					
					
					//$data = mysqli_query($dbc, $query);
					
					//if (mysqli_num_rows($data) == 0) {
						
						
						
						$query="UPDATE course_catalog SET deleted = true WHERE course_id = '" . $course_deleted . "'";
						
						mysqli_query($dbc,$query);
						
						
						
					//}
					//else {//any dependancies on course being deleted will prevent this from being deleted
						
					//}
				}
			
			
			
			?>
			<div class="container">
            	<div class="modal-header">
                    <h4>Admin <small>Modify Courses</small></h4>
                    
                </div> <!-- modal-header -->
			   <form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
				  <?php
                        
                    echo '<table class="table table-striped">';
                    
                        $query2 = "SELECT course_id, course_name, short_description FROM course_catalog WHERE deleted != 1";
                        $data2 = mysqli_query($dbc, $query2);
                            while ($row = mysqli_fetch_array($data2)) {
                                
                                $course_id = $row['course_id'];
                                $course_name = $row['course_name'];
                                $short_description = $row['short_description'];
                                
                                
                            
                            echo '<tr><td class="col-lg-2">' . $course_name . ' - <a href="../edit_course.php?courseid=' . $course_id . '">edit</a></td><td class="col-lg-2">Delete? <input type="radio" name="course" value="' . $course_id . '" /></td></tr>';
                            echo '<tr><td colspan="3">' . $short_description . '</td></tr>';
                            echo '</br>';
                        }
                    echo '</table>';
                    ?>
                    <div class="modal-footer">
                        <input type="submit" id="delete_course" class = "btn btn-danger pull-left" name="delete_course" value="Delete Selected" />
                    </div> <!-- moda-footer -->
                </form>
            </div>
			
			
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
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
			require_once('../includes/php/schedulemenu.php');
				if (isset($_POST['schedule_course'])) {//admin submitted to add a new class
					$course_selection = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_selection'])));
					$instructor_selection = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['instructor_selection'])));
					$capacity = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['capacity'])));
					$start_date = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['start_date'])));
					$end_date = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['end_date'])));
					$notes = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['notes'])));
					
					
					
					$query="INSERT INTO scheduled_classes(course_id, user_id, capacity, start_date, end_date, notes ) VALUES('" . $course_selection . "','" . $instructor_selection . "','" . $capacity . "','" . $start_date . "','" . $end_date . "','" . $notes . "')";
						
					mysqli_query($dbc,$query);
				
				}
				
				
					?>			
						
						
						
						<div class="container">
                            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                                <div class="modal-header">
                                    <h4>Admin <small>Schedule Class</small></h4>
                                    
                                    <h2>Make sure to be in Chrome!!!</h2>
                                    
                                </div> <!-- modal-header -->
                                <div class="modal-body">
                                
                                    <!-- Course Selection -->
                                    <div class="form-group">
                                    
                                        <label for="course_selection" class="col-lg-2 control-label">Course Selection</label>
                                        <div class="col-lg-12">
                                            <select class="form-control" maxlength="4" name="course_selection" id="course_selection" >
                                            <?php
                                                $query2 = "SELECT course_id, course_name FROM course_catalog WHERE deleted != 1";
                                                $data2 = mysqli_query($dbc, $query2);
                                                    while ($row = mysqli_fetch_array($data2)) {
                                                        
                                                        $course_id = $row['course_id'];
                                                        $course_name = $row['course_name'];
                                                        echo '<option value=' . $course_id . '>' . $course_name . '</option>';
                                                    }
                                            ?>
                                            </select>
                                        </div>
                                    
                                    </div>
                                    
                                    <!-- Instructor Selection -->
                                    <div class="form-group">
                                    
                                        <label for="instructor_selection" class="col-lg-2 control-label">Instructor Selection</label>
                                        <div class="col-lg-12">
                                            <select class="form-control" maxlength="10" name="instructor_selection" id="instructor_selection" >
                                            <?php
                                                $query2 = "SELECT user_id, first_name, last_name FROM users WHERE user_type >= 2";
                                                $data2 = mysqli_query($dbc, $query2);
                                                    while ($row = mysqli_fetch_array($data2)) {
                                                        
                                                        $user_id = $row['user_id'];
                                                        $user_first_name = $row['first_name'];
														$user_last_name = $row['last_name'];
                                                        echo '<option value=' . $user_id . '>' . $user_last_name . ', ' . $user_first_name . '</option>';
                                                    }
                                            ?>
                                            </select>
                                        </div>
                                    
                                    </div>
                                    
                                    <!-- Capacity-->
                                    <div class="form-group">
                                    
                                        <label for="capacity" class="col-lg-2 control-label">Student Capacity</label>
                                        <div class="col-lg-12">
                                            <input type="int" class="form-control" maxlength="2" name="capacity" id="capacity" required="required" />
                                        </div>
                                    
                                    </div>
                                    
                                    <!-- Start Date-->
                                    <div class="form-group">
                                    
                                        <label for="start_date" class="col-lg-2 control-label">Start Date</label>
                                        <div class="col-lg-12">
                                            <input type="date" class="form-control" name="start_date" id="start_date" required="required" />
                                        </div>
                                    
                                    </div>
                                    
                                    <!-- End Date-->
                                    <div class="form-group">
                                    
                                        <label for="end_date" class="col-lg-2 control-label">End Date</label>
                                        <div class="col-lg-12">
                                            <input type="date" class="form-control" name="end_date" id="end_date" required="required" />
                                        </div>
                                    
                                    </div>
                                    
                                    <div class="form-group">
                                    
                                        <label for="notes" class="col-lg-2 control-label">Notes(ie. simple schedule)</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" maxlength="300" name="notes" id="notes" required="required" />
                                        </div>
                                    
                                    </div>
                                   
                                    
                                    
                                    
                                </div>  <!-- Modal Body -->
                                <div class="modal-footer">
                                    
                                    <input type="submit" id="schedule_course" class = "btn btn-danger" name="schedule_course" value="Schedule Course" />
                                    
                                    
                                    
                                    
                                    
                                    
                                </div> <!-- moda-footer -->
                                <span class='msg'><?php echo $sign_up_msg; ?></span>
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
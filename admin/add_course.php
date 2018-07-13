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
				if (isset($_POST['add-class'])) {//admin submitted to add a new class
					$course_title = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_title'])));
					$course_duration = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_duration'])));
					$short_description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['short_description'])));
					$long_description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['long_description'])));
					$prerequisites = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['prerequisites'])));
					$topics = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['topics'])));
					$related_certs = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['related_certs'])));
					$price = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['price'])));
					
					
					$query="INSERT INTO course_catalog(course_name, duration_id, short_description, description, prerequisites, topics, related_certs, course_price) VALUES('" . $course_title . "','" . $course_duration . "','" . $short_description . "','" . $long_description . "','" . $prerequisites . "','" . $topics . "','" . $related_certs . "','" . $price . "')";
						
					mysqli_query($dbc,$query);
					
				
				}
				
				
					?>			
						
						
						
						<div class="container">
                            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                                <div class="modal-header">
                                    <h4>Admin <small>Add Course</small></h4>
                                    
                                </div> <!-- modal-header -->
                                <div class="modal-body">
                                
                                    <!-- First Name -->
                                    <div class="form-group">
                                        
                                            <label for="course_title" class="col-lg-2 control-label">Course Title</label>
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control" maxlength="40" name="course_title" id="course_title" />
                                            </div>
                                        
                                    </div>
                                    
                                    <!-- Last Name -->
                                    <div class="form-group">
                                    
                                        <label for="course_duration" class="col-lg-2 control-label">Course Duration</label>
                                        <div class="col-lg-12">
                                            <select class="form-control" maxlength="40" name="course_duration" id="course_duration" >
                                            <?php
                                                $query2 = "SELECT duration_id, duration FROM course_duration WHERE deleted != 1";
                                                $data2 = mysqli_query($dbc, $query2);
                                                    while ($row = mysqli_fetch_array($data2)) {
                                                        
                                                        $duration_id = $row['duration_id'];
                                                        $duration_name = $row['duration'];
                                                        echo '<option value=' . $duration_id . '>' . $duration_name . '</option>';
                                                    }
                                            ?>
                                            </select>
                                        </div>
                                    
                                    </div>
                                    
                                    <!-- email -->
                                    <div class="form-group">
                                    
                                        <label for="short_description" class="col-lg-2 control-label">Short Description</label>
                                        <div class="col-lg-12">
                                            <textarea rows="4" class="form-control" maxlength="300" name="short_description" id="short_description" ></textarea>
                                        </div>
                                    
                                    </div>
                                        
                                        
                                    <!-- password -->
                                    <div class="form-group">
                                    
                                        <label for="long_description" class="col-lg-2 control-label">Long Description</label>
                                        <div class="col-lg-12">
                                            <textarea rows="6" class="form-control" name="long_description" id="long_description" ></textarea>
                                        </div>
                                    
                                    </div>
                                
                                 <!-- confirm password-->
                                    <div class="form-group">
                                    
                                        <label for="prerequisites" class="col-lg-2 control-label">Prerequisites (deliniate with a : )</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" maxlength="300" name="prerequisites" id="prerequisites" />
                                        </div>
                                    
                                    </div>
                                    <!-- confirm password-->
                                    <div class="form-group">
                                    
                                        <label for="topics" class="col-lg-2 control-label">Topics <br/>(deliniate with a : )</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" maxlength="300" name="topics" id="topics" />
                                        </div>
                                    
                                    </div>
                                    <!-- confirm password-->
                                    <div class="form-group">
                                    
                                        <label for="related_certs" class="col-lg-2 control-label">Related Certs (deliniate with a : )</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" maxlength="300" name="related_certs" id="related_certs" />
                                        </div>
                                    
                                    </div>
                                    <!-- Price-->
                                    <div class="form-group">
                                    
                                        <label for="related_certs" class="col-lg-2 control-label">Price</label>
                                        <div class="col-lg-12">
                                            <input type="text" class="form-control" maxlength="10" name="price" id="price" />
                                        </div>
                                    
                                    </div>
                                    
                                </div>  <!-- Modal Body -->
                                <div class="modal-footer">
                                    
                                    <input type="submit" id="add-class" class = "btn btn-danger" name="add-class" value="Add Class" />
                                    
                                    
                                    
                                    
                                    
                                    
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
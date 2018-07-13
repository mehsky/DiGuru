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
				
				
				
				if (isset($_POST['edit_course'])) {//admin submitted to edit a class
					$course_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_id'])));
					$course_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_title'])));
					$duration_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_duration'])));
					$short_description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['short_description'])));
					$description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['long_description'])));
					$prerequisites = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['prerequisites'])));
					$topics = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['topics'])));
					$related_certs = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['related_certs'])));
					$price = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['price'])));
					
					
					$query="UPDATE course_catalog SET course_name = '" . $course_name . "', duration_id = '" . $duration_id . "', short_description = '" . $short_description . "', description = '" . $description . "', prerequisites = '" . $prerequisites . "', topics = '" . $topics . "', related_certs = '" . $related_certs . "', course_price = '" . $course_price . "'  WHERE course_id = '" . $course_id . "'";
						
						mysqli_query($dbc,$query);
					
				}//if (isset($_POST['edit-class'])) {//admin submitted toedit a class
				
				else if (isset($_POST['add_sub_catagory'])){
					$sub_catagory_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['sub_catagory_id'])));
					$course_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_id'])));
					$course_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_name'])));
					$duration_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_duration'])));
					$short_description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['short_description'])));
					$description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['description'])));
					$prerequisites = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['prerequisites'])));
					$topics = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['topics'])));
					$related_certs = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['related_certs'])));
					$price = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['price'])));
					
					$query2 = "SELECT assigned_sub_catagory_id FROM assigned_sub_catagories WHERE sub_catagory_id = '" . $sub_catagory_id . "' AND course_id = '" . $course_id . "'";
						
						$data2 = mysqli_query($dbc, $query2);
					if (mysqli_num_rows($data2) == 1) {
						echo 'already added';
					}
					else {
						
						$query="INSERT INTO assigned_sub_catagories(course_id, sub_catagory_id) VALUES('" . $course_id . "','" . $sub_catagory_id . "')";
						echo $query;
						mysqli_query($dbc,$query);
					}
				}
				
				else if (isset($_POST['delete_assigned_sub_catagory'])){
					
					$assigned_sub_catagory_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['assigned_sub_catagory_id'])));
					$course_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_id'])));
					$course_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_name'])));
					$duration_id = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['course_duration'])));
					$short_description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['short_description'])));
					$description = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['description'])));
					$prerequisites = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['prerequisites'])));
					$topics = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['topics'])));
					$related_certs = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['related_certs'])));
					$duration_deleted = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['duration'])));
					$price = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['price'])));
					
					
						
						
					
						$query="UPDATE assigned_sub_catagories SET deleted = true WHERE assigned_sub_catagory_id = '" . $assigned_sub_catagory_id . "'";
						
						mysqli_query($dbc,$query);
						
					
						
					
				}
				else {
					$course_id = strip_tags(mysqli_real_escape_string($dbc, trim($_REQUEST["courseid"])));
					
					
					if ($course_id) {
						$query2 = "SELECT course_name, duration_id, short_description, description, prerequisites, topics, related_certs, course_price FROM course_catalog WHERE course_id = '" . $course_id . "'";
						
						$data2 = mysqli_query($dbc, $query2);
							while ($row = mysqli_fetch_array($data2)) {
								
								$course_name = $row['course_name'];
								$duration_id = $row['duration_id'];
								$short_description = $row['short_description'];
								$description = $row['description'];
								$prerequisites = $row['prerequisites'];
								$topics = $row['topics'];
								$related_certs = $row['related_certs'];
								$price = $row['course_price'];
								
							}//while ($row = mysqli_fetch_array($data2)) {
					}//if ($course_id) {
				}// else { for line if (isset($_POST['edit-class'])) {//admin submitted to add a new class
				
				?>
                
                <div class="container">
                    <form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                        <div class="modal-header">
                            <h4>Admin <small>Edit Course</small></h4>
                            
                        </div> <!-- modal-header -->
                        <div class="modal-body">
                        
                            <!-- First Name -->
                            <div class="form-group">
                                
                                    <label for="course_title" class="col-lg-2 control-label">Course Title</label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" maxlength="40" name="course_title" id="course_title" value="<?php echo $course_name; ?>" />
                                    </div>
                                
                            </div>
                            
                            <!-- Last Name -->
                            <div class="form-group">
                            
                                <label for="course_duration" class="col-lg-2 control-label">Course Duration</label>
                                <div class="col-lg-12">
                                    <select class="form-control" maxlength="4" name="course_duration" id="course_duration" >
                                    <?php
                                        $query2 = "SELECT duration_id, duration FROM course_duration WHERE deleted != 1";
                                        $data2 = mysqli_query($dbc, $query2);
                                            while ($row = mysqli_fetch_array($data2)) {
                                                
                                                $duration_id2 = $row['duration_id'];
                                                $duration_name = $row['duration'];
                                                echo '<option value="' . $duration_id2 . '" ';
												
													if ($duration_id == $duration_id2) {
														echo 'selected="selected"';
													}
												
												echo '>' . $duration_name . '</option>';
                                            }
                                    ?>
                                    </select>
                                </div>
                            
                            </div>
                            
                            <!-- email -->
                            <div class="form-group">
                            
                                <label for="short_description" class="col-lg-2 control-label">Short Description</label>
                                <div class="col-lg-12">
                                    <textarea rows="4" class="form-control" maxlength="300" name="short_description" id="short_description"><?php echo $short_description; ?></textarea>
                                </div>
                            
                            </div>
                                
                                
                            <!-- password -->
                            <div class="form-group">
                            
                                <label for="long_description" class="col-lg-2 control-label">Long Description</label>
                                <div class="col-lg-12">
                                    <textarea rows="6" class="form-control" name="long_description" id="long_description" ><?php echo $description; ?></textarea>
                                </div>
                            
                            </div>
                        
                         <!-- confirm password-->
                            <div class="form-group">
                            
                                <label for="prerequisites" class="col-lg-2 control-label">Prerequisites (deliniate with a : )</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" maxlength="300" name="prerequisites" id="prerequisites" value="<?php echo $prerequisites; ?>"/>
                                </div>
                            
                            </div>
                            <!-- confirm password-->
                            <div class="form-group">
                            
                                <label for="topics" class="col-lg-2 control-label">Topics <br/>(deliniate with a : )</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" maxlength="300" name="topics" id="topics" value="<?php echo $topics; ?>"/>
                                </div>
                            
                            </div>
                            <!-- confirm password-->
                            <div class="form-group">
                            
                                <label for="related_certs" class="col-lg-2 control-label">Related Certs (deliniate with a : )</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" maxlength="300" name="related_certs" id="related_certs" value="<?php echo $related_certs; ?>"/>
                                </div>
                            
                            </div>
                            <!-- confirm password-->
                            <div class="form-group">
                            
                                <label for="related_certs" class="col-lg-2 control-label">Price</label>
                                <div class="col-lg-12">
                                    <input type="text" class="form-control" maxlength="10" name="price" id="price" value="<?php echo $price; ?>"/>
                                </div>
                            
                            </div>
                            <!-- hidden course id-->
                            <div class="form-group">
                            	
                                <div class="col-lg-12">
                                    <input type="hidden" class="form-control" maxlength="25" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
                                </div>
                            
                            </div>
                            
                        </div>  <!-- Modal Body -->
                        <div class="modal-footer">
                            
                            <input type="submit" id="edit_course" class = "btn btn-danger" name="edit_course" value="Edit Course" />
                            
                            
                            
                            
                            
                            
                        </div> <!-- moda-footer -->
                        <span class='msg'><?php echo $sign_up_msg; ?></span>
                    </form>
                </div>
                
                
                <div class="container">
						<form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
							<div class="modal-header">
								<h4>Admin <small>Manage Sub Catagories</small></h4>
								
							</div> <!-- modal-header -->
							<div class="modal-body">
							
								
								<div class="form-group">
                                <?php
                                echo '<label for="catagory" class="col-lg-2 control-label">Add Sub Catagory</label>';
									echo '<div class="col-lg-4">';
										echo '<select class="form-control" name="sub_catagory_id" id="sub_catagory_id">';
										
											$query3 = "SELECT sub_catagory_id, sub_catagory_name FROM sub_catagories WHERE deleted != 1";
											$data3 = mysqli_query($dbc, $query3);
												while ($row2 = mysqli_fetch_array($data3)) {
													
													$sub_catagory_id2 = $row2['sub_catagory_id'];
													$sub_catagory_name = $row2['sub_catagory_name'];
													
													
												
												echo '<option value="' . $sub_catagory_id2 . '">' . $sub_catagory_name . '</option>';
												
											}
										  
										
										echo '</select>';
                                
                                
                                ?>
                                </div>
								<!-- hidden course id-->
                                <div class="form-group">
                                    
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="25" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="40" name="course_name" id="course_name" value="<?php echo $course_name; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="4" name="course_duration" id="course_duration" value="<?php echo $duration_id; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="short_description" id="short_description" value="<?php echo $short_description; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" name="description" id="description" value="<?php echo $description; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="prerequisites" id="prerequisites" value="<?php echo $prerequisites; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="topics" id="topics" value="<?php echo $topics; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="related_certs" id="related_certs" value="<?php echo $related_certs; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="10" name="price" id="price" value="<?php echo $price; ?>"/>
                                    </div>
                                    
                                
                                </div>			
							</div>  <!-- Modal Body -->
                            
							<div class="modal-footer">
								<input type="submit" id="add_sub_catagory" class = "btn btn-danger" name="add_sub_catagory" value="Add Sub Catagory" />
								
							</div> <!-- moda-footer -->
							
                            
                            
                         <div class="container">    
						</form>
                        <form class="form-horizontal col-lg-4" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                        <?php
									
								echo '<table class="table table-striped">';
								
									$query = "SELECT assigned_sub_catagories.assigned_sub_catagory_id, sub_catagories.sub_catagory_name " .
											"FROM assigned_sub_catagories " .
											"INNER JOIN sub_catagories USING (sub_catagory_id) " .
											"WHERE course_id = '" . $course_id . "' AND assigned_sub_catagories.deleted != 1";
											
									$data2 = mysqli_query($dbc, $query);
										while ($row = mysqli_fetch_array($data2)) {
											
											$assigned_sub_catagory_id = $row['assigned_sub_catagory_id'];
											$sub_catagory_name = $row['sub_catagory_name'];
											
											
										
											echo '<tr><td>' . $sub_catagory_name . '</td><td>Delete? <input type="radio" name="assigned_sub_catagory_id" value="' . $assigned_sub_catagory_id . '" /></td></tr>';
											echo '</br>';
										}
								echo '</table>';
								?>
                                <div class="form-group">
                                    
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="25" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="40" name="course_name" id="course_name" value="<?php echo $course_name; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="4" name="course_duration" id="course_duration" value="<?php echo $duration_id; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="short_description" id="short_description" value="<?php echo $short_description; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" name="description" id="description" value="<?php echo $description; ?>"/>
                                    </div>
                                    <div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="prerequisites" id="prerequisites" value="<?php echo $prerequisites; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="topics" id="topics" value="<?php echo $topics; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="300" name="related_certs" id="related_certs" value="<?php echo $related_certs; ?>"/>
                                    </div><div class="col-lg-12">
                                        <input type="hidden" class="form-control" maxlength="10" name="price" id="price" value="<?php echo $price; ?>"/>
                                    </div>
                                    
                                
                                </div>	
								<div class="modal-footer">
									<input type="submit" id="delete_assigned_sub_catagory" class = "btn btn-danger" name="delete_assigned_sub_catagory" value="Delete Selected" />
								</div> <!-- moda-footer -->
							</form>
                            </div>
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
<?php
	require_once('../includes/php/header.php');
	
	require_once('../includes/php/connectread.php');
	
	$course_id = strip_tags(mysqli_real_escape_string($dbc, trim($_REQUEST["courseid"])));
	$catagory_id = strip_tags(mysqli_real_escape_string($dbc, trim($_REQUEST["catagoryid"])));
	$catagory_name = strip_tags(mysqli_real_escape_string($dbc, trim($_REQUEST["catagoryname"])));
	
	$query = "SELECT course_catalog.course_name, course_duration.duration, course_catalog.short_description, course_catalog.description, course_catalog.prerequisites, " .
			 "course_catalog.topics, course_catalog.related_certs, course_catalog.course_price " .
			 "FROM course_catalog " .
			 "INNER JOIN course_duration USING (duration_id) " .
			 "WHERE course_id = '" . $course_id . "'";

	  $data = mysqli_query($dbc, $query);
			if (mysqli_num_rows($data) == 1) { 
			  while ($row = mysqli_fetch_array($data)) {
				  
				  $course_name = $row['course_name'];
				  $course_duration = $row['course_duration'];
				  $short_description = $row['short_description'];
				  $description = $row['description'];
				  $prerequisites = $row['prerequisites'];
				  $topics = $row['topics'];
				  $related_certs = $row['related_certs'];
				  $course_price = $row['course_price'];
				 
				  
			  }
	
			  
			}
			
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>DiGuru - <?php echo $course_name?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

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
    <link rel="stylesheet" href="../../assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="../../assets/css/pages/portfolio-v1.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <?php
	require_once('../includes/php/navmenu.php');
	?>
</head>  

<body>    

<div class="wrapper">
    

    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><?php echo $course_name; ?></h1>
            <ul class="pull-right breadcrumb">
                <li><a href="/index">Home</a></li>
                <li><a href="/courses/collections">Training Catalog</a></li>
                <li><a href="/courses/catagory.php?catagoryid=<?php echo $catagory_id; ?>"><?php echo $catagory_name; ?></a></li>
                <li class="active"><?php echo $course_name?></li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
    <!--=== End Breadcrumbs ===-->

    <!--=== Content Part ===-->
    <div class="container content"> 	
    	<div class="margin-bottom-50"> 
            <!-- Content Info -->        
            <div class="col-md-12 md-margin-bottom-40">
                <div class="headline"><h2>Course Details</h2></div>
                <p><?php echo $description?></p>
            </div>
            <div class="row portfolio-item1 col-md-12">
                <div class="col-md-4">
                    
                        <div class="headline">
                            <h2>Topics</h2>
                        </div>
                    
                        <ul class="list-unstyled">
                        <?php $topic_array = explode(":", $topics); 
                            for($i = 0; $i < count($topic_array); $i++){
                                echo '<li><i class="glyphicon glyphicon-minus color-green"></i> ' . $topic_array[$i] . '</li>';
                            }
                        ?> 
                            
                        </ul>                    
                    
                </div>
                <div class="col-md-4">
                    
                        <div class="headline">
                            <h2>Related Certifications</h2>
                        </div>
                    
                        <ul class="list-unstyled">
                        <?php $topic_related_certs = explode(":", $related_certs); 
                            for($i = 0; $i < count($topic_related_certs); $i++){
                                echo '<li><i class="glyphicon glyphicon-minus color-green"></i> ' . $topic_related_certs[$i] . '</li>';
                            }
                        ?> 
                            
                        </ul>                    
                    
                </div>
                <div class="col-md-4">
                   
                        <div class="headline">
                            <h2>Prerequisites</h2>
                        </div>
                    
                        <ul class="list-unstyled">
                        <?php $topic_prerequisites = explode(":", $prerequisites); 
                            for($i = 0; $i < count($topic_prerequisites); $i++){
                                echo '<li><i class="glyphicon glyphicon-minus color-green"></i> ' . $topic_prerequisites[$i] . '</li>';
                            }
                        ?> 
                            
                        </ul>                    
                    
                </div>
            </div>            
                
            
            <!-- End Content Info -->        

            
        </div><!--/row-->
 					  
      	<div class="headline">
                            <h2>Upcoming Classes</h2>
                        </div>
        <div class="table-search-v1 margin-bottom-30 col-md-9">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="30px"></th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Enrollment</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = "SELECT class_id, students_enrolled, capacity, start_date, end_date, notes FROM scheduled_classes WHERE course_id = '" . $course_id . "' AND start_date >= CURDATE()";
	
	
                        $data = mysqli_query($dbc, $query);
						if ($data->num_rows === 0)
						{
							echo 'No classes scheduled';	
						}
						
                            while ($row = mysqli_fetch_array($data)) {
                                  
								  $class_id = $row['class_id'];
                                  $students_enrolled = $row['students_enrolled'];
								  $capacity = $row['capacity'];
								  $start_date = $row['start_date'];
								  $end_date = $row['end_date'];
								  $notes = $row['notes'];
							
							
								echo '
								
								<tr>
									<td>';
									if (isset($_SESSION['user_id'])) {
										echo '<a href="#" rel="shadow-radial" class="btn-u btn-u-red shadow-radial">Register</a>';
									}
									else {
										echo '<a href="/mydiguru/login.php" rel="shadow-radial" class="btn-u btn-u-red shadow-radial">Log In to Register</a>';	
									}
									echo '</td>
									<td>' . date("F d, Y",strtotime($start_date)) . '</td>
									<td>' . date("F d, Y",strtotime($end_date)) . '</td>
									<td> ' . $students_enrolled . '/' . $capacity . '</td>
									<td>' . $notes . '</td>
									
								</tr>
								
								
								';
							
							}
                                  
                                  ?>
                    
                        
                    </tbody>
                </table>
            </div>    
        </div>
        
        
        
        

        <!-- Related Courses -->
        
        <div class="headline margin-bottom-60"><h2 class="pull-left">Related Courses</h2></div>
        <?php 
			$query4 = "SELECT assigned_sub_catagories.sub_catagory_id, sub_catagories.sub_catagory_name FROM assigned_sub_catagories INNER JOIN sub_catagories USING (sub_catagory_id) WHERE course_id = '" . $course_id . "'";
				
				$data4 = mysqli_query($dbc, $query4);
				
				while ($row4 = mysqli_fetch_array($data4)) 
				{
					$sub_catagory_id = $row4['sub_catagory_id'];
					$sub_catagory_name = $row4['sub_catagory_name'];
					
					?>
								
                                <div class="margin-bottom-10"><h3 class="heading-md"><strong><?php echo $sub_catagory_name; ?></strong></h3></div>
                                
							<ul class="list-unstyled margin-bottom-30">
                            
                        	
                            
                            
                        
					
					<?php
					$query5 = "SELECT assigned_sub_catagories.course_id, catagories.catagory_id, catagories.catagory_name, course_catalog.course_name " .
					"FROM assigned_sub_catagories " .
					"INNER JOIN sub_catagories USING (sub_catagory_id) " .
					"INNER JOIN catagories USING (catagory_id) " .
					"INNER JOIN course_catalog USING (course_id) " .
					"WHERE sub_catagory_id = '" . $sub_catagory_id . "'" .
					"AND course_id != '" . $course_id . "'";
				
					$data5 = mysqli_query($dbc, $query5);
					while ($row5 = mysqli_fetch_array($data5)) 
					{
						$related_course_id = $row5['course_id'];
						$sub_catagory_id = $row5['sub_catagory_id'];
						$related_course_name = $row5['course_name'];
						$catagory_id = $row5['catagory_id'];
						$catagory_name = $row5['catagory_name'];
							echo '<li><i class="glyphicon glyphicon-minus color-green"></i><a href="/courses/class.php?courseid=' .$related_course_id . '&catagoryid=' . $catagory_id . '&catagoryname=' . $catagory_name . '">  ' . $related_course_name . '</a></li>';	
					}
					echo '</ul>';
				}
								
		?>

            
    </div><!--/container-->	 	
    <!--=== End Content Part ===-->

     <!--=== Footer Version 1 ===-->
    <div class="footer-v1">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <a href="index.html"><img id="logo-footer" class="footer-logo" src="../../assets/img/logo2-default.png" alt=""></a>
                        <p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                        <p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>    
                    </div><!--/col-md-3-->
                    <!-- End About -->

                    <!-- Latest -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="posts">
                            <div class="headline"><h2>Latest Posts</h2></div>
                            <ul class="list-unstyled latest-list">
                                <li>
                                    <a href="#">Incredible content</a>
                                    <small>May 8, 2014</small>
                                </li>
                                <li>
                                    <a href="#">Best shoots</a>
                                    <small>June 23, 2014</small>
                                </li>
                                <li>
                                    <a href="#">New Terms and Conditions</a>
                                    <small>September 15, 2014</small>
                                </li>
                            </ul>
                        </div>
                    </div><!--/col-md-3-->  
                    <!-- End Latest --> 
                    
                    <!-- Link List -->
                    <div class="col-md-3 md-margin-bottom-40">
                        <div class="headline"><h2>Useful Links</h2></div>
                        <ul class="list-unstyled link-list">
                            <li><a href="#">About us</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="#">Portfolio</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="#">Latest jobs</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="#">Community</a><i class="fa fa-angle-right"></i></li>
                            <li><a href="#">Contact us</a><i class="fa fa-angle-right"></i></li>
                        </ul>
                    </div><!--/col-md-3-->
                    <!-- End Link List -->                    

                    <!-- Address -->
                    <div class="col-md-3 map-img md-margin-bottom-40">
                        <div class="headline"><h2>Contact Us</h2></div>                         
                        <address class="md-margin-bottom-40">
                            25, Lorem Lis Street, Orange <br />
                            California, US <br />
                            Phone: 800 123 3456 <br />
                            Fax: 800 123 3456 <br />
                            Email: <a href="mailto:info@anybiz.com" class="">info@anybiz.com</a>
                        </address>
                    </div><!--/col-md-3-->
                    <!-- End Address -->
                </div>
            </div> 
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">                     
                        <p>
                            2015 &copy; All Rights Reserved.
                           <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                        </p>
                    </div>

                    <!-- Social Links -->
                    <div class="col-md-6">
                        <ul class="footer-socials list-inline">
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
                                    <i class="fa fa-skype"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
                                    <i class="fa fa-pinterest"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- End Social Links -->
                </div>
            </div> 
        </div><!--/copyright-->
    </div>     
    <!--=== End Footer Version 1 ===-->
</div><!--/wrapper-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="../../assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="../../assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../../assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="../../assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="../../assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="../../assets/js/app.js"></script>
<script type="text/javascript" src="../../assets/js/plugins/owl-recent-works.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        OwlRecentWorks.initOwlRecentWorksV1();     
    });
</script>
<!--[if lt IE 9]>
    <script src="../../assets/plugins/respond.js"></script>
    <script src="../../assets/plugins/html5shiv.js"></script>
    <script src="../../assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html> 
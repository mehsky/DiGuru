<?php
	require_once('../includes/php/header.php');
	
	require_once('../includes/php/connectread.php');
	
	
	$catagory_id = strip_tags(mysqli_real_escape_string($dbc, trim($_REQUEST["catagoryid"])));

	
	
	$query = "SELECT catagory_name, catagory_description FROM catagories WHERE catagory_id = '" . $catagory_id . "'";
	
	
	$data = mysqli_query($dbc, $query);
		if (mysqli_num_rows($data) == 1) { 
		  while ($row = mysqli_fetch_array($data)) {
			  
			  $catagory_name = $row['catagory_name'];
			  $catagory_description = $row['catagory_description'];
			  
			}
		}		
	  
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Table Search | Unify - Responsive Website Template</title>

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
    <link rel="stylesheet" href="../../assets/css/pages/page_search_inner_tables.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../../assets/css/custom.css">
     
</head> 

<body>    

<div class="wrapper">
    <?php
	require_once('../includes/php/navmenu.php');
	?>
    <!--=== Breadcrumbs ===-->
    <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left"><?php echo $catagory_name; ?> Training</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="/index">Home</a></li>
                <li><a href="/courses/collections">Training Catalog</a></li>
                <li class="active"><?php echo $catagory_name; ?></li>
            </ul>
        </div>
    </div>
    <!--=== End Breadcrumbs ===-->

    <div class="container content-sm">
                

        <!-- Begin Table Search Panel v1 -->
        <?php
        $query = "SELECT sub_catagory_id, sub_catagory_name, sub_catagory_description FROM sub_catagories WHERE catagory_id = '" . $catagory_id . "'";
	
	
		$data = mysqli_query($dbc, $query);
			if (mysqli_num_rows($data) >= 1) { 
			  while ($row = mysqli_fetch_array($data)) {
				  
				  $sub_catagory_id = $row['sub_catagory_id'];
				  $sub_catagory_name = $row['sub_catagory_name'];
				  $sub_catagory_description = $row['sub_catagory_description'];
				  
				  ?>
				  <div class="table-search-v1 panel panel-dark margin-bottom-50">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-globe"></i> <?php echo $sub_catagory_name; ?></h3>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Course Name</th>
									<th class="hidden-sm">Product description</th>
									<th>Length</th>
									<th>Price</th>
                                    <th>View Details</th>
									
								</tr>
							</thead>
							<tbody>
                            
                            	<?php
								$query2 = "SELECT course_catalog.course_id, course_catalog.course_name, course_duration.duration, course_catalog.short_description, " .
										 "course_catalog.course_price " .
										 "FROM course_catalog " .
										 "INNER JOIN course_duration USING (duration_id) " .
										 "INNER JOIN assigned_sub_catagories USING (course_id) " .
										 "WHERE sub_catagory_id = '" . $sub_catagory_id . "'";
								
							
								$data2 = mysqli_query($dbc, $query2);
									if (mysqli_num_rows($data2) >= 1) { 
									  while ($row2 = mysqli_fetch_array($data2)) {
										  
										  $course_id = $row2['course_id'];
										  $course_name = $row2['course_name'];
										  $course_duration = $row2['duration'];
										  $course_short_description = $row2['short_description'];
										  
										  $course_price = $row2['course_price'];
										  
										  ?>
								<tr>
									<td>
										<a href="/courses/class.php?courseid=<?php echo $course_id; ?>&catagoryid=<?php echo $catagory_id; ?>&catagoryname=<?php echo $catagory_name; ?>"><?php echo $course_name; ?></a>
										
									</td>
									<td class="td-width"><?php echo $course_short_description; ?></td>
									<td>
										<?php echo $course_duration; ?>    
									</td>
									<td>
										<?php echo $course_price; ?>
									</td>
                                    <td>
										<a href="/courses/class.php?courseid=<?php echo $course_id; ?>&catagoryid=<?php echo $catagory_id; ?>&catagoryname=<?php echo $catagory_name; ?>">View Details</a>
									</td>
									
								</tr>
								<?php 
									}
								}
								else {
									echo 'Currently, no classes are offered in this area.';	
								}
							?>
							
                            </tbody>
						</table>
					</div>    
				</div>
				<?php 
				}
			}
			else {
				echo 'Currently, no classes are offered in this area.';	
			}
        ?>
        
        <!-- End Table Search Panel v1 -->

        
    </div>

     
</div><!--/End Wrapepr-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/plugins/style-switcher.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        StyleSwitcher.initStyleSwitcher();      
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html> 
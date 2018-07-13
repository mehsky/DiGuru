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
				
					
					
					
				
				
				
				
					?>			
						
						
						
						<div class="container">
                            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
                                <div class="modal-header">
                                    <h4>Admin <small>Schedule Class</small></h4>
                                    
                                </div> <!-- modal-header -->
                                <div class="modal-body">
                                
                                   
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Class Id</th>
                                                <th>Course Name</th>
                                                <th>Instructor Name</th>
                                                
                                                <th>Students Capacity</th>
                                                
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th class="hidden-sm">Notes</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $query2 = "SELECT scheduled_classes.class_id, course_catalog.course_name, users.first_name, users.last_name, scheduled_classes.students_enrolled, scheduled_classes.capacity, scheduled_classes.start_date, scheduled_classes.end_date, scheduled_classes.notes, scheduled_classes.published " .
													 "FROM scheduled_classes " .
													 "INNER JOIN course_catalog USING (course_id) " .
													 "INNER JOIN users USING (user_id) " .
													 "WHERE end_date >= CURDATE() " .
													 "ORDER BY start_date";
													 
                                        
                                            $data2 = mysqli_query($dbc, $query2);
                                                if (mysqli_num_rows($data2) >= 1) { 
                                                  while ($row2 = mysqli_fetch_array($data2)) {
                                                      
                                                      $class_id = $row2['class_id'];
                                                      $course_name = $row2['course_name'];
                                                      $instructor_first_name = $row2['first_name'];
                                                      $instructor_last_name = $row2['last_name'];
                                                      $students_enrolled = $row2['students_enrolled'];
													  $capacity = $row2['capacity'];
													  $start_date = $row2['start_date'];
													  $end_date = $row2['end_date'];
													  $notes = $row2['notes'];
													  $published = $row2['published'];
                                                      
                                                      ?>
                                            <tr>
                                                <td>
                                                    <a href="/courses/edit_class.php?courseid=<?php echo $class_id; ?>"><?php echo $class_id; ?></a>
                                                    
                                                </td>
                                                <td>
                                                    <a href="/courses/edit_class.php?courseid=<?php echo $class_id; ?>"><?php echo $course_name; ?></a>
                                                    
                                                </td>
                                                <td>
                                                    <?php echo $instructor_last_name; ?>, <?php echo $instructor_first_name; ?>   
                                                </td>
                                                <td>
                                                    <?php echo $students_enrolled; ?>/<?php echo $capacity; ?>
                                                </td>
                                                <td>
                                                    <?php echo date("F d, Y",strtotime($start_date)); ?>
                                                </td>
                                                <td>
                                                    <?php echo date("F d, Y",strtotime($end_date)); ?>
                                                </td>
                                                <td class="td-width"><?php echo $notes; ?></td>
                                                <td><?php if ($published == 0){ echo 'Stasis';} else {echo 'Published';}?></td>
                                                <td>
                                                    <a href="../edit_class.php?classid=<?php echo $class_id; ?>">Edit</a>
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
                                   
                                   
                                   
                                <div class="modal-footer">
                                 
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
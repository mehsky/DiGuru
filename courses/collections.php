<?php
	require_once('../includes/php/header.php');
	
	require_once('../includes/php/connectread.php');
	
	
	
	$query = "SELECT arch_catagory_id, arch_catagory_name FROM arch_catagories WHERE deleted != 1";
	
	
	$data = mysqli_query($dbc, $query);
			
	  
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>DiGuru - Course Collections</title>

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
    <link rel="stylesheet" href="../../assets/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css">    
    <link rel="stylesheet" href="../../assets/plugins/cube-portfolio/cubeportfolio/custom/custom-cubeportfolio.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="../../assets/css/custom.css">
    <?php
	require_once('../includes/php/navmenu.php');
	?>
</head>
</head> 

<body class="header-fixed">    

<div class="wrapper">

	

    <!--=== Breadcrumbs v3 ===-->
    
        <div class="breadcrumbs">
        <div class="container">
            <h1 class="pull-left">Training Catalog</h1>
            <ul class="pull-right breadcrumb">
                <li><a href="/index">Home</a></li>
                <li class="active">Training Catalog</li>
            </ul>
        </div><!--/container-->
    </div><!--/breadcrumbs-->
   
    <!--=== End Breadcrumbs v3 ===-->

    <!--=== Cube-Portfdlio ===-->
    <div class="cube-portfolio container margin-bottom-60">
        <div class="content-xs">
            <div id="filters-container" class="cbp-l-filters-text content-xs">
                <div data-filter="*" class="cbp-filter-item-active cbp-filter-item"> All </div>
                
                <?php
				if (mysqli_num_rows($data) >= 1) { 
			
				  while ($row = mysqli_fetch_array($data)) {
					  
					  $arch_catagory_id = $row['arch_catagory_id'];
					  $arch_catagory_name = $row['arch_catagory_name'];
					  echo ' | <div data-filter=".' . $arch_catagory_id . '" class="cbp-filter-item"> ' . $arch_catagory_name . ' </div>';
				  }
		
				  
				}
				?>
                
            </div><!--/end Filters Container-->
        </div>
        <div id="grid-container" class="cbp-l-grid-agency">
        
        	<?php
			$query = "SELECT catagory_id, catagory_name, image_location, arch_catagory_id FROM catagories WHERE deleted != 1";
	
	
			$data = mysqli_query($dbc, $query);
			
			if (mysqli_num_rows($data) >= 1) { 
			
				  while ($row = mysqli_fetch_array($data)) {
					  
					  $catagory_id = $row['catagory_id'];
					  $catagory_name = $row['catagory_name'];
					  $image_location = $row['image_location'];
					  $arch_catagory_id = $row['arch_catagory_id'];
					  
					  
					  echo 
					  '<div class="cbp-item ' . $arch_catagory_id . '">
							<div class="cbp-caption margin-bottom-20">
							<a href="/courses/catagory.php?catagoryid=' . $catagory_id . '">
								<div class="cbp-caption-defaultWrap">
									<img src="../../images/collection_logos/' . $image_location . '" alt="' . $catagory_name . '">
								</div>
								<div class="cbp-caption-activeWrap"> <!-- greys out the box -->
									
								
								</div>
								</a>
							</div>
						
						<div class="cbp-title-dark">
							<div class="cbp-l-grid-agency-title">' . $catagory_name . '</div>
						</div>
					</div>';
				  }
		
				  
				}
			
			
			?>
            
            
            <!--  Template  <div class="cbp-item graphic">
                <div class="cbp-caption margin-bottom-20">
                    <div class="cbp-caption-defaultWrap">
                        <img src="../../assets/img/main/img3.jpg" alt="">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignCenter">
                            <div class="cbp-l-caption-body">
                                <ul class="link-captions no-bottom-space">
                                    <li><a href="portfolio_single_item.html"><i class="rounded-x fa fa-link"></i></a></li>
                                    <li><a href="../../assets/img/main/img3.jpg" class="cbp-lightbox" data-title="Design Object"><i class="rounded-x fa fa-search"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cbp-title-dark">
                    <div class="cbp-l-grid-agency-title">Design Object 01</div>
                    <div class="cbp-l-grid-agency-desc">Web Design</div>
                </div>
            </div> -->
            <!--/end Grid Container-->
    </div>    
    <!--=== End Cube-Portfdlio ===-->

    
</div><!--/wrapper-->

<!-- JS Global Compulsory -->           
<script type="text/javascript" src="../../assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="../../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="../../assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../../assets/plugins/smoothScroll.js"></script>
<script type="text/javascript" src="../../assets/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="../../assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="../../assets/js/app.js"></script>
<script type="text/javascript" src="../../assets/js/plugins/cube-portfolio/cube-portfolio-4.js"></script>
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
</html> 
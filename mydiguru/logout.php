<?php
	
	

	session_start();
if (isset($_SESSION['user_id'])) {
	session_unset();
	if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }
	
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]);
	}
	
	session_destroy();
}

	$cookie_expires = time()-3600;
	$cookie_path = '/';
	$cookie_domain = 'ondiguru.com';
	setcookie('user_id', '', $cookie_expires, $cookie_path, $cookie_domain, 0, 0);


	
	setcookie('first_name', '', $cookie_expires, $cookie_path, $cookie_domain, 0, 0);

	require_once('../includes/php/header.php');
        
?>



<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Login 1 | Unify - Responsive Website Template</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>


     <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="../../assets/css/headers/header-default.css">
    <link rel="stylesheet" href="../../assets/css/footers/footer-v1.css">
   
    <link rel="stylesheet" href="../../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">


    
    <link rel="stylesheet" href="../../assets/plugins/animate.css">
    <link rel="stylesheet" href="../../assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="../../assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/plugins/revolution-slider/rs-plugin/css/settings.css" type="text/css" media="screen">
    <!--[if lt IE 9]><link rel="stylesheet" href="../../assets/plugins/revolution-slider/rs-plugin/css/settings-ie8.css" type="text/css" media="screen"><![endif]-->

    <!-- CSS Page Style -->    

    <link rel="stylesheet" href="../../assets/css/pages/page_log_reg_v2.css">   

    <!-- CSS Customization -->

    <link rel="stylesheet" href="../../assets/css/custom.css">
    
    <script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="/includes/js/scripts.js"></script>
    
    
    
     <?php
	require_once('../includes/php/navmenu.php');
	?>
    
</head> 

<body>



<!--=== Content Part ===-->    

<div class="container">
    <!--Reg Block-->
    <div class="reg-block">
        <div class="reg-block-header">
            <h2>Signed Out</h2>
            <!--<ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul>-->
            
 
            
            <p>You are signed out. Click <a class="color-green" href="/mydiguru/login">Log In</a> to sign in.</p>
            <br  />
            <p>If you want to make a new account, click <a class="color-green" href="/mydiguru/sign_up">Sign Up</a>.</p>            
        </div>
		
    </div>
    
    <!--End Reg Block-->
</div><!--/container-->
<!--=== End Content Part ===-->

<?php
	
	require_once('../includes/php/scripts.php');
?>

<!-- JS Implementing Plugins -->
<script type="text/javascript" src="../../assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="../../assets/plugins/backstretch/jquery.backstretch.min.js"></script>  
<!-- JS Page Level -->         
<script type="text/javascript" src="../../assets/js/app.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        });
</script>
<script type="text/javascript">
    $.backstretch([
      "../../assets/img/bg/19.jpg",
      "../../assets/img/bg/18.jpg",
      ], {
        fade: 1000,
        duration: 7000
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</body>
</html> 






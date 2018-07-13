<?php
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
           <?php 
if ($signed_in == false) {
?>
<div class="container">
    <!--Reg Block-->
    <div class="reg-block">
        <div class="reg-block-header">
            <h2>Sign In</h2>
            <!--<ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul>-->
            
 
            
            <p>Don't Have Account? Click <a class="color-green" href="/mydiguru/sign_up">Sign Up</a> to registration.</p>            
        </div>
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER['../../PHP_SELF']?>">
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
            </div>
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
            </div>
            <div class="input-group margin-bottom-20">
                <div id="captchaKey" class="g-recaptcha" data-sitekey="6Lc9ewMTAAAAAKQd94BrRhC1y9wDHGfVrlw6q4cl"></div>
            </div>
            <div class="form-group">
                <div class="col-lg-12">
                    <?php
                        if ($passwordmsg == true) {
                            echo '<p class="text-danger">You need to enter a password!</p>';
                        }
                        if ($noemailpasswordmsg == true) {
                            echo '<p class="text-danger">You need to enter a valid email and password!</p>';
                        }
                        if ($robotmsg == true) {
                            echo '<p class="text-danger">You may be a robot, try again!</p>';
                        }
                        if ($wrongaccountinfomsg == true) {
                            echo '<p class="text-danger">You have entered either a wrong email or password.</p>';
                        }
                        echo $remembermsg;
                        if ($signed_in == true) {
                            echo '<p class="text-danger">Signed in!!</p>';
                        }
                    ?>
                    
                </div>
            </div>
    
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" id="remember"> 
                    <p>Always stay signed in</p>
                </label>            
            </div>
                                    
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <input type="submit" id="sign-in" class = "btn-u btn-block" name="submit-sign-in" value="Sign In" />
                </div>
            </div>
    	</form>
    </div>
    <?php
		}
		else {
		?>
        <div class="container">
            <!--Reg Block-->
            <div class="reg-block">
                <div class="reg-block-header">
                    <h2>Signed In</h2>
                	<p>You are signed in as <?php echo $_SESSION['first_name']; ?>. If this is not you or you want to log out click <a class="color-green" href="/mydiguru/logout">Log Out</a>.</p>
                </div>
            </div>
        </div>
		
	<?php
		}
	?>
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
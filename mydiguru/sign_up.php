<?php
	require_once('../includes/php/header.php');
	

if (isset($_POST['submit-join-us'])) {
			
		
	require_once('../includes/php/connectwrite.php');
	
	$sign_up_msg;
	$first_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['first_name'])));
	$last_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['last_name'])));
	$email = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['email'])));
	$password = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['password'])));
	$password2 = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['password2'])));
	$regex = '/@/';
	$base_url='http://www.ondiguru.com/';
	$salt;
	
	if(preg_match($regex, $email)) {
		if($password == $password2) {
			if(!empty($first_name) && !empty($last_name)) {
				require_once('../includes/php/hash.php');
				
				$activation=hash('sha256', $email.time()); // encrypted email+timestamp
				
				$hashed_pw = create_hash($password);
				
				
				$count=mysqli_query($dbc, "SELECT user_id FROM users WHERE user_email='" . $email . "'");
				// email check
				
				if(mysqli_num_rows($count) < 1) {
					$query="INSERT INTO users(user_salt,user_email,first_name,last_name,activation,join_date) VALUES('" . $hashed_pw . "','" . $email . "','" . $first_name . "','" . $last_name . "','" . $activation . "', NOW())";
					
					//mysqli_query($dbc,$query);
					//sending email
					$to=$email;
					$subject="DiGuru verification";
					$header="From:admin@ondiguru.com \r\n";
					$header .= "MIME-Version: 1.0\r\n";
					$header .= "Content-type: text/html\r\n";
					
					$body='Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get started using your Website account. <br/> <br/> <a href="'.$base_url.'/mydiguru/activation.php?code='.$activation.'">'.$base_url.'/mydiguru/activation.php?code='.$activation.'</a>';
					//$mail = Send_Mail($to,$subject,$body);
					$mail = mail ($to, $subject, $body, $header);
					
					if( $mail == true )  
				   {
					  $msg= "Registration successful, please activate email.";
				   }
				   else
				   {
					  $msg = "Message could not be sent...";
				   }
				
				}//if(mysqli_num_rows($count) < 1) {
				else
				{
				$msg= 'The email is already taken, please try new.'; 
				}
			}//if(!empty($first_name) && !empty($last_name))
			else
			{
			$msg = 'Your first and last name is required';	
			}
		}//if($password == $password2)
		else
		{
		$msg = 'Your passwords much match';	
		}

	}//if(preg_match($regex, $email)) {
	else
	{
	$msg = 'The email you have entered is invalid, please try again.'; 
	}
mysqli_close($dbc);		
}//if (isset($_POST['submit-join-us'])) {
	
	
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
            <h2>Sign Up</h2>
            <!--<ul class="social-icons text-center">
                <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
            </ul>-->
            <p>Already Signed Up? Click <a class="color-green" href="/mydiguru/login">Sign In</a> to login your account.</p>
        </div>
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER['../PHP_SELF']?>">
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
            <input type="text" required class="form-control" maxlength="40" name="first_name" id="first-name" placeholder="First Name">
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-users"></i></span>
            <input type="text" class="form-control" maxlength="40" name="last_name" id="last-name" placeholder="Last Name">
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            <input type="email" required class="form-control" maxlength="100" name="email" id="email" placeholder="Email">
        </div>
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
        </div>
        <div class="input-group margin-bottom-30">
            <span class="input-group-addon"><i class="fa fa-key"></i></span>
            <input type="password" required class="form-control" name="password2" id="password2" placeholder="Confirm Password">
        </div>
        <hr>

        <div class="checkbox">            
            <label>
                <input type="checkbox" required> 
                I read <a target="_blank" href="page_terms.html">Terms and Conditions</a>
            </label>
        </div>
                                
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <input type="submit" id="join-us" class="btn-u btn-block" name="submit-join-us" value="Join Us" />              
            </div>
        </div>
        <span class='msg'><?php echo $msg; ?></span>
        </form>
    </div>
    <!--End Reg Block-->
</div><!--/container-->
<!--/container-->
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
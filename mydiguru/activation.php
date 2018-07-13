<?php
require_once('../includes/php/connectwrite.php');;
$msg='';

if(!empty($_GET['code']) && isset($_GET['code']))
{
$code=strip_tags(mysqli_real_escape_string($dbc,$_GET['code']));
$query="SELECT user_id FROM users WHERE activation='" . $code . "'";
$c=mysqli_query($dbc, $query);

if(mysqli_num_rows($c) > 0)
{
$count=mysqli_query($dbc,"SELECT user_id FROM users WHERE activation='" . $code . "' and user_type='0'");

if(mysqli_num_rows($count) == 1)
{
mysqli_query($dbc,"UPDATE users SET user_type='1' WHERE activation='$code'");
$msg="Your account is activated"; 
}
else
{
$msg ="Your account is already active, no need to activate again";
}

}
else
{
$msg ="Wrong activation code.";
}

}
mysqli_close($dbc);
?>
//HTML Part
<?php echo $msg; ?>
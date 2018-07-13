<?php
require_once('../includes/php/header.php');
?>
<?php
require_once('../includes/php/navmenu.php');
?>



<?php
	
	
	if (isset($_POST['sign-up'])) {
		
		?>
         <div class="modal fade" id="create" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        <p>One fine body&hellip;</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php
		
		require_once('../includes/php/connectwrite.php');
	
	$private_recaptcha_key = "6Lc9ewMTAAAAAPPfb3E8tUkHIhxjOnvcfTO_FBjR";
	$first_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['first_name'])));
	$last_name = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['last_name'])));
	$email = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['email'])));
	$password = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['password'])));
	$password2 = strip_tags(mysqli_real_escape_string($dbc, trim($_POST['password2'])));
	
	
	}
?>


<?php
require_once('../includes/php/footer.php');
?>
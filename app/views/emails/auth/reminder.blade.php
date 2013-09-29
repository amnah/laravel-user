
<?php
/**
 * @var User $user
 */
?>


<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, complete this form: <?php echo URL::to('user/reset', array($user->token)); ?>
		</div>
	</body>
</html>
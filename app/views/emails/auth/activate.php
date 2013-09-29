
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
		<h2>Activate your account</h2>

		<div>
			To activate your account, click this link: <?php echo URL::to('user/activate', array($user->token)); ?>
		</div>
	</body>
</html>
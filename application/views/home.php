<!DOCTYPE html>
<html>
	<head>
		<meta charset='UTF-8' >
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<h1>Hello my name is <?php echo $username; ?></h1>
		<?php
		$db = new Database();
		$s = new Session();

		?>
	</body>
</html>
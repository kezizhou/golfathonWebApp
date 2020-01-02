<?php
	session_start();
	ob_start();
?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Process Logout													  	  -->
<!-- -------------------------------------------------------------------------------- -->

<html>

	<head>
	
		<link rel="stylesheet" type="text/css" href="../../styles/home.css" media="screen">
		<link href="https://fonts.googleapis.com/css?family=Salsa&display=swap" rel="stylesheet">
		<title> Logout </title>
		
	</head>
	
	<body>
		
		<?php
			unset($_SESSION);
			session_destroy();
			
			// PHP permanent URL redirection
			header("Location: ../../default_site/Home/home.php", true, 301);
			exit();
		?>
		
	</body>
	
</html>
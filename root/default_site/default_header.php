<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Header Template for Default Page										  -->
<!-- -------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html>

	<head>
		
		<meta charset=utf-8>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/styles/home.css" media="screen">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Salsa&display=swap">
		<?php 
			if( isset($astrCustomCSS) ) {
				foreach( $astrCustomCSS as $strCustomCSS ) {
					echo "<link rel='stylesheet' type='text/css' href='" . $strCustomCSS . "' media='screen'>";
				}
			}
		?>
		
		<title> 
			<?php if( isset($strPageTitle) ) {
				echo $strPageTitle;
			}
			else {
				echo "Golfathon Event";
			}
			?>
		</title>

	</head>

	<body>
	
		<?php
			require __DIR__ . '../../include_functions.php';
			$conn = mySQLConnect();

			// Get latest event year
			$getEvent = "SELECT MAX(intEventID) AS intEventID, dteEventYear FROM TEvents";
			if( $result = mysqli_query($conn, $getEvent) ) {
				$row = mysqli_fetch_array($result);
				$intCurrentEventID = $row["intEventID"];
				$dteCurrentEventYear = $row["dteEventYear"];
			} else {
				throw new Exception( "Error: " . $getEvent . "<br>" . mysqli_error($conn) );
			}
		?>
	
		<div class="heading">
			<h1> Welcome to the <?php echo $dteCurrentEventYear ?> Annual Golfathon Event! </h1>
		</div>
	
		<?php
			$rootSite = "/default_site"
		?>

		<div class="navbar" id="navbar">
			<a class="<?php 
				switch( $currentPage ) {
					case "home.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Home/home.php";?>"> Home </a>
				
			<a class="<?php
				switch( $currentPage ) {
					case "register_golfer.php":
					case "process_golfers.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Register_to_Golf/register_golfer.php";?>"> Register to Golf </a>
				
			<a class="<?php
				switch( $currentPage ) {
					case "show_golfers.php":
					case "update_golfer.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/The_Golfers/show_golfers.php";?>"> The Golfers </a>
				
			<a class="<?php 
				switch( $currentPage ) {
					case "donate.php":
					case "process_donation.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Make_a_Donation/donate.php";?>"> Make a Donation </a>
				
			<a class="<?php 
				switch( $currentPage ) {
					case "golfer_statistics.php":
					case "golfer_donors.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Golfer_Statistics/golfer_statistics.php";?>"> Golfer Statistics </a>
				
			<a class="<?php 
				switch( $currentPage ) {
					case "team_statistics.php":
					case "team_donors.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Team_Statistics/team_statistics.php";?>"> Team Statistics </a>
				
			<a class="<?php 
				switch( $currentPage ) {
					case "register_corp_sponsor.php":
					case "process_corp_sponsor.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Become_a_Corporate_Sponsor/register_corp_sponsor.php";?>"> Become a Corporate Sponsor </a>
			<div class="navbar-right"> 
				<a class="<?php 
					switch( $currentPage ) {
						case "login.php":
						case "process_login.php":
							echo "active";
							break;
					}
					?>" href="<?php echo $rootSite . "/Login/login.php";?>"> Login </a>
			</div>
			<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="responsiveNavbar()">&#9776;</a>
		</div>
	
		<script type="text/javascript"> 
			function responsiveNavbar() {
				var navbar = document.getElementById("navbar");
				if (navbar.className === "navbar") {
					navbar.className += " responsive";
				} else {
					navbar.className = "navbar";
				}
			}
		</script>

	</body>
	
</html>
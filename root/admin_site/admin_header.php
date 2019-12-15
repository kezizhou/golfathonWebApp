<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Header Template for Admin Page										  -->
<!-- -------------------------------------------------------------------------------- -->

<!DOCTYPE html>
<html>

	<head>
	
		<meta charset=utf-8>
		<script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6/html5shiv.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/styles/home.css" media="screen">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Salsa&display=swap" >
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<?php 
			if( isset($strCustomCSS) ) {
				echo "<link rel='stylesheet' type='text/css' href='" . $strCustomCSS . "' media='screen'>";
			}
		?>
		
		<title> 
			<?php if( isset($strPageTitle) ) {
				echo $strPageTitle;
			}
			else {
				echo "Golfathon Event Admin";
			}
			?>
		</title>

	</head>

	<body>
	
		<?php
			require '../../include_functions.php';
			$conn = mySQLConnect();

			// Get latest event year
			$getEvent = "SELECT MAX(intEventID) AS intEventID, dteEventYear FROM TEvents";
			if($result = mysqli_query($conn, $getEvent)){
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
			$rootSite = "/admin_site"
		?>
	
		<div class="navbar">
			<a class="<?php 
				switch( $currentPage ) {
					case "admin_home.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Admin_Home/admin_home.php";?>"> Admin Home </a>
				
			<div class="dropdown">
			
				<button class="<?php 
						switch( $currentPage ) {
							case "add_corp_sponsorship.php":
							case "manage_corp_sponsorships.php":
							case "update_corp_sponsorship.php":
								echo "active";
								break;
						}
						?> dropBtn"> Corporate Sponsorship Management 
					<i class="fa fa-caret-down"></i>
				</button>
				
				<div class="dropContent">
					<a class="<?php 
						switch( $currentPage ) {
							case "add_corp_sponsorship.php":
								echo "active";
								break;
						}
						?>" href="<?php echo $rootSite . "/Corporate_Sponsorship_Management/add_corp_sponsorship.php";?>"> Add New </a>
						
					<a class="<?php 
						switch( $currentPage ) {
							case "manage_corp_sponsorships.php":
							case "update_corp_sponsorship.php":
								echo "active";
								break;
						}
						?>" href="<?php echo $rootSite . "/Corporate_Sponsorship_Management/manage_corp_sponsorships.php";?>"> Manage Existing </a>
				</div>
				
			</div>
			
			<a class="<?php 
				switch( $currentPage ) {
					case "manage_golfer_sponsors.php":
					case "update_golfer_sponsor.php":
						echo "active";
						break;
				}
				?>" href="<?php echo $rootSite . "/Golfer_Sponsors_Management/manage_golfer_sponsors.php";?>"> Golfer/Sponsors Management </a>
				
			<div class="navbar-right"> 
				<a class="navbar-right" href="<?php echo $rootSite . "/Logout/logout.php";?>"> Logout </a>
			</div>
		</div>
			
		<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="responsiveNavbar()">&#9776;</a>

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
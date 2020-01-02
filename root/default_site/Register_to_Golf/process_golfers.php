<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Successfully Registered New Golfer Page							  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Thank You!";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
		
	// Body
	// Variables and posts from a form
	$txtFirstName = $_POST["txtFirstName"];
	$txtLastName = $_POST["txtLastName"];
	$txtAddress = $_POST["txtAddress"];
	$txtCity = $_POST["txtCity"];
	$txtZip = $_POST["txtZip"];
	$txtPhone = $_POST["txtPhone"];
	$txtEmail = $_POST["txtEmail"];
	
	// Store foreign key
	$intShirtSizeID = $_POST["cmbShirtSize"];
	$intGenderID = $_POST["cmbGender"];
	$intStateID = $_POST["cmbState"];
	$intTeamandClubID = $_POST["cmbTeam"];

	// Insert into TGolfers
	$insertGolfer = "INSERT INTO TGolfers (strFirstName, strLastName, strAddress, strCity, strZip, strPhone, strEmail, intStateID, intShirtSizeID, intGenderID)
					VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity', '$txtZip', '$txtPhone', '$txtEmail', $intStateID, $intShirtSizeID, $intGenderID)";
	
	// Confirm record insertions
	if(mysqli_query($conn, $insertGolfer)) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertGolfer . "<br>" . mysqli_error($conn) );
	}
	$intGolferID = mysqli_insert_id($conn);

	// Insert into TEventGolfers
	$insertEventGolfer = "INSERT INTO TEventGolfers (intEventID, intGolferID)
						VALUES ($intCurrentEventID, $intGolferID)";

	if( mysqli_query($conn, $insertEventGolfer) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertEventGolfer . "<br>" . mysqli_error($conn) );
	}

	// Insert into TEventGolferTeamsdClubs
	$insertEventGolferTeamandClubs = "INSERT INTO TEventGolferTeamandClubs (intEventGolferID, intTeamandClubID)
									VALUES ($intEventGolferID, $intTeamandClubID)";
	if( mysqli_query($conn, $insertEventGolferTeamandClubs) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertEventGolferTeamandClubs . "<br>" . mysqli_error($conn) );
	}
	
	// Close connection
	mysqli_close($conn);
?>

<div class="main">
	Thank you for registering!
</div>
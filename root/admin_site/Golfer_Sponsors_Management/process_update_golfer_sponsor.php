<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Script to Update Sponsors of Golfers								  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	require '../../include_functions.php';
	$conn = mySQLConnect();

	// Get intGolferID from previous
	$intSponsorID = $_GET["intSponsorID"];

	// Variables and posts from a form
	$txtFirstName = $_POST["txtFirstName"];
	$txtLastName = $_POST["txtLastName"];
	$txtAddress = $_POST["txtAddress"];
	$txtCity = $_POST["txtCity"];
	$txtZip = $_POST["txtZip"];
	$txtPhone = $_POST["txtPhone"];
	$txtEmail = $_POST["txtEmail"];
	
	// Store foreign key
	$intStateID = $_POST["cmbState"];

	// Update TSponsors
	$updateSponsor = "UPDATE TSponsors 
					SET strFirstName='$txtFirstName', strLastName='$txtLastName', strAddress='$txtAddress', strCity='$txtCity', strZip='$txtZip', strPhone='$txtPhone', strEmail='$txtEmail', intStateID='$intStateID' 
					WHERE intSponsorID = '$intSponsorID'";
	
	// Confirm record updates
	if( mysqli_query($conn, $updateSponsor) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $updateSponsor . "<br>" . mysqli_error($conn) );
	}

	// Close connection
	mysqli_close($conn);
	
	// PHP permanent URL redirection
	header("Location: manage_golfer_sponsors.php", true, 301);
	exit();
?>
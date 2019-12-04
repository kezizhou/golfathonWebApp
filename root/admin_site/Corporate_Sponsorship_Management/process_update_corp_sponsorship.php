<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Script to Update Corporate Sponsorship							  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	require '../../include_functions.php';
	$conn = mySQLConnect();

	// Get intEventCorporateSponsorshipTypeID from previous
	$intEventCorporateSponsorshipTypeID = $_GET["intEventCorporateSponsorshipTypeID"];
	// Variables and posts from form
	$intSponsorshipAvailable = $_POST["txtNumberAvailable"];

	// Update TEventCorporateSponsorshipTypes
	$updateCorpSponsorshipType = "UPDATE TEventCorporateSponsorshipTypes 
								SET intSponsorshipAvailable=$intSponsorshipAvailable
								WHERE intEventCorporateSponsorshipTypeID = $intEventCorporateSponsorshipTypeID";
	// Confirm record updates
	if( mysqli_query($conn, $updateCorpSponsorshipType) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $updateCorpSponsorshipType . "<br>" . mysqli_error($conn) );
	}

	// Close connection
	mysqli_close($conn);
	
	// PHP permanent URL redirection
	header("Location: manage_corp_sponsorships.php", true, 301);
	exit();
?>
<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Script to Add New Corporate Sponsorship							  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	require '../../include_functions.php';
	$conn = mySQLConnect();

	$astrBenefits = array();

	// Variables and posts from a form
	$dblSponsorshipCost = $_POST["txtSponsorshipCost"];
	$intSponsorshipAvailable = $_POST["txtNumberAvailable"];
	
	// Store foreign keys
	$intCorporateSponsorshipTypeID = $_POST["cmbSponsorshipType"];
	$astrBenefits = $_POST["cmbBenefits"];
	
	// Insert into TEventCorporateSponsorshipTypes
	// Get latest event year
	$getEvent = "SELECT MAX(intEventID) AS intEventID FROM TEvents";
	if($result = mysqli_query($conn, $getEvent)){
		$row = mysqli_fetch_array($result);
		$intEventID = $row["intEventID"];
	} else {
		throw new Exception( "Error: " . $getEvent . "<br>" . mysqli_error($conn) );
	}
	// Insert information to database
	$insertCorpSponsorshipType = "INSERT INTO TEventCorporateSponsorshipTypes (intCorporateSponsorshipTypeID, intEventID, dblSponsorshipCost, intSponsorshipAvailable)
								VALUES ($intCorporateSponsorshipTypeID, $intEventID, $dblSponsorshipCost, $intSponsorshipAvailable)";
	// Confirm record insertions
	if( mysqli_query($conn, $insertCorpSponsorshipType) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertCorpSponsorshipType . "<br>" . mysqli_error($conn) );
	}

	// Insert into TEventCorporateSponsorshipTypeBenefits
	foreach ($astrBenefits as $intBenefitID) {
		// Insert record for each selected benefit
		$insertEventCorpBenefit = "INSERT INTO TEventCorporateSponsorshipTypeBenefits (intEventCorporateSponsorshipTypeID, intBenefitID)
								VALUES ($intEventCorporateSponsorshipTypeID, $intBenefitID)";
		if (mysqli_query($conn, $insertEventCorpBenefit)) {
			echo "";
		} else {
			throw new Exception( "Error: " . $insertEventCorpBenefit . "<br>" . mysqli_error($conn) );
		}
	}

	// Close connection
	mysqli_close($conn);
	
	// PHP permanent URL redirection
	header("Location: manage_corp_sponsorships.php", true, 301);
	exit();
?>
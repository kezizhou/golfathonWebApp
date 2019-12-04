<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Successfully Processed New Corporate Sponsor						  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Thank You!";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
		
	// Body
	
	// Insert into TCorporateSponsors
	
	// Variables and posts from a form
	$strFirstName = $_POST["txtFirstName"];
	$strLastName = $_POST["txtLastName"];
	$strAddress = $_POST["txtAddress"];
	$strCity = $_POST["txtCity"];
	$strZip = $_POST["txtZip"];
	$strContactPhone = $_POST["txtPhone"];
	$strContactEmail = $_POST["txtEmail"];
	// Store foreign key
	$intEventCorporateSponsorshipTypeID = $_POST["cmbSponsorship"];
	$intStateID = $_POST["cmbState"];
	
	// Insert information to database
	$insertCorporateSponsor = "INSERT INTO TCorporateSponsors (strFirstName, strLastName, strAddress, strCity, strZip, strContactPhone, strContactEmail, intStateID)
						VALUES ('$strFirstName', '$strLastName', '$strAddress', '$strCity', '$strZip', '$strContactPhone', '$strContactEmail', $intStateID)";
	// Confirm record insertions
	if( mysqli_query($conn, $insertCorporateSponsor) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertCorporateSponsor . "<br>" . mysqli_error($conn) );
	}

	// Insert into TEventCorporateSponsorshipTypeCorporateSponsors
	$insertEventCorpSponsor = "INSERT INTO TEventCorporateSponsorshipTypeCorporateSponsors (intEventCorporateSponsorshipTypeID, intCorporateSponsorID)
							VALUES ($intEventCorporateSponsorshipTypeID, $intCorporateSponsorID)";

	if( mysqli_query($conn, $insertEventCorpSponsor) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertEventCorpSponsor . "<br>" . mysqli_error($conn) );
	}

	// Update TEventCorporateSponsorshipTypes available sponsorships
	$updateAvailable = "UPDATE TEventCorporateSponsorshipTypes
						SET intSponsorshipAvailable = intSponsorshipAvailable - 1
						WHERE intEventCorporateSponsorshipTypeID = $intEventCorporateSponsorshipTypeID";
	if( mysqli_query($conn, $updateAvailable) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $updateAvailable . "<br>" . mysqli_error($conn) );
	}

	// Close connection
	mysqli_close($conn);
?>

<div class="main">
	Thank you for your sponsorship!
</div>
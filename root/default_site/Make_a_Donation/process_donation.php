<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Successfully Processed Donation for Golfer Page					  	  -->
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
	$dblPledgePerHole = $_POST["txtPledgePerHole"];
	
	// Store foreign keys
	$intStateID = $_POST["cmbState"];
	$intGolferID = $_POST["cmbGolfer"];
	$intPaymentTypeID = $_POST["cmbPaymentType"];
	
	// Insert into TSponsors
	$insertSponsor = "INSERT INTO TSponsors (strFirstName, strLastName, strAddress, strCity, strZip, strPhone, strEmail, intStateID)
	VALUES ('$txtFirstName', '$txtLastName', '$txtAddress', '$txtCity', '$txtZip', '$txtPhone', '$txtEmail', $intStateID)";
	
	// Confirm record insertions
	if( mysqli_query($conn, $insertSponsor) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertSponsor . "<br>" . mysqli_error($conn) );
	}

	// Insert into TEventGolferSponsors
	
	// Get intEventGolferID for golfer in this event
	$getEventGolfer = "SELECT intEventGolferID FROM TEventGolfers WHERE intGolferID = " . $intGolferID . " AND intEventID = " . $intCurrentEventID;
	if( $result = mysqli_query($conn, $getEventGolfer) ) {
		$row = mysqli_fetch_array($result);
		$intEventGolferID = $row["intEventGolferID"];
	} else {
		throw new Exception( "Error: " . $getEventGolfer . "<br>" . mysqli_error($conn) );
	}
	
	// Insert record
	$insertEventGolferSponsor = "INSERT INTO TEventGolferSponsors (intEventGolferID, intSponsorID, intPaymentTypeID, intPaymentStatusID, dteDateOfPledge, dblPledgePerHole)
							VALUES ($intEventGolferID, $intSponsorID, $intPaymentTypeID, 1, CURDATE(), $dblPledgePerHole)";

	if( mysqli_query($conn, $insertEventGolferSponsor) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $insertEventGolferSponsor . "<br>" . mysqli_error($conn) );
	}

	// Close connection
	mysqli_close($conn);
?>

<div class="main">
	Thank you! Your donation has been processed. 
</div>
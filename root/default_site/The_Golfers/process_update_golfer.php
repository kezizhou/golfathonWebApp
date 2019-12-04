<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Script to Update Golfer Information								  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	require '../../include_functions.php';
	$conn = mySQLConnect();

	// Get intGolferID from previous
	$intGolferID = $_GET["intGolferID"];

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

	// Update TGolfers
	$updateGolfer = "UPDATE TGolfers
					SET strFirstName='$txtFirstName', strLastName='$txtLastName', strAddress='$txtAddress', strCity='$txtCity', strZip='$txtZip', strPhone='$txtPhone', strEmail='$txtEmail', intStateID='$intStateID', intShirtSizeID='$intShirtSizeID', intGenderID='$intGenderID'
					WHERE intGolferID = '$intGolferID'";
	
	// Confirm record updates
	if( mysqli_query($conn, $updateGolfer) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $updateGolfer . "<br>" . mysqli_error($conn) );
	}
	
	// Get intEventGolferID
	// Get latest intEventID
	$getEvent = "SELECT MAX(intEventID) AS intEventID FROM TEvents";
	if($result = mysqli_query($conn, $getEvent)){
		$row = mysqli_fetch_array($result);
		$intEventID = $row["intEventID"];
	} else {
		throw new Exception( "Error: " . $getEvent . "<br>" . mysqli_error($conn) );
	}
	// For golfer in this event
	$getEventGolfer = "SELECT intEventGolferID FROM TEventGolfers WHERE intGolferID = " . $intGolferID . " AND intEventID = " . $intEventID;
	if ($result = mysqli_query($conn, $getEventGolfer)) {
		$row = mysqli_fetch_array($result);
		$intEventGolferID = $row["intEventGolferID"];
	} else {
		throw new Exception( "Error: " . $getEventGolfer . "<br>" . mysqli_error($conn) );
	}
	
	// Update TEventGolferTeamandClubs
	$updateTeam = "UPDATE TEventGolferTeamandClubs
	SET intTeamandClubID = '$intTeamandClubID'
	WHERE intEventGolferID = $intEventGolferID";
	
	// Confirm record updates
	if( mysqli_query($conn, $updateTeam) ) {
		echo "";
	} else {
		throw new Exception( "Error: " . $updateTeam . "<br>" . mysqli_error($conn) );
	}

	// Close connection
	mysqli_close($conn);
	
	// PHP permanent URL redirection
	header("Location: show_golfers.php", true, 301);
	exit();
?>
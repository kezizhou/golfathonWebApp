<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Donor List for Golfer Page										  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Donor List";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>

<div class="main">
	<?php
		$intGolferID = $_GET["intGolferID"];
		$intEventID = $_GET["intEventID"];
		
		// Get golfer name
		$getGolfer = "SELECT strFirstName, strLastName FROM TGolfers WHERE intGolferID = $intGolferID";
		if( $result = mysqli_query($conn, $getGolfer) ) {
			$row = mysqli_fetch_array($result);
			$strGolferFirstName = $row["strFirstName"];
			$strGolferLastName = $row["strLastName"];
		} else {
			throw new Exception( "Error: " . $getGolfer . "<br>" . mysqli_error($conn) );
		}	
	?>
		<b> <?php echo "Donors for Golfer: " . charConvert($strGolferFirstName . " " . $strGolferLastName); ?> </b>
	<?php
		// Display all donors for selected golfer
		$showDonors = "SELECT TS.strFirstName, TS.strLastName
				FROM TSponsors AS TS JOIN TEventGolferSponsors AS TEGS
					ON TS.intSponsorID = TEGS.intSponsorID
				JOIN TEventGolfers AS TEG
					ON TEG.intEventGolferID = TEGS.intEventGolferID
				WHERE TEG.intGolferID = $intGolferID AND TEG.intEventID = $intEventID
				ORDER BY TS.strLastName";
	?>
		<ul>
	<?php
		if( $result = mysqli_query($conn, $showDonors) ) {
			if( mysqli_num_rows($result) > 0 ) {
				while( $row = mysqli_fetch_array($result) ) { 
					echo "<li>" . charConvert($row['strLastName'] . ", " . $row['strFirstName']) . "</li>";
				}
			
			// Free result set
			mysqli_free_result($result);
			} else {
				echo "No donors here yet. Make a donation to show your support!";
			}
		} else {
			throw new Exception( "ERROR: $showDonors. " . mysqli_error($conn) );
		}
	?>
		</ul>
	<?php
		// Close connection
		mysqli_close($conn);
	?>
	
	<br> Thank you for all your donations!
</div>
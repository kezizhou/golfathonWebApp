<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: List All Donors of a Team Page									  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Donor List";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>
		
<div class="main">
	<?php
		$intTeamandClubID = $_GET["intTeamandClubID"];
		$intEventID = $_GET["intEventID"];
	
		// Get team name
		$getTeam = "SELECT TG.strGender, TTT.strTypeofTeam, TLT.strLevelofTeam 
					FROM TTeamandClubs AS TTC JOIN TGenders AS TG
						ON TTC.intGenderofTeamID = TG.intGenderID
					JOIN TTypeofTeams AS TTT
						ON TTC.intTypeofTeamID = TTT.intTypeofTeamID
					JOIN TLevelofTeams AS TLT
						ON TTC.intLevelofTeamID = TLT.intLevelofTeamID
					WHERE intTeamandClubID = $intTeamandClubID";
		if($result = mysqli_query($conn, $getTeam)){
			$row = mysqli_fetch_array($result);
			$strTeamName = $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam'];
		} else {
			throw new Exception( "Error: " . $getTeam . "<br>" . mysqli_error($conn) );
		}	
	?>
	
	<b> Donors for Team: <?php echo $strTeamName;?> </b>
		
	<?php
		// Display all donors for selected team
		$showDonors = "SELECT TS.strFirstName, TS.strLastName
				FROM TSponsors AS TS JOIN TEventGolferSponsors AS TEGS
					ON TS.intSponsorID = TEGS.intSponsorID
				JOIN TEventGolfers AS TEG
					ON TEG.intEventGolferID = TEGS.intEventGolferID
				JOIN TEventGolferTeamandClubs AS TEGT
					ON TEG.intEventGolferID = TEGT.intEventGolferID
				WHERE TEGT.intTeamandClubID = $intTeamandClubID AND TEG.intEventID = $intEventID
				ORDER BY TS.strLastName"; ?>
		<ul>
	<?php
		if( $result = mysqli_query($conn, $showDonors) ) {
			if( mysqli_num_rows($result) > 0 ) {
				while( $row = mysqli_fetch_array($result) ) { 
	?>
					<li>
						<?php echo charConvert($row['strLastName'] . ", " . $row['strFirstName']); ?>
					</li>
	<?php
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
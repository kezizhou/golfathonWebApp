<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Admin Home Page														  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Admin Home";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../admin_header.php');

	// Body
	
	// Get total amount raised
	// From corporate sponsorships
	$totalCorpSponsors = "SELECT SUM(TECST.dblSponsorshipCost) AS dblCorpSponsorTotal
							FROM TEventCorporateSponsorshipTypes AS TECST JOIN TEventCorporateSponsorshipTypeCorporateSponsors AS TECSTCS
								ON TECST.intEventCorporateSponsorshipTypeID = TECSTCS.intEventCorporateSponsorshipTypeID
							WHERE intEventID = $intCurrentEventID";
	if( $result = mysqli_query($conn, $totalCorpSponsors) ) {
		$row = mysqli_fetch_array($result);
		$dblCorpSponsorTotal = $row["dblCorpSponsorTotal"];
	} else{
		throw new Exception( "ERROR: $totalCorpSponsors. " . mysqli_error($conn) );
	}
	// From all golfer donors
	$totalGolferSponsors = "SELECT SUM(dblPledgePerHole)*18 AS dblGolferSponsorTotal
							FROM TEventGolferSponsors AS TEGS JOIN TEventGolfers AS TEG
								ON TEGS.intEventGolferID = TEG.intEventGolferID
							WHERE TEG.intEventID = $intCurrentEventID"; 
	if( $result = mysqli_query($conn, $totalGolferSponsors) ) {
		$row = mysqli_fetch_array($result);
		$dblGolferSponsorTotal = $row["dblGolferSponsorTotal"];
	} else{
		throw new Exception( "ERROR: $totalGolferSponsors. " . mysqli_error($conn) );
	}
	$dblTotalRaised = $dblCorpSponsorTotal + $dblGolferSponsorTotal;

	// Get leading golfer
	$leadingGolfer = "SELECT TG.intGolferID, TG.strFirstName, TG.strLastName, SUM(TEGS.dblPledgePerHole)*18 AS dblTotalPledges
					FROM TEventGolferSponsors AS TEGS JOIN TEventGolfers AS TEG
						ON TEGS.intEventGolferID = TEG.intEventGolferID
					JOIN TGolfers AS TG 
						ON TEG.intGolferID = TG.intGolferID
					GROUP BY intGolferID
					ORDER BY dblTotalPledges DESC LIMIT 1";
	if( $result = mysqli_query($conn, $leadingGolfer) ) {
		$row = mysqli_fetch_array($result);
		$strLeadingGolfer = $row["strFirstName"] . " " . $row["strLastName"];
	} else{
		throw new Exception( "ERROR: $leadingGolfer. " . mysqli_error($conn) );
	}

	// Get leading team
	$leadingTeam = "SELECT TTC.intTeamandClubID, TGE.strGender, TTT.strTypeofTeam, TLT.strLevelofTeam,SUM(IFNULL(TEGS.dblPledgePerHole*18, 0)) AS dblTotalPledges
					FROM TLevelofTeams AS TLT JOIN TTeamandClubs AS TTC 
						ON TLT.intLevelofTeamID = TTC.intLevelofTeamID
					JOIN TTypeofTeams AS TTT	
						ON TTT.intTypeofTeamID = TTC.intTypeofTeamID
					JOIN TGenders AS TGE
						ON TGE.intGenderID = TTC.intGenderofTeamID
					JOIN TEventGolferTeamandClubs AS TEGT
						ON TTC.intTeamandClubID = TEGT.intTeamandClubID
					JOIN TEventGolfers AS TEG
						ON TEGT.intEventGolferID = TEG.intEventGolferID
					LEFT JOIN TEventGolferSponsors AS TEGS
						ON TEG.intEventGolferID = TEGS.intEventGolferID
					GROUP BY TTC.intTeamandClubID
					ORDER BY dblTotalPledges DESC LIMIT 1";
	if( $result = mysqli_query($conn, $leadingTeam) ) {
		$row = mysqli_fetch_array($result);
		$strLeadingTeam = $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam'];
	} else{
		throw new Exception( "ERROR: $leadingTeam. " . mysqli_error($conn) );
	}

	// Get total number of golfers in current event
	$totalGolfers = "SELECT COUNT(intGolferID) AS intTotalGolfers 
					FROM TEventGolfers 
					WHERE intEventID = $intCurrentEventID";
	if( $result = mysqli_query($conn, $totalGolfers) ) {
		$row = mysqli_fetch_array($result);
		$intTotalGolfers = $row["intTotalGolfers"];
	} else{
		throw new Exception( "ERROR: $totalGolfers. " . mysqli_error($conn) );
	}
?>

<div class="main">
	<b> Total Amount Raised: </b> <?php echo "$" . $dblTotalRaised; ?> <br>
	<b> Leading Golfer: </b> <?php echo charConvert($strLeadingGolfer); ?> <br>
	<b> Leading Team: </b> <?php echo charConvert($strLeadingTeam); ?> <br>
	<b> Number of Golfers This Event: </b> <?php echo $intTotalGolfers; ?> <br>
	<b> Latest Donors: </b> 

	<?php
		// Get latest 3 donors
		$latestDonors = "SELECT TS.strFirstName, TS.strLastName, TEGS.dblPledgePerHole, TG.strFirstName AS strGolferFirstName, TG.strLastName AS strGolferLastName
						FROM TSponsors AS TS JOIN TEventGolferSponsors AS TEGS
							ON TS.intSponsorID = TEGS.intSponsorID
						JOIN TEventGolfers AS TEG
							ON TEGS.intEventGolferID = TEG.intEventGolferID
						JOIN TGolfers AS TG
							ON TEG.intGolferID = TG.intGolferID
						ORDER BY TS.intSponsorID DESC LIMIT 3";			
	?>
	<ol class="latestDonors">
		<?php
			if( $result = mysqli_query($conn, $latestDonors) ) {
				if( mysqli_num_rows($result) > 0 ) {
					while( $row = mysqli_fetch_array($result) ) { 
		?>
						<li>
							<?php echo charConvert($row['strFirstName'] . " " . $row['strLastName'] . " - $" . $row['dblPledgePerHole'] . " to Golfer - " . $row['strGolferFirstName'] . " " . $row['strGolferLastName']); ?>
						</li>
		<?php
					}

				// Free result set
				mysqli_free_result($result);
				} else{
					echo "No donors this event yet. Be the first to donate!";
				}
			} else{
				throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
			}
		?>
	</ol>

</div>

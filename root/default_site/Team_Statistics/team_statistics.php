<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Team Statistics Page												  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Team Statistics";
	$currentPage = basename($_SERVER['PHP_SELF']);
	$astrCustomCSS = array("../../styles/responsive_table.css", "../../styles/team_statistics.css", "../../styles/statistics.css");
	include('../default_header.php');

	// Body
	// Get total number of teams in current event
	$sql = "SELECT COUNT(DISTINCT intTeamandClubID) AS intTotalTeams 
			FROM TEventGolferTeamandClubs AS TEGT JOIN TEventGolfers AS TEG
				ON TEGT.intEventGolferID = TEG.intEventGolferID
			WHERE TEG.intEventID = $intCurrentEventID";
	if( $result = mysqli_query($conn, $sql) ){
		$row = mysqli_fetch_array($result);
		$intTotalTeams = $row["intTotalTeams"];
	} else {
		throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
	}
?>

<div class="main">
	<b> Total # of Teams in <?php echo $dteCurrentEventYear; ?> Event: </b> <?php echo $intTotalTeams; ?> <br><br>
	
	<?php
		// Display team donations
		$sql = "SELECT TTC.intTeamandClubID, TGE.strGender, TTT.strTypeofTeam, TLT.strLevelofTeam,SUM(IFNULL(TEGS.dblPledgePerHole*18, 0)) AS dblTotalPledges
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
				ORDER BY dblTotalPledges DESC";
				
		if( $result = mysqli_query($conn, $sql) ){
			if( mysqli_num_rows($result) > 0 ) { ?>
				<div style="overflow-x:auto;">
					<table border=1>
						<thead>
						<tr>
							<th> Team </th>
							<th> Total Donations </th>
							<th> See the Donors </th>
						</tr>
						</thead>
						<tbody>
					<?php 
					while( $row = mysqli_fetch_array($result) ) { 
						if( $row['dblTotalPledges'] >= 2000 ) { ?>
							<tr class='highDonations'>
					<?php
						} else { ?>
							<tr>
					<?php
						} ?>
							<td> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']; ?> </td>
							<td> <?php echo "$" . $row['dblTotalPledges']; ?> </td>
							<td id="normalWeight"> <a href="team_donors.php?intTeamandClubID=<?php echo $row['intTeamandClubID']; ?>&intEventID=<?php echo $intCurrentEventID; ?>"> Donor List </a></td>
						</tr>
						</tbody>
					<?php
					} ?>
					</table>
				</div>
			
				<?php
				// Free result set
				mysqli_free_result($result);
			} else {
				echo "No teams this event yet. Be the first to join!";
			}
		} else {
			throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
		}
		 
		// Close connection
		mysqli_close($conn);
	?>

	** Teams in <text class="boldRed"> red </text> have raised $2000 or more this event ** 
</div>
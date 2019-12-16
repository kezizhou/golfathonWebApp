<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Golfer Statistics Page												  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Golfer Statistics";
	$currentPage = basename($_SERVER['PHP_SELF']);
	$astrCustomCSS = array("../../styles/responsive_table.css", "../../styles/golfer_statistics.css", "../../styles/statistics.css");
	include('../default_header.php');
			
	// Get total number of golfers in current event
	$sql = "SELECT COUNT(intGolferID) AS intTotalGolfers 
			FROM TEventGolfers 
			WHERE intEventID = $intCurrentEventID";
	if($result = mysqli_query($conn, $sql)){
		$row = mysqli_fetch_array($result);
		$intTotalGolfers = $row["intTotalGolfers"];
	} else{
		throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
	}
?>
		
<div class="main">
	<b> Total # of Golfers in <?php echo $dteCurrentEventYear; ?> Event: </b> <?php echo $intTotalGolfers; ?> <br><br>
	
	<?php
		// Display golfer info
		$sql = "SELECT TG.intGolferID, TG.strFirstName, TG.strLastName, TGE.strGender, TTT.strTypeofTeam, TLT.strLevelofTeam, SUM(IFNULL(TEGS.dblPledgePerHole*18, 0)) AS dblTotalPledges
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
				JOIN TGolfers AS TG 
					ON TEG.intGolferID = TG.intGolferID
				LEFT JOIN TEventGolferSponsors AS TEGS
					ON TEG.intEventGolferID = TEGS.intEventGolferID
				GROUP BY intGolferID
				ORDER BY dblTotalPledges DESC";
				

		if( $result = mysqli_query($conn, $sql) ) {
			if( mysqli_num_rows($result ) > 0) { ?>
				<div style="overflow-x:auto;">
					<table border=1>
						<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Team</th>
							<th>Total Donations</th>
							<th>See the Donors</th>
						</tr>
						</thead>
						<tbody>
					<?php
						while( $row = mysqli_fetch_array($result) ) { 
							if( $row['dblTotalPledges'] >= 1000) {
								echo "<tr class='highDonations'>";
							} else {
								echo "<tr>";
							} ?>
								<td> <?php echo charConvert($row['strFirstName']); ?> </td>
								<td> <?php echo charConvert($row['strLastName']); ?> </td>
								<td> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']; ?> </td>
								<td> <?php echo "$" . $row['dblTotalPledges']; ?> </td>
								<td id="normalWeight"> <a href="golfer_donors.php?intGolferID=<?php echo $row['intGolferID'];?>&intEventID=<?php echo $intCurrentEventID; ?>"> Donor List </a></td>
							</tr>
							</tbody>
						<?php
						} ?>
					</table>
				</div>
			<?php
			// Free result set
			mysqli_free_result($result);
			
			} else{
				echo "No golfers this event yet. Be the first to register!";
			}
		} else{
			throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
		}
		 
		// Close connection
		mysqli_close($conn);
	?>

	** Golfers in <text class="boldRed"> red </text> have raised $1000 or more this event ** 
</div>
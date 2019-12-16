<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Show All Golfers' Information Page								  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "The Golfers";
	$currentPage = basename($_SERVER['PHP_SELF']);
	$astrCustomCSS = array("../../styles/responsive_table.css", "../../styles/show_golfers.css");
	include('../default_header.php');
?>
		
<div class="main">
	<?php
		// Display everything in TGolfers
		$sql = "SELECT TG.intGolferID, TG.strFirstName, TG.strLastName, TG.strAddress, TG.strCity, TG.strZip, TG.strPhone, TG.strEmail, TSS.strShirtSize, TGE.strGender, TS.strState, TTT.strTypeofTeam, TLT.strLevelofTeam
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
				JOIN TShirtSizes AS TSS
					ON TG.intShirtSizeID = TSS.intShirtSizeID
				JOIN TStates AS TS
					ON TG.intStateID = TS.intStateID
				ORDER BY strLastName";
		if( $result = mysqli_query($conn, $sql) ) {
			if( mysqli_num_rows($result) > 0 ) { ?>
				<div id="divTable">
					<table border=1>
						<thead>
						<tr>
							<th>Edit Player Info</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>Zip Code</th>
							<th>Phone</th>
							<th>Email</th>
							<th>Shirt Size</th>
							<th>Team</th>
						</tr>
						</thead>
			<?php while( $row = mysqli_fetch_array($result) ){ ?>
						<tbody>
						<tr>
							<td> <a href="update_golfer.php?intGolferID= <?php echo $row['intGolferID'];?>"> Edit </a></td>
							<td> <?php echo charConvert($row['strFirstName']);?> </td>
							<td> <?php echo charConvert($row['strLastName']);?> </td>
							<td> <?php echo charConvert($row['strAddress']);?> </td>
							<td> <?php echo charConvert($row['strCity']);?> </td>
							<td> <?php echo $row['strState'];?> </td>
							<td> <?php echo charConvert($row['strZip']);?> </td>
							<td> <?php echo charConvert($row['strPhone']);?> </td>
							<td> <?php echo charConvert($row['strEmail']);?> </td>
							<td> <?php echo $row['strShirtSize'];?> </td>
							<td> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam'];?> </td>
						</tr>
						</tbody>
			<?php } ?>
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
</div>
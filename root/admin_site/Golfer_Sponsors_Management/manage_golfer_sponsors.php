<?php
	session_start();
	ob_start();
?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Golfer/Sponsors Management Page										  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Manage Golfer/Sponsors";
	$currentPage = basename($_SERVER['PHP_SELF']);
	$astrCustomCSS = array("../../styles/responsive_table.css", "../../styles/manage_golfer_sponsor.css");
	include('../admin_header.php');
	checkLoginExpire();
?>
		
<div class="main">
	<?php
		// Display everything in TSponsors
		$sql = "SELECT TS.intSponsorID, TS.strFirstName, TS.strLastName, TS.strAddress, TS.strCity, TS.strZip, TS.strPhone, TS.strEmail, TST.strState
				FROM TSponsors AS TS JOIN TStates AS TST
					ON TS.intStateID = TST.intStateID
				ORDER BY strLastName";
		if( $result = mysqli_query($conn, $sql) ){
			if( mysqli_num_rows($result) > 0 ){ ?>
				<div id="divTable">
					<table border=1>
						<thead>
						<tr>
							<th>Edit Sponsor Info</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Address</th>
							<th>City</th>
							<th>State</th>
							<th>Zip Code</th>
							<th>Phone</th>
							<th>Email</th>
						</tr>
						</thead>
					<?php while( $row = mysqli_fetch_array($result) ){ ?>
						<tbody>
						<tr>
							<td> <a href="update_golfer_sponsor.php?intSponsorID= <?php echo $row['intSponsorID'];?>"> Edit </a></td>
							<td> <?php echo charConvert($row['strFirstName']);?> </td>
							<td> <?php echo charConvert($row['strLastName']);?> </td>
							<td> <?php echo charConvert($row['strAddress']);?> </td>
							<td> <?php echo charConvert($row['strCity']);?> </td>
							<td> <?php echo $row['strState'];?> </td>
							<td> <?php echo charConvert($row['strZip']);?> </td>
							<td> <?php echo $row['strPhone'];?> </td>
							<td> <?php echo charConvert($row['strEmail']);?> </td>
						</tr>
						</tbody>
					<?php } ?>
					</table>
				</div>
	<?php
				// Free result set
				mysqli_free_result($result);
				
			} else{
				echo "No sponsors here yet.";
			}
		} else{
			throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
		}
		 
		// Close connection
		mysqli_close($conn);
	?>
</div>
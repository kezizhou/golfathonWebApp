<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Manage Corporate Sponsorships Page								  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Manage Corporate Sponsorships";
	$currentPage = basename($_SERVER['PHP_SELF']);
	$astrCustomCSS = array("../../styles/responsive_table.css", "../../styles/manage_corp_sponsorships.css");
	include('../admin_header.php');
	checkLoginExpire();
?>
		
<div class="main">
	<?php
		// Display all corporate sponsorships
		$sql = "SELECT TECT.intEventCorporateSponsorshipTypeID, TCT.strCorporateSponsorshipType, GROUP_CONCAT(TB.strBenefitDescription SEPARATOR ', ') AS strBenefits, TECT.dblSponsorshipCost, TECT.intSponsorshipAvailable
				FROM TEventCorporateSponsorshipTypes AS TECT JOIN TCorporateSponsorshipTypes AS TCT
					ON TECT.intCorporateSponsorshipTypeID = TCT.intCorporateSponsorshipTypeID
				JOIN TEventCorporateSponsorshipTypeBenefits AS TECTB
					ON TECT.intEventCorporateSponsorshipTypeID = TECTB.intEventCorporateSponsorshipTypeID
				JOIN TBenefits AS TB
					ON TECTB.intBenefitID = TB.intBenefitID
				WHERE TECT.intEventID = $intCurrentEventID
				GROUP BY TECT.intEventCorporateSponsorshipTypeID
				ORDER BY TCT.strCorporateSponsorshipType";
		if( $result = mysqli_query($conn, $sql) ) {
			if( mysqli_num_rows($result) > 0 ) { ?>
				<div style="overflow-x:auto;">
					<table border=1>
						<thead>
						<tr>
							<th>Edit Available Sponsorships</th>
							<th>Corporate Sponsorship Type</th>
							<th>Cost</th>
							<th>Benefits</th>
							<th># Available</th>
						</tr>
						</thead>
				<?php while( $row = mysqli_fetch_array($result) ){ ?>
					<tbody>
						<tr>
							<td> <a href="update_corp_sponsorship.php?intEventCorporateSponsorshipTypeID= <?php echo $row['intEventCorporateSponsorshipTypeID'];?>"> Edit </a></td>
							<td> <?php echo $row['strCorporateSponsorshipType'];?> </td>
							<td> <?php echo "$" . $row['dblSponsorshipCost'];?> </td>
							<td> <?php echo $row['strBenefits'];?> </td>
							<td> <?php echo $row['intSponsorshipAvailable'];?> </td>
						</tr>
						</tbody>
				<?php } ?>
					</table>
				</div>
	<?php
			// Free result set
			mysqli_free_result($result);
			
			} else{
				echo "No corporate sponsorships this event yet. Add the first sponsorship!";
			}
		} else{
			throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
		}
		 
		// Close connection
		mysqli_close($conn);
	?>
</div>

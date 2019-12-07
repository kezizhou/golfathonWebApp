<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Update Selected Corporate Sponsorship Page							  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Update Corporate Sponsorship";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../admin_header.php');
	checkLoginExpire();

	$aintBenefitIDs = array();

	// Display selected corporate sponsorship information
	$sql = "SELECT TECT.intCorporateSponsorshipTypeID, TECTB.intBenefitID AS intBenefitID, TECT.dblSponsorshipCost, TECT.intSponsorshipAvailable
			FROM TEventCorporateSponsorshipTypes AS TECT JOIN TCorporateSponsorshipTypes AS TCT
				ON TECT.intCorporateSponsorshipTypeID = TCT.intCorporateSponsorshipTypeID
			JOIN TEventCorporateSponsorshipTypeBenefits AS TECTB
				ON TECT.intEventCorporateSponsorshipTypeID = TECTB.intEventCorporateSponsorshipTypeID
			WHERE TECT.intEventID = $intCurrentEventID AND TECT.intEventCorporateSponsorshipTypeID = " . $_GET["intEventCorporateSponsorshipTypeID"] . " " .
			"ORDER BY TCT.strCorporateSponsorshipType";
			
	if( $result = mysqli_query($conn, $sql) ) {
		if( mysqli_num_rows($result) > 0 ) {
			while( $row = mysqli_fetch_array($result) ) {
				// Variables from database
				$dblSponsorshipCost = $row["dblSponsorshipCost"];
				$intSponsorshipAvailable = $row["intSponsorshipAvailable"];
				
				// Store foreign key
				$intCorporateSponsorshipTypeID = $row["intCorporateSponsorshipTypeID"];
				// Array of benefits
				array_push($aintBenefitIDs, $row["intBenefitID"]);
			}
			// Free result set
			mysqli_free_result($result);
		} else {
			throw new Exception( "Unable to get selected corporate sponsorship." );
		}
	} else {
		throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
	}
?>

<div class="main">
	<form action="process_update_corp_sponsorship.php?intEventCorporateSponsorshipTypeID= <?php echo $_GET["intEventCorporateSponsorshipTypeID"];?>" method="post">
		<table>
			<tr>
				<td class="label"> Corporate Sponsorship Type: </td>
				<td><select required disabled name="cmbSponsorshipType" id='cmbSponsorshipType'>
					<?php 
						$sql = "SELECT intCorporateSponsorshipTypeID, strCorporateSponsorshipType FROM TCorporateSponsorshipTypes";
						$result = mysqli_query($conn, $sql); 
						while( $row = mysqli_fetch_assoc($result) ) {
							if( $row['intCorporateSponsorshipTypeID'] == $intCorporateSponsorshipTypeID ) { ?>
								<option value = "<?php echo $row['intCorporateSponsorshipTypeID']; ?>" selected> <?php echo $row['strCorporateSponsorshipType']; ?> </option>
						<?php
							}
							else { ?>
								<option value = "<?php echo $row['intCorporateSponsorshipTypeID']; ?>"> <?php echo $row['strCorporateSponsorshipType']; ?> </option>
						<?php
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Sponsorship Cost: </td>
				<td> <input required disabled type="number" min="0" name="txtSponsorshipCost" style="width: 7em" value="<?php echo $dblSponsorshipCost;?>"> </td>
			</tr>
			<tr>
				<td class="label"> Number of Sponsorships Available: </td>
				<td> <input required type="number" min="0" name="txtNumberAvailable" style="width: 7em" value="<?php echo $intSponsorshipAvailable;?>"> </td>
			</tr>
			<tr>
				<td class="label"> Benefits: </td>
				<td><select required disabled multiple name="cmbBenefits[]" id='cmbBenefits'>
					<?php 
						$sql = "SELECT intBenefitID, strBenefitDescription FROM TBenefits";
						$result = mysqli_query($conn, $sql); 
						while( $row = mysqli_fetch_assoc($result) ) {
							if( in_array($row['intBenefitID'], $aintBenefitIDs) ) { ?>
								<option value = "<?php echo $row['intBenefitID']; ?>" selected> <?php echo $row['strBenefitDescription']; ?> </option>
						<?php
							}
							else { ?>
								<option value = "<?php echo $row['intBenefitID']; ?>"> <?php echo $row['strBenefitDescription']; ?> </option>
						<?php
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td colspan="2" class="button"> <input type="submit" name="btnSubmit" value="Update"> </td>
			</tr>
		</table>
	</form>
	
</div>

<?php mysqli_close($conn); ?>
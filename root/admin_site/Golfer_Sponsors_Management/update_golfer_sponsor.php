<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Update Selected Sponsor of Golfer Page								  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Update Golfer-Sponsor Info";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../admin_header.php');

	// Body
	// Display selected sponsor from TSponsors
	$sql = "SELECT TS.intSponsorID, TS.strFirstName, TS.strLastName, TS.strAddress, TS.strCity, TS.strZip, TS.strPhone, TS.strEmail, TST.strState
			FROM TSponsors AS TS JOIN TStates AS TST
				ON TS.intStateID = TST.intStateID
			WHERE TS.intSponsorID = " . $_GET["intSponsorID"];
	if( $result = mysqli_query($conn, $sql) ) {
		if( mysqli_num_rows($result) > 0 ) {
			while( $row = mysqli_fetch_array($result) ) {
				// Variables from database
				$txtFirstName = $row["strFirstName"];
				$txtLastName = $row["strLastName"];
				$txtAddress = $row["strAddress"];
				$txtCity = $row["strCity"];
				$txtZip = $row["strZip"];
				$txtPhone = $row["strPhone"];
				$txtEmail = $row["strEmail"];
				
				// Store foreign key
				$intStateID = $row["intStateID"];
			}
			// Free result set
			mysqli_free_result($result);
		} else {
			throw new Exception( "Unable to load selected sponsor." );
		}
	} else {
		throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
	}
?>

	
<div class="main">
	<form action="process_update_golfer_sponsor.php?intSponsorID= <?php echo $_GET["intSponsorID"];?>" method="post">
		<table>
			<tr>
				<td class="label"> First Name: </td>
				<td> <input required type="text" name="txtFirstName" value="<?php echo charConvert($txtFirstName);?>"> </td>
			</tr>
			<tr>
				<td class="label"> Last Name: </td>
				<td> <input required type="text" name="txtLastName" value="<?php echo charConvert($txtLastName);?>"> </td>
			</tr>
			<tr>
				<td class="label"> Address: </td>
				<td> <input required type="text" name="txtAddress" value="<?php echo charConvert($txtAddress);?>"> </td>
			</tr>
			<tr>
				<td class="label"> City: </td>
				<td> <input required type="text" name="txtCity" value="<?php echo charConvert($txtCity);?>"> </td>
			</tr>
			<tr>
				<td class="label"> State: </td>
				<td><select required name="cmbState" id='cmbState'>
					<?php 
						$sql = "SELECT intStateID, strState FROM TStates";
						$result = mysqli_query($conn, $sql); 
						while( $row = mysqli_fetch_assoc($result) )
						{
							if($row['intStateID'] == $intStateID) { ?>
								<option value = "<?php echo $row['intStateID']; ?>" selected> <?php echo $row['strState']; ?> </option>
							<?php
							}
							else
							{ ?>
								<option value = "<?php echo $row['intStateID']; ?>"> <?php echo $row['strState']; ?> </option>
							<?php
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Zip: </td>
				<td> <input required type="text" name="txtZip" value="<?php echo charConvert($txtZip);?>"> </td>
			</tr>
			<tr>
				<td class="label"> Phone Number: </td>
				<td> <input required type="tel" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" name="txtPhone" placeholder="XXX-XXX-XXXX" value="<?php echo $txtPhone;?>"> </td>
			</tr>
			<tr>
				<td class="label"> Email: </td>
				<td> <input required type="email" name="txtEmail" value="<?php echo charConvert($txtEmail);?>"> </td>
			</tr>
			<tr>
				<td colspan="2" class="button"> <input type="submit" name="btnSubmit" value="Update"> </td>
			</tr>
		</table>
	</form>
</div>

<?php mysqli_close($conn); ?>
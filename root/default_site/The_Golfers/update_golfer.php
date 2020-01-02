<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Update Golfer Info Page											  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Update Golfer Info";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');

	// Display selected golfer from TGolfers
	$sql = "SELECT TG.strFirstName, TG.strLastName, TG.strAddress, TG.strCity, TG.strZip, TG.strPhone, TG.strEmail, TG.intShirtSizeID, TG.intGenderID, TG.intStateID, TTC.intTeamandClubID
			FROM TGolfers AS TG JOIN TEventGolfers AS TEG
				ON TG.intGolferID = TEG.intGolferID
			JOIN TEventGolferTeamandClubs AS TEGT
				ON TEG.intEventGolferID = TEGT.intEventGolferID
			JOIN TTeamandClubs AS TTC
				ON TEGT.intTeamandClubID = TTC.intTeamandClubID
			WHERE TG.intGolferID = " . $_GET["intGolferID"];
	if( $result = mysqli_query($conn, $sql )){
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
				$intShirtSizeID = $row["intShirtSizeID"];
				$intGenderID = $row["intGenderID"];
				$intStateID = $row["intStateID"];
				$intTeamandClubID = $row["intTeamandClubID"];
			}
			// Free result set
			mysqli_free_result($result);
		} else{
			throw new Exception( "No records matching your query were found." );
		}
	} else{
		throw new Exception( "ERROR: $sql. " . mysqli_error($conn) );
	}
?>
		
<div class="main">
	<form action="process_update_golfer.php?intGolferID= <?php echo $_GET["intGolferID"];?>" method="post">
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
						$sql="SELECT intStateID, strState FROM TStates";
						$result=mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_assoc($result))
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
				<td class="label"> Shirt Size: </td>
				<td><select required name="cmbShirtSize" id='cmbShirtSize'>
					<?php 
						$sql="SELECT intShirtSizeID, strShirtSize FROM TShirtSizes";
						$result=mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_assoc($result))
						{
							if($row['intShirtSizeID'] == $intShirtSizeID) { ?>
								<option value = "<?php echo $row['intShirtSizeID']; ?>" selected> <?php echo $row['strShirtSize']; ?> </option>
							<?php
							}
							else
							{ ?>
								<option value = "<?php echo $row['intShirtSizeID']; ?>"> <?php echo $row['strShirtSize']; ?> </option>
							<?php
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Gender: </td>
				<td><select required name="cmbGender" id='cmbGender'>
					<?php 
						$sql="SELECT intGenderID, strGender FROM TGenders";
						$result=mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_assoc($result))
						{
							if($row['intGenderID'] == $intGenderID) { ?>
								<option value = "<?php echo $row['intGenderID']; ?>" selected> <?php echo $row['strGender']; ?> </option>
							<?php
							}
							else
							{ ?>
								<option value = "<?php echo $row['intGenderID']; ?>"> <?php echo $row['strGender']; ?> </option>
							<?php
							}
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Team: </td>
				<td><select required name="cmbTeam" id='cmbTeam'>
					<?php 
					$sql="SELECT TTC.intTeamandClubID, TTT.strTypeofTeam, TLT.strLevelofTeam, TG.strGender
							FROM TTeamandClubs AS TTC JOIN TTypeofTeams AS TTT
								ON TTC.intTypeofTeamID = TTT.intTypeofTeamID
								
								JOIN TLevelofTeams AS TLT
								ON TTC.intLevelofTeamID = TLT.intLevelofTeamID
								
								JOIN TGenders AS TG
								ON TTC.intGenderofTeamID = TG.intGenderID
							ORDER BY intTeamandClubID";
					
					$result=mysqli_query($conn, $sql); 
					while($row = mysqli_fetch_assoc($result))
					{
						if($row['intTeamandClubID'] == $intTeamandClubID) { ?>
							<option value = "<?php echo $row['intTeamandClubID']; ?>" selected> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']; ?> </option>
						<?php
						}
						else
						{ ?>
							<option value = "<?php echo $row['intTeamandClubID']; ?>"> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']; ?> </option>
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
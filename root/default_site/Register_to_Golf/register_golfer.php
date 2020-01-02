<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Register a New Golfer Page										  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Register to Golf";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>
		
<div class="main">
	<form action="process_golfers.php" method="post">
		<table>
			<tr>
				<td class="label"> First Name: </td>
				<td> <input required type="text" name="txtFirstName"> </td>
			</tr>
			<tr>
				<td class="label"> Last Name: </td>
				<td> <input required type="text" name="txtLastName"> </td>
			</tr>
			<tr>
				<td class="label"> Address: </td>
				<td> <input required type="text" name="txtAddress"> </td>
			</tr>
			<tr>
				<td class="label"> City: </td>
				<td> <input required type="text" name="txtCity"> </td>
			</tr>
			<tr>
				<td class="label"> State: </td>
				<td><select required name="cmbState" id='cmbState'>
					<?php 
					$sql="SELECT intStateID, strState FROM TStates";
					$result=mysqli_query($conn, $sql); 
					while($row = mysqli_fetch_assoc($result))
					{ ?>
						<option value="<?php echo $row['intStateID']; ?>"> <?php echo $row['strState']; ?> </option>
					<?php
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Zip: </td>
				<td> <input required type="text" name="txtZip"> </td>
			</tr>
			<tr>
				<td class="label"> Phone Number: </td>
				<td> <input required type="tel" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" name="txtPhone" placeholder="XXX-XXX-XXXX"> </td>
			</tr>
			<tr>
				<td class="label"> Email: </td>
				<td> <input required type="email" name="txtEmail"> </td>
			</tr>
			<tr>
				<td class="label"> Shirt Size: </td>
				<td><select required name="cmbShirtSize" id='cmbShirtSize'>
					<?php 
					$sql="SELECT intShirtSizeID, strShirtSize FROM TShirtSizes";
					$result=mysqli_query($conn, $sql); 
					while($row = mysqli_fetch_assoc($result))
					{ ?>
						<option value="<?php echo $row['intShirtSizeID']; ?>"> <?php echo $row['strShirtSize']; ?> </option>
					<?php
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
					{ ?>
						<option value="<?php echo $row['intGenderID']; ?>"> <?php echo $row['strGender']; ?> </option>
					<?php
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
					
					$result = mysqli_query($conn, $sql); 
					while( $row = mysqli_fetch_assoc($result) )
					{ ?>
						<option value="<?php echo $row['intTeamandClubID']; ?>"> <?php echo $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']; ?> </option>
					<?php
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td colspan="2" class="button"> <input type="submit" name="btnSubmit"> </td>
			</tr>
		<table>
	</form>
</div>

<?php mysqli_close($conn); ?>
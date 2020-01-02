<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Make A Donation Page										  	  		  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Make A Donation";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php'); 
?>
		
<div class="main">
	<form action="process_donation.php" method="post">
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
						$sql = "SELECT intStateID, strState FROM TStates";
						$result = mysqli_query($conn, $sql); 
						while( $row = mysqli_fetch_assoc($result) )
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
				<td class="label"> Golfer-Team to Sponsor: </td>
				<td><select required name="cmbGolfer" id='cmbGolfer'>
					<?php 
					$sql="SELECT TG.intGolferID, TG.strFirstName, TG.strLastName, TTT.strTypeofTeam, TLT.strLevelofTeam, TGE.strGender
							FROM TGolfers AS TG JOIN TEventGolfers AS TEG
								ON TG.intGolferID = TEG.intGolferID
							JOIN TEventGolferTeamandClubs AS TEGT 
								ON TEG.intEventGolferID = TEGT.intEventGolferID
							JOIN TTeamandClubs AS TTC
								ON TEGT.intTeamandClubID = TTC.intTeamandClubID 
							JOIN TTypeofTeams AS TTT
								ON TTC.intTypeofTeamID = TTT.intTypeofTeamID
							JOIN TLevelofTeams AS TLT
								ON TTC.intLevelofTeamID = TLT.intLevelofTeamID
							JOIN TGenders AS TGE
								ON TTC.intGenderofTeamID = TGE.intGenderID
							ORDER BY TG.strLastName";
					
					$result=mysqli_query($conn, $sql); 
					while($row = mysqli_fetch_assoc($result))
					{ ?>
						<option value = "<?php echo $row['intGolferID']; ?>"> <?php echo charConvert($row['strLastName'] . ", " . $row['strFirstName'] . " - " . $row['strGender'] . " " . $row['strTypeofTeam'] . " " . $row['strLevelofTeam']); ?> </option>
					<?php
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Pledge Per Hole: </td>
				<td> <input required type="number" name="txtPledgePerHole" step="0.01" min="0"> </td>
			</tr>
			<tr>
				<td class="label"> Payment Type: </td>
				<td><select required name="cmbPaymentType" id='cmbPaymentType'>
					<?php 
					$sql="SELECT intPaymentTypeID, strPaymentType FROM TPaymentTypes";
					$result=mysqli_query($conn, $sql); 
					while($row = mysqli_fetch_assoc($result))
					{ ?>
						<option value = "<?php echo $row['intPaymentTypeID']; ?>"> <?php echo $row['strPaymentType']; ?> </option>
					<?php
					}
					?>
				</select></td>
			</tr>
		</table>
		<input type="submit" name="btnSubmit"> </td>
	</form>
</div>

<?php mysqli_close($conn); ?>

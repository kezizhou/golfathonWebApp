<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Register a New Corporate Sponsor Page							  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Become a Corporate Sponsor";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>
		
<div class="main">
	<form action="process_corp_sponsor.php" method="post">
		<table>
			<tr>
				<td class="label"> Sponsorship to Purchase: </td>
				<td><select required name="cmbSponsorship" id='cmbSponsorship'>
					<?php 
					$sql="SELECT TECT.intEventCorporateSponsorshipTypeID, TCT.strCorporateSponsorshipType, GROUP_CONCAT(TB.strBenefitDescription SEPARATOR ', ') AS strBenefits, TECT.dblSponsorshipCost, TECT.intSponsorshipAvailable
							FROM TEventCorporateSponsorshipTypes AS TECT JOIN TCorporateSponsorshipTypes AS TCT
								ON TECT.intCorporateSponsorshipTypeID = TCT.intCorporateSponsorshipTypeID
							JOIN TEventCorporateSponsorshipTypeBenefits AS TECTB
								ON TECT.intEventCorporateSponsorshipTypeID = TECTB.intEventCorporateSponsorshipTypeID
							JOIN TBenefits AS TB
								ON TECTB.intBenefitID = TB.intBenefitID
							WHERE TECT.intEventID = $intCurrentEventID AND TECT.intSponsorshipAvailable > 0
							GROUP BY TECT.intEventCorporateSponsorshipTypeID";
					$result = mysqli_query($conn, $sql); 
					while( $row = mysqli_fetch_assoc($result) )
					{ ?>
						<option value="<?php echo $row['intEventCorporateSponsorshipTypeID']; ?>">  <?php echo $row['strCorporateSponsorshipType']; ?> </option>
						<option disabled> &nbsp;&nbsp;&nbsp; Cost: $ <?php echo $row['dblSponsorshipCost']; ?> </option>
						<option disabled> &nbsp;&nbsp;&nbsp; Benefits: <?php echo $row['strBenefits']; ?> </option>
						<option disabled> &nbsp;&nbsp;&nbsp; Number Available: <?php echo $row['intSponsorshipAvailable']; ?> </option>
					<?php
					}
					?>
				</select></td>
			</tr>
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
						<option value="<?php echo $row['intStateID']; ?>"> <?php echo $row['strState'] ?> </option>
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
				<td class="label"> Phone of Contact: </td>
				<td> <input required type="tel" pattern="[0-9]{3}-?[0-9]{3}-?[0-9]{4}" name="txtPhone" placeholder="XXX-XXX-XXXX"> </td>
			</tr>
			<tr>
				<td class="label"> Email of Contact: </td>
				<td> <input required type="email" name="txtEmail"> </td>
			</tr>
			<tr>
				<td colspan="2" class="button"> <input type="submit" name="btnSubmit"> </td>
			</tr>
		<table>
	</form>
</div>

<?php mysqli_close($conn); ?>

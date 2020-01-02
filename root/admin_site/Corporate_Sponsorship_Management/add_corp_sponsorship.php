<?php
	session_start();
	ob_start();
?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Add New Corporate Sponsorship Page									  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Add Corporate Sponsorship";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../admin_header.php');
	checkLoginExpire();
?>
		
<div class="main">
	<form action="process_corp_sponsorship.php" method="post">
		<table>
			<tr>
				<td class="label"> Corporate Sponsorship Type: </td>
				<td><select required name="cmbSponsorshipType" id='cmbSponsorshipType'>
					<?php 
						$sql = "SELECT intCorporateSponsorshipTypeID, strCorporateSponsorshipType FROM TCorporateSponsorshipTypes";
						$result = mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_assoc($result))
						{
					?>
							<option value = "<?php echo $row['intCorporateSponsorshipTypeID']; ?>"> <?php echo $row['strCorporateSponsorshipType']; ?> </option>
					<?php
						}
					?>
				</select></td>
			</tr>
			<tr>
				<td class="label"> Sponsorship Cost: </td>
				<td> <input required type="number" min="0" name="txtSponsorshipCost" style="width: 7em"> </td>
			</tr>
			<tr>
				<td class="label"> Number of Sponsorships Available: </td>
				<td> <input required type="number" min="0" name="txtNumberAvailable" style="width: 7em"> </td>
			</tr>
			<tr>
				<td class="label"> Benefits: </td>
				<td><select required multiple name="cmbBenefits[]" id='cmbBenefits'>
					<?php 
						$sql = "SELECT intBenefitID, strBenefitDescription FROM TBenefits";
						$result = mysqli_query($conn, $sql); 
						while($row = mysqli_fetch_assoc($result))
						{
					?>
							<option value = "<?php echo $row['intBenefitID']; ?>"> <?php echo $row['strBenefitDescription']; ?> </option>
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
<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Login Page												  	  		  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Login";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>

<div class="main">
	<?php 
		// Expired session
		if( $_GET["sessionExpired"] == 1 ) {
			echo "Your session has expired. Please login again.";
		}
	?>

	<form action="process_login.php" method="post">
		<table>
			<tr>
				<td class="label"> ID: </td>
				<td> <input required type="text" name="txtID"> </td>
			</tr>
			<tr>
				<td class="label"> Password: </td>
				<td> <input required type="password" name="txtPassword"> </td>
			</tr>
			<tr>
				<td class="button"> <input type="submit" name="btnSubmit"> </td>
			</tr>
		</table>
	</form>
</div>
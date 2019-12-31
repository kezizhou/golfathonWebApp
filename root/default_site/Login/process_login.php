<?php
	session_start();
	ob_start();
?>

<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Process Login and Check Credentials Page							  	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
	// Header
	$strPageTitle = "Login";
	$currentPage = basename($_SERVER['PHP_SELF']);
	include('../default_header.php');
?>

<div class="main">
	<?php
		require('custom_exceptions.php');
		$strLoginID = $_POST["txtID"];
		$strPassword = $_POST["txtPassword"];
	
		// Check if credentials are valid
		$checkCredentials = "SELECT intEventCoordinatorID, strLoginID, strPassword FROM TEventCoordinators
							WHERE strLoginID = '" . $strLoginID . "'";
		try {
			if( $result = mysqli_query($conn, $checkCredentials) ) {
				if( mysqli_num_rows($result) > 0 ) {
					while( $row = mysqli_fetch_array($result) ) {
						$hashedPassword = $row["strPassword"];
						// Hashed password matches
						if( password_verify($strPassword, $hashedPassword) ) {
							$_SESSION['loginTime'] = time();
							// PHP permanent URL redirection
							header("Location: ../../admin_site/Admin_Home/admin_home.php", true, 301);
							exit();
						// Hashed password doesn't match
						} else {
							throw new InvalidCredentialException();
						}
					}
				// Invalid ID
				} elseif( mysqli_num_rows($result) == 0 ) {
					throw new InvalidCredentialException();
				}
			} else{
				throw new Exception( "ERROR: $checkCredentials" );
			}
		} catch (InvalidCredentialException $e) {
			echo $e->errorMessage();
		}
		
		mysqli_close($conn);
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
<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Custom Exception Classes for Login Page					        	  -->
<!-- -------------------------------------------------------------------------------- -->

<?php
    class InvalidCredentialException extends Exception {
        public function errorMessage() {
            $strError = "Invalid ID or password entered, please try again.";
            return $strError;
        }
    }
?>
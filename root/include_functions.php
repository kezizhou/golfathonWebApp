<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Functions used in other scripts							              -->
<!-- -------------------------------------------------------------------------------- -->

<?php
    function mySQLConnect() {
        static $conn;

        if( !isset($conn) ) {
            // Get Docker secret paths and values from the files
            $strServerName = file_get_contents( getenv('mySQLServerNameFile', true) );
            $strUsername = file_get_contents( getenv('mySQLUsernameFile', true) );
            $strPassword = file_get_contents( getenv('mySQLPasswordFile', true) );
            $strDBName = file_get_contents( getenv('mySQLDBNameFile', true) );
            $astrConfig = array( "servername"=>$strServerName, "username"=>$strUsername, "password"=>$strPassword, "dbname"=>$strDBName );
            // $astrConfig['servername'] = file_get_contents( getenv('mySQLServerNameFile', true) );
            // $astrConfig['username'] = file_get_contents( getenv('mySQLUsernameFile', true) );
            // $astrConfig['password'] = file_get_contents( getenv('mySQLPasswordFile', true) );
            // $astrConfig['dbname'] = file_get_contents( getenv('mySQLDBNameFile', true) );

            // Create connection
            $conn = mysqli_connect( $astrConfig['servername'], $astrConfig['username'], $astrConfig['password'], $astrConfig['dbname'] );
        }

        // Check connection
        if( !$conn ) {
            throw new Exception( "Connection failed: " . mysqli_connect_error() );
        }
        return $conn;
    }

    function charConvert($strText) {
        return htmlspecialchars($strText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function checkLoginExpire() {
        session_start();
        $loginDuration = 3600;
        try {
            if( isset($_SESSION['loginTime']) ) {
                if( (time() - $_SESSION['loginTime']) < $loginDuration ) {
                    return;
                } else {
                    header("Location: " . __DIR__ . "/default_site/Login/login.php?sessionExpired=1", true);
                }
            } else {
                // Login expired
                throw new Exception("Unauthenticated admin user found");
            }
        } catch (Exception $e) {
            echo $e;
            header("Location: " . __DIR__ . "/default_site/Login/login.php?sessionExpired=1", true);
        }
    }
?>
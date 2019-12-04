<!-- -------------------------------------------------------------------------------- -->
<!-- Name: Keziah Zhou                                                                -->
<!-- Abstract: Functions used in other scripts							              -->
<!-- -------------------------------------------------------------------------------- -->

<?php
    function mySQLConnect() {
        static $conn;

        if( !isset($conn) ) {
            // Connect to MySQL
            $config = parse_ini_file(dirname(__DIR__) . '\private\config.ini');

            // Create connection
            $conn = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);
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
?>
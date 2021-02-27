<?php 
//Error reporting

error_reporting(E_ALL);
ini_set('display_errors', 1);

    require ('constants.php');

    class DB_connection
	{
        //properties of DB connection
		private $db_host = DB_HOST;
		private $db_user  = DB_USER;
		private $db_pass  = DB_PASSWORD;
		private $db_name  = DB_NAME;
        public  $conn;


        // A method to create DB connection
        public function connect() {
            $this->conn = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );
            
            if (!$this->conn) {
                printf("Connection failed: %s\ ", mysqli_connect_error());
                exit();
            }
            return $this->conn;
            
        }
        
    }
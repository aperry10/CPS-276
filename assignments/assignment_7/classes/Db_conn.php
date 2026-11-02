
<?php

class DatabaseConn {

    private $conn;

    public function dbOpen() {

        try {

            $dbHost = 'localhost';
            $dbName = 'aperry10';
            $dbUsr = 'aperry10';
            $dbPass = 'OBHX5Iup9sEA7sx';

            // Establish PDO connection
            $this->conn = new PDO(
                'mysql:host=' . $dbHost . ';dbname=' . $dbName,
                $dbUsr,
                $dbPass
            );

            // Set PDO attributes
            $this->conn->setAttribute(
                PDO::ATTR_EMULATE_PREPARES,
                false
            );

            $this->conn->setAttribute(
                PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
                true
            );

            $this->conn->setAttribute(
                PDO::ATTR_AUTOCOMMIT,
                true
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $this->conn;

        } catch(PDOException $e) {

            echo $e->getMessage();

        }
    }
}

?>

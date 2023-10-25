<?php
    class Cars{

        // Connection
        private $conn;

        // Table
        private $db_table = "Cars";

        // Columns
        public $Vin;
        public $Model;
        public $Price;
        public $Color;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCars(){
            $sqlQuery = "SELECT Vin, Model, Price, Color FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createCars(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Vin = :Vin, 
                        Model = :Model, 
                        Price = :Price, 
                        Color = :Color";

        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Vin=htmlspecialchars(strip_tags($this->Vin));
            $this->Model=htmlspecialchars(strip_tags($this->Model));
            $this->Price=htmlspecialchars(strip_tags($this->Price));
            $this->Color=htmlspecialchars(strip_tags($this->Color));

        
            // bind data
            $stmt->bindParam(":Vin", $this->Vin);
            $stmt->bindParam(":Model", $this->Model);
            $stmt->bindParam(":Price", $this->Price);
            $stmt->bindParam(":Color", $this->Color);

        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // UPDATE
        public function getSingleCars(){
            $sqlQuery = "SELECT
                        Vin, 
                        Model, 
                        Price, 
                        Color
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       Vin = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Vin);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->Vin = $dataRow['Vin'];
            $this->Model = $dataRow['Model'];
            $this->Price = $dataRow['Price'];
            $this->Color = $dataRow['Color'];

        }        

        // UPDATE
        public function updateCars(){
            $sqlQuery = "UPDATE". $this->db_table ."
                    SET
                        Vin = :Vin, 
                        Model = :Model, 
                        Price = :Price, 
                        Color = :Color
                      
                    WHERE 
                        Vin = :Vin";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Vin=htmlspecialchars(strip_tags($this->Vin));
            $this->Model=htmlspecialchars(strip_tags($this->Model));
            $this->Price=htmlspecialchars(strip_tags($this->Price));
            $this->Color=htmlspecialchars(strip_tags($this->Color));

            // bind data
            $stmt->bindParam(":Vin", $this->Vin);
            $stmt->bindParam(":Model", $this->Model);
            $stmt->bindParam(":Price", $this->Price);
            $stmt->bindParam(":Color", $this->Color);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteCars(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Vin = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Vin=htmlspecialchars(strip_tags($this->Vin));
        
            $stmt->bindParam(1, $this->Vin);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>


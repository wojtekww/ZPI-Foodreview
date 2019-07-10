<?php

class Category{
    private $conn;
    private $table_name = "tbrestauranttype";
	public $id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }
	
	function getAllCategories(){
		$query = "SELECT * FROM " . $this->table_name;			
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
        if($num>0){			
			$categories = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
			return $categories;
		}	
		
        return false;		
	}    

}

?>

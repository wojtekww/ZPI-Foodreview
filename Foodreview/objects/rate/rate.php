<?php


class Rate{
    private $conn;
    private $table_rate = "tbrate";	
    private $table_user = "tbuser";
    private $table_rest = "tbrestaurant";
	
	public $description;
	public $rate;
	public $userId;	
    public $restaurantId;    
	
    public function __construct($db){
        $this->conn = $db;
    }

	function getRatesByRestaurantId($id){
					
		$query = "SELECT userName, rate, description, createdDate
					FROM " . $this->table_rate . " r
					JOIN " . $this->table_user . " u ON r.userId = u.userId
					WHERE restaurantId = " . $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$ratings = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $ratings;
		}	
        return false;		
    }    
    
    function getRatesByUserId($id){
					
		$query = "SELECT r.restaurantID, restaurantName, rate, description, userID
					FROM " . $this->table_rate . " r
					JOIN " . $this->table_rest . " re ON r.restaurantID = re.restaurantID
					WHERE userID = " . $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$ratings = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $ratings;
		}	
        return false;		
    }  
    
	function create(){
        $query = "INSERT INTO " . $this->table_rate . " (description, rate, userId, restaurantId)
        values
        (:desc, :rate, :userid, :restaurantid)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->description=htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':desc', $this->description);
        $stmt->bindParam(':rate', $this->rate);
        $stmt->bindParam(':userid', $this->userId);
        $stmt->bindParam(':restaurantid', $this->restaurantId);

        if($stmt->execute()){
            return true;
        }
        return false; 
    }

    function edit(){
        $query = "UPDATE " . $this->table_rate . "
                    SET description = :desc, rate = :rate                     
                    WHERE restaurantID= :restaurantid AND userID = :userid";
        
        $stmt = $this->conn->prepare($query);
        
        $this->description=htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(':desc', $this->description);
        $stmt->bindParam(':rate', $this->rate);
        $stmt->bindParam(':userid', $this->userId);
        $stmt->bindParam(':restaurantid', $this->restaurantId);
        if($stmt->execute()){
            return true;
        }
        return false; 
    }
    
    function delete(){
        $query = "DELETE FROM " . $this->table_rate . "                  
                    WHERE restaurantID= :restaurantid AND userID = :userid";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':userid', $this->userId);
        $stmt->bindParam(':restaurantid', $this->restaurantId);
        if($stmt->execute()){
            return true;
        }
        return false; 
    }
 
	function userRateExists(){
        $query = "SELECT * FROM " . $this->table_rate . " WHERE userID = :userId AND restaurantID = :restId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':userId', $this->userId);
        $stmt->bindParam(':restId', $this->restaurantId);

        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
            return true;
        }
        return false;
    }
	
}

?>
<?php

class Restaurant{
    private $conn;
    private $table_rest = "tbrestaurant";
	private $table_addr = "tbaddress";	
	private $table_rate = "tbrate";
	private $table_istype = "tbistype";
	private $table_additionalphoto = "tbadditionalphoto";
	
	//tbrestaurant
    public $restaurantId;
    public $name;
    public $createdDate;
	public $description;
	public $photo;
	public $ownerId;
	
	//tbrating	
	public $rating; 	//srednia ocen
	
	//tbaddress
	public $addressId;
    public $city;
    public $street;
    public $buildingNumber;
	public $localNumber;	
	public $postCode;	
	public $postCity;

	//tbistype
	public $categories;
	public $typeId;

	//tbadditional photo
	public $photoId;
    public $photoPath;
	public $restaurantIdphoto;
	public $photos;
	
    public function __construct($db){
        $this->conn = $db;
    }

	function create(){
		$query = "INSERT INTO " . $this->table_addr . " (city, street, buildingNumber, localNumber, postCode, postCity)
					VALUES
					(:city, :street, :building, :local, :code, :postCity)";
		
		$stmt = $this->conn->prepare($query);
		
		$this->city=htmlspecialchars(strip_tags($this->city));
		$this->street=htmlspecialchars(strip_tags($this->street));
		$this->buildingNumber=htmlspecialchars(strip_tags($this->buildingNumber));
		$this->localNumber=htmlspecialchars(strip_tags($this->localNumber));
		$this->postCode=htmlspecialchars(strip_tags($this->postCode));
		$this->postCity=htmlspecialchars(strip_tags($this->postCity));

		$stmt->bindParam(':city', $this->city);
		$stmt->bindParam(':street', $this->street);
		$stmt->bindParam(':building', $this->buildingNumber);
		$stmt->bindParam(':local', $this->localNumber);
		$stmt->bindParam(':code', $this->postCode);
		$stmt->bindParam(':postCity', $this->postCity);		
						
		if($stmt->execute()){	
			$this->addressId = $this->conn->lastInsertId();
			$query = "INSERT INTO " . $this->table_rest . " (restaurantName, restaurantDescription, addressID, restaurantOwner)
						VALUES
						(:name, :desc, :address, :ownerid)";
			
			$stmt = $this->conn->prepare($query);
			
			$this->name=htmlspecialchars(strip_tags($this->name));
			$this->description=htmlspecialchars(strip_tags($this->description));
			$this->addressId=htmlspecialchars(strip_tags($this->addressId));
				
			$stmt->bindParam(':name', $this->name);
			$stmt->bindParam(':desc', $this->description);
			$stmt->bindParam(':address', $this->addressId);			
			$stmt->bindParam(':ownerid', $this->ownerId);
			
			if($stmt->execute()){
				$this->restaurantId = $this->conn->lastInsertId();
				$query = "INSERT INTO " . $this->table_istype . " (restaurantID, typeID)
						VALUES
						(:restaurantId, :typeId)";
					
				$stmt = $this->conn->prepare($query);	
				
				$stmt->bindParam(':restaurantId', $this->restaurantId);
				$stmt->bindParam(':typeId', $this->typeId);
				if($this->categories)
					foreach($this->categories as &$catId){
						$this->typeId = $catId;
						$stmt->execute();
					}				
				return true;
			}
		}
		return false;

	}
	
	function getRecentlyAdded($count){
					
		$query = "SELECT r.restaurantId, restaurantName, mainPhotoPath, restaurantDescription, street, buildingNumber,  IFNULL(AVG(rate), 0) as rating
					FROM " . $this->table_rest . " r
					JOIN " . $this->table_addr . " a ON r.addressID = a.addressID 
					LEFT JOIN " . $this->table_rate . " ra ON r.restaurantID =  ra.restaurantID 
					GROUP BY r.restaurantId
					ORDER BY r.createdDate DESC
					LIMIT " . $count;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$restaurants = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $restaurants;
		}	
        return false;		
	}    
	
		function getRestaurantById($id){
					
		$query = "SELECT r.restaurantId, restaurantName, mainPhotoPath, restaurantDescription, restaurantOwner, r.createdDate, a.addressID, city, street, buildingNumber, localNumber, postCode, postCity, IFNULL(AVG(rate), 0) as rating
					FROM " . $this->table_rest . " r
					JOIN " . $this->table_addr . " a ON r.addressID = a.addressID 
					LEFT JOIN " . $this->table_rate . " ra ON r.restaurantID =  ra.restaurantID 
                    WHERE r.restaurantId = ". $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->restaurantId = $row['restaurantId'];
            $this->name = $row['restaurantName'];
            $this->createdDate = $row['createdDate'];
			$this->description = $row['restaurantDescription'];
			$this->ownerId = $row['restaurantOwner'];
            $this->photo = $row['mainPhotoPath'];
			$this->rating = $row['rating'];			
            $this->addressId = $row['addressID'];
            $this->city = $row['city'];
            $this->street = $row['street'];
			$this->buildingNumber = $row['buildingNumber'];
			$this->localNumber= $row['localNumber'];
			$this->postCode= $row['postCode'];	
			$this->postCity= $row['postCity'];
			 
			return true;
		}	
        return false;		
	}   
	function getRestaurantCategories($id){
					
		$query = "SELECT typeID
					FROM " . $this->table_istype . " r
                    WHERE restaurantId = ". $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$types = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $types;
		}	
        return false;		
	}   
	
	function nameExists(){
        $query = "SELECT * FROM " . $this->table_rest . " WHERE restaurantName = :name AND restaurantID != :restid";
        $stmt = $this->conn->prepare($query);
		
        $this->name=htmlspecialchars(strip_tags($this->name));
		
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':restid', $this->restaurantId);
		
        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
            return true;
        }
        return false;
    }
	
	function addressExists(){
        $query = "SELECT * FROM " . $this->table_addr . " WHERE city = :city AND street = :street AND buildingNumber = :building AND localNumber = :local AND addressID != :addrid";
        $stmt = $this->conn->prepare($query);
		
        $this->city=htmlspecialchars(strip_tags($this->city));
		$this->street=htmlspecialchars(strip_tags($this->street));
		$this->buildingNumber=htmlspecialchars(strip_tags($this->buildingNumber));
		$this->localNumber=htmlspecialchars(strip_tags($this->localNumber));			
		
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':street', $this->street);
        $stmt->bindParam(':building', $this->buildingNumber);
        $stmt->bindParam(':local', $this->localNumber);
        $stmt->bindParam(':addrid', $this->addressId);
				
        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
			return true;
        }
        return false;
    }	
	
	function updatePhoto(){
		$query = "UPDATE " . $this->table_rest . " 
					SET mainPhotoPath = :photo
					WHERE restaurantId = :id";		
					
		$stmt = $this->conn->prepare($query);
				
        $stmt->bindParam(':photo', $this->photo);
        $stmt->bindParam(':id', $this->restaurantId);
		if($stmt->execute())
			return true;
		return false;
	}
	function getRestaurantByType($type){
		if($type == 0){
			$query = "SELECT r.restaurantId, restaurantName, mainPhotoPath, restaurantDescription, street, buildingNumber,  IFNULL(AVG(rate), 0) as rating
					FROM " . $this->table_rest . " r
					JOIN " . $this->table_addr . " a ON r.addressID = a.addressID 
					LEFT JOIN " . $this->table_rate . " ra ON r.restaurantID =  ra.restaurantID 
					GROUP BY r.restaurantId
					ORDER BY r.createdDate DESC
					LIMIT 6" ;
		}else{
			$query = "SELECT r.restaurantId, restaurantName, mainPhotoPath, restaurantDescription, street, buildingNumber,  IFNULL(AVG(rate), 0) as rating
					FROM " . $this->table_rest . " r
					JOIN " . $this->table_addr . " a ON r.addressID = a.addressID 
					LEFT JOIN " . $this->table_rate . " ra ON r.restaurantID =  ra.restaurantID
					LEFT JOIN " .$this->table_istype . " t ON r.restaurantID = t.restaurantID
					WHERE t.typeID = " . $type . "
					GROUP BY r.restaurantId
					ORDER BY r.createdDate DESC;";
		}	
		
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$restaurants = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $restaurants;
		}	
        return false;		
	}
	
	function getRestaurantPhotosById($id){
					
		$query = "SELECT ad.restaurantId, ad.additionalPhotoPath
					FROM " . $this->table_additionalphoto .  " ad
                    WHERE ad.restaurantId = ". $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$photos = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $photos;
		}
        return false;			
	}   
	function getRestaurantsByOwnerId($id){
					
		$query = "SELECT restaurantId, restaurantName
					FROM " . $this->table_rest . " 
					WHERE restaurantOwner = " . $id;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$restaurants = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $restaurants;
		}	
        return false;		
	}    
	function delete(){
		$query =   "
					DELETE FROM " . $this->table_istype . "
						WHERE restaurantID = :restid;

					DELETE FROM " . $this->table_rate . "
						WHERE restaurantID = :restid;

					DELETE FROM " . $this->table_additionalphoto . "
						WHERE restaurantID = :restid;
					
					DELETE FROM " . $this->table_addr . " 
						WHERE addressID IN (SELECT addressID FROM " . $this->table_rest . " WHERE restaurantID = :restid);
					
					DELETE FROM " . $this->table_rest . " 
						WHERE restaurantId = :restid;";	
		
		$stmt = $this->conn->prepare($query);		
		$stmt->bindParam(':restid', $this->restaurantId);

		if($stmt->execute())
			return true;		
        return false;

	}
	function edit(){
		$query = "UPDATE " . $this->table_addr . "
                    SET city = :city, street = :street, buildingNumber = :building, localNumber = :local, postCode = :code, postCity = :postCity
                    WHERE addressID IN (SELECT addressID FROM " . $this->table_rest . " WHERE restaurantID = :restid)";
		
		$stmt = $this->conn->prepare($query);
		
		$this->city=htmlspecialchars(strip_tags($this->city));
		$this->street=htmlspecialchars(strip_tags($this->street));
		$this->buildingNumber=htmlspecialchars(strip_tags($this->buildingNumber));
		$this->localNumber=htmlspecialchars(strip_tags($this->localNumber));
		$this->postCode=htmlspecialchars(strip_tags($this->postCode));
		$this->postCity=htmlspecialchars(strip_tags($this->postCity));
		
		$stmt->bindParam(':restid', $this->restaurantId);
		$stmt->bindParam(':city', $this->city);
		$stmt->bindParam(':street', $this->street);
		$stmt->bindParam(':building', $this->buildingNumber);
		$stmt->bindParam(':local', $this->localNumber);
		$stmt->bindParam(':code', $this->postCode);
		$stmt->bindParam(':postCity', $this->postCity);		
						
		if(!$stmt->execute())
			return false;
		
		$query = "UPDATE " . $this->table_rest . "
					SET restaurantName = :name, restaurantDescription = :desc
					WHERE restaurantID = :restid";
		
		$stmt = $this->conn->prepare($query);
		
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->description=htmlspecialchars(strip_tags($this->description));
			
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':desc', $this->description);
		$stmt->bindParam(':restid', $this->restaurantId);	

		if(!$stmt->execute())
			return false;
		
		$query = "DELETE FROM " . $this->table_istype . "
			WHERE restaurantID = :restid";

		$stmt = $this->conn->prepare($query);		
		$stmt->bindParam(':restid', $this->restaurantId);

		if(!$stmt->execute())
			return false;

		$query = "INSERT INTO " . $this->table_istype . " (restaurantID, typeID)
						VALUES
						(:restaurantId, :typeId)";
					
		$stmt = $this->conn->prepare($query);	
		
		$stmt->bindParam(':restaurantId', $this->restaurantId);
		$stmt->bindParam(':typeId', $this->typeId);
		if($this->categories)
			foreach($this->categories as &$catId){
				$this->typeId = $catId;
				$stmt->execute();
			}				
		return true;	
	}
	function deleteAdditionalPhotos(){
		$query = "DELETE FROM " . $this->table_additionalphoto . "
			WHERE restaurantID = :restid";

		$stmt = $this->conn->prepare($query);		
		$stmt->bindParam(':restid', $this->restaurantId);

		if(!$stmt->execute())
			return false;
		return true;
	}
	function addAdditionalPhotos(){
		$query = "INSERT INTO " . $this->table_additionalphoto . " (additionalPhotoPath, restaurantID)
						VALUES
						(:addPhoto, :restaurantId)";
					
		$stmt = $this->conn->prepare($query);	
		
		$stmt->bindParam(':addPhoto', $this->photoPath);
		$stmt->bindParam(':restaurantId', $this->restaurantId);

		if($this->photos)
			foreach($this->photos as &$path){
				$this->photoPath = $path;
				$stmt->execute();
			}				
		return true;	
	}
}

?>

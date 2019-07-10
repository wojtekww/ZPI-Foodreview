<?php


class User{
    private $conn;
    private $table_name = "tbuser";
    public $id;
    public $imie;
    public $nazwisko;
    public $login;
    public $mail;
    public $haslo;

    public function __construct($db){
        $this->conn = $db;
    }

    function getDane($log){
        $query = "SELECT * FROM " . $this->table_name . " WHERE userlogin = :login";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':login', $log);

        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['userid'];
            $this->login = $row['userlogin'];
            $this->firstname = $row['username'];
            $this->lastname = $row['usersurname'];
            $this->password = $row['userpassword'];
            $this->userverified = $row['userverified'];
            $this->mail = $row['usermail'];

            return true;
        }
        return true;
    }

    function edit(){
        $query = "UPDATE " . $this->table_name . "
                    SET username = :un, usersurname = :usn, usermail = :um                    
                    WHERE userlogin = :ul";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':un', $this->imie);
        $stmt->bindParam(':usn', $this->nazwisko);
        $stmt->bindParam(':um', $this->mail);
        $stmt->bindParam(':ul', $this->login);
        if($stmt->execute()){
            return true;
        }
        return false; 
    }

    function create(){
        $query = "INSERT INTO " . $this->table_name . " (username, usersurname, usermail, userlogin, userpassword)
        values
        (:firstname, :lastname, :mail, :login, :password)";
        
        $stmt = $this->conn->prepare($query);
        
        $this->imie=htmlspecialchars(strip_tags($this->imie));
        $this->login=htmlspecialchars(strip_tags($this->login));
        $this->nazwisko=htmlspecialchars(strip_tags($this->nazwisko));
        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $this->haslo=htmlspecialchars(strip_tags($this->haslo));

        $stmt->bindParam(':firstname', $this->imie);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':lastname', $this->nazwisko);
        $stmt->bindParam(':mail', $this->mail);


        $password_hash = password_hash($this->haslo, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);


        if($stmt->execute()){
            return true;
        }

        return false;
 
    }

    function verify(){
        $query = "INSERT INTO tbverify (verifyuserlogin, verifyhash) VALUES (:vfusr, :vfhash);";

        $stmt = $this->conn->prepare($query);

        $this->login=htmlspecialchars(strip_tags($this->login));

        $stmt->bindParam(':vfusr', $this->login);

        $vfhash = password_hash($this->login, PASSWORD_BCRYPT);

        $stmt->bindParam(':vfhash', $vfhash);
        
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function loginExists(){

        $query = "SELECT * FROM " . $this->table_name . " WHERE userlogin = :login";

        $stmt = $this->conn->prepare($query);

        $this->login=htmlspecialchars(strip_tags($this->login));

        $stmt->bindParam(':login', $this->login);

        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['userid'];
            $this->login = $row['userlogin'];
            $this->firstname = $row['username'];
            $this->lastname = $row['usersurname'];
            $this->password = $row['userpassword'];
            $this->userverified = $row['userverified'];

            return true;
        }
        return false;

    }

    function emailExists(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE usermail = :email";

        $stmt = $this->conn->prepare($query);

        $this->mail=htmlspecialchars(strip_tags($this->mail));

        $stmt->bindParam(':email', $this->mail);

        $stmt->execute();

        $num = $stmt->rowCount();

        if($num>0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->login = $row['userlogin'];
            $this->firstname = $row['username'];
            $this->lastname = $row['usersurname'];
            $this->password = $row['userpassword'];

            return true;
        }
        return false;
    }

    function getAllUsers(){
					
		$query = "SELECT userid, userlogin, usertype FROM " . $this->table_name;
											
		$stmt = $this->conn->prepare($query);		
				
		$stmt->execute();	
		
		$num = $stmt->rowCount();
		if($num>0){	
			$users = json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));	
			return $users;
		}	
        return false;		
    }    
    
    function editPriv(){
        $query = "UPDATE " . $this->table_name . "
                    SET usertype = :usertype                    
                    WHERE userid= :userid";
        
        $stmt = $this->conn->prepare($query);
        
        $this->usertype=htmlspecialchars(strip_tags($this->usertype));

        $stmt->bindParam(':userid', $this->id);
        $stmt->bindParam(':usertype', $this->usertype);
        if($stmt->execute()){
            return true;
        }
        return false; 
    }
}

?>
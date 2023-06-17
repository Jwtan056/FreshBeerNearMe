<!-- Class for User -->
<?php
	class User {
		
		//Properties
		protected $username;
		protected $password;
		protected $fname;
                protected $lname;
                protected $contact;
                protected $dob;
		protected $email;
		protected $gender;
		protected $profile;
		
		//Default constructor
		public function __construct($username){
			$this->username = $username;
		}

		//Accessor methods03
		public function getUsername(){
			return $this->username;
		}
		
		public function firstName(){
			return $this->fname;
		}
                
                public function lastName(){
			return $this->lname;
		}
		
                public function getContact(){
			return $this->contact;
		}
                
                public function getDob(){
			return $this->dob;
		}
                
		public function getEmail(){
			return $this->email;
		}
		
		public function getGender(){
			return $this->gender;
		}
		
		public function getRole(){
			return $this->role;
		}
                             		
		//Mutator methods
		public function setfirstName($fname){
			$this->fname = $fname;
		}
                
                public function setlastName($lname) {
                        $this->lname = $lname;
                }
                
                public function setContact ($contact) {
                        $this->contact = $contact;
                }
		
                public function setDob ($dob) {
                        $this->dob = $dob;
                }
                
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function setGender($gender){
			$this->gender = $gender;
		}
		
		public function setPassword($password){
			$this->password = hash('md5', $password);
		}
	          
		//Validate Login + Retrieve user role if valid
		public function CheckLogin(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/test');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			//Insert into database
			$getuser = $collection->findOne([
				'id' => $this->id                                                                                              
			]);
			
			if($getuser != NULL AND $getuser['password'] == $this->password){
				$this->profile = $getuser['profile'];
				print($this->profile);
				return true;
                                
			}else{
				return false;
			}
			
		}

		//leader codes
		//Get all types of users
		public static function getRoles(){
			//To store all the roles
			$roles = array();
			
			//Forming database connection
			include("DatabaseConnection.php");
			
			//Prepare statement
			$statement = $conn->prepare("SELECT * FROM user_type");
			
			//Execute
			$statement->execute();
			
			//Get result
			$result = $statement->get_result();
			
			//Close connections
			$statement->close();
			$conn->close();
			
			while(($row = $result->fetch_assoc()) != false){
				array_push($roles, $row);
			}
		
			return $roles;
		}

                function getRoles2() {
                    // Connect to MongoDB
                    $client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
                    $collection = $client->selectCollection('BeerSystem','User');

                    // Get all roles
                    $roles = $collection->find();

                    // Store roles in an array
                    $rolesArray = [];

                    // Loop through the roles
                    foreach ($roles as $role) {
                        // Add each role to the array
                        $rolesArray[] = $role;
                    }

                    // Close the MongoDB connection
                    $client->close();

                    // Return the roles array
                    return $rolesArray;
                }            
	}
?>
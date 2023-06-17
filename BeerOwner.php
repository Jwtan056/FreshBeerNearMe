<!-- Class for Beer Owner -->
<?php
	class BeerOwner extends User{
		private $businessname;

		//Default constructor
		public function __construct($username){
			parent::__construct($username);
		}
		
		//Mutator method
		public function setBusinessName($businessname){
			$this->businessname = $businessname;
		}
		
		//Accessor method
		public function getBusinessName(){
			return $this->businessname;
		}

		//Register user account
		public function RegisterBeerOwner(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			//Insert into database
			$insertuser = $collection->insertOne(array(
				'username' => $this->username,
                                'password' => $this->password,
				'firstname' => $this->username,
                                'lastname' => $this->username,
                                'gender' => $this->gender,
                                'contact' => $this->contact,
                                'profile' => "2",
                                'email' => $this->email,
                                'dob' => $this->dob,
				'business name' =>$this->businessname,
			));
			
			return true;
		}
		
	}
?> 


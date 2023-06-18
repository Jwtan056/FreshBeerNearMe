<!-- Class for Beer Owner -->
<?php
	class BeerOwner extends User{
		private $businessname;

		//Default constructor
		public function __construct($_id){
			parent::__construct($_id);
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
				'_id' => $this->_id,
                'password' => $this->password,
				'firstname' => $this->fname,
                'lastname' => $this->lname,
        	    'gender' => $this->gender,
                'contact' => $this->contact,
                'profile' => "2",
                'email' => $this->email,
                'dob' => $this->dob,
				'businessname' =>$this->businessname,
			));
			
			return true;
		}

		public function ViewAllBeer(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Beer');
			
			// Get all roles
			$beers = $collection->find(array('_id' => $this->_id));
			
			return $beers;
		}
		
	}
?> 


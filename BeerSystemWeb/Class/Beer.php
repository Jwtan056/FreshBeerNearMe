<!-- Class for Beer Owner -->
<?php
	class Beer extends Venue{
		private $businessname;

		//Default constructor
		public function __construct($username){
			parent::__construct($username);
		}
		
		//Mutator method
		public function setFlavourProfile($flavourprofile){
			$this->bflavourprofile = $flavourprofile;
		}
		
		//Accessor method
		public function getFlavourProfile(){
			return $this->flavourprofile;
		}

		//Register user account
		public function AddBeer(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Venue');
			
			//Insert into database
			$insertuser = $collection->insertOne(array(
				'username' => $this->username,
                                'flavourprofile' => $this->flavourprofile,
				'origin' => $this->origin,
                                'colour' => $this->colour,
                                'additionalinfo' => $this->additionalinfo,
			));
			
			return true;
		}
		
	}
?> 


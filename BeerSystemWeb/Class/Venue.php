<!-- Class for Venue -->
<?php
	class Venue {
		//Properties
        protected $_id;
		protected $address;
		protected $contact;
		protected $days;
		protected $ownerid;
		protected $opentime;
		protected $closetime;
		protected $location;


		//Default constructor
		public function __construct(){
			
		}
		
		//Mutator method
		public function set_id($_id){
			$this->_id = $_id;
		}
		
		public function setAddress($address){
			$this->address = $address;
		}

		public function setContact($contact){
			$this->contact = $contact;
		}

		public function setDays($days){
			$this->days = $days;
		}

		public function setOwnerid($ownerid){
			$this->ownerid = $ownerid;
		}
		public function setOpentime($opentime){
			$this->opentime = $opentime;
		}
		public function setClosetime($closetime){
			$this->closetime = $closetime;
		}
		public function setLocation($location){
			$this->location = $location;
		}
                
		public function ViewAllVenues(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
			
			// Get all roles
			$Venues = $collection->find();
			
			return $Venues;
		}

		public function BOViewAllVenues($ownerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
			
			// Get all roles
			$Venues = $collection->find(array('ownerid' => $ownerid));
			
			return $Venues;
		}

		public function ViewAVenue($venueid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
			
			// Get all roles
			$Venue = $collection->find(array('_id' => $venueid));
			
			return $Venue;
		}

		public function DeleteAVenue($venueid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
			
			// Get all roles
			$Venue = $collection->deleteOne(array('_id' => $venueid));
			
			if($Venue->getDeletedCount() == 1){
				return true;
			}
			else{
				return false;
			}
			
		}

		//Search Venue
		public function SearchVenue($searchterm, $ownerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');

			//In order to do text search, need to create index in the database.
			$venue = $collection->find(['ownerid' => $ownerid,'$text' => ['$search' => $searchterm]]);

			return $venue;
		}

		//Create A Venue
		public function CreateVenue(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
			
			$exists = $collection->findOne(array('_id' => $this->_id));

			if ($exists != NULL and $exists['_id'] == $this->_id){
				return false;
			}
			
			else {
				
				//Insert into database
				$insertuser = $collection->insertOne(array(
					'_id' => $this->_id,
					'ownerid' => $this->ownerid,
					'address' => $this->address,
					'contact' => $this->contact,
					'location' => $this->location,
					'days' => $this->days,
					'closetime' =>$this->closetime,
					'opentime' =>$this->opentime,
					'promotionid' =>array()
				));

				return true;
			}
		}

		//Create user accounts
		public function EditVenue(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Venue');
				
			//Insert into database
			$insertuser = $collection->updateOne(
				['_id' => $this->_id],
				['$set' => [
					'address' => $this->address,
					'contact' => $this->contact,
					'location' => $this->location,
					'days' => $this->days,
					'closetime' =>$this->closetime,
					'opentime' =>$this->opentime
				]]
			);

			return true;
		}
}
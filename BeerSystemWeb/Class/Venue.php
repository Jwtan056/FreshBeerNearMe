<!-- Class for Venue -->
<?php
	class Venue {
		//Properties
        protected $_id;
		protected $address;
		protected $contact;
		protected $opening;
		protected $beer;
		protected $promotionid;
		protected $ownerid;

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

		public function setOpening($opening){
			$this->opening = $opening;
		}

		public function setBeer($beer){
			$this->beer = $beer;
		}

		public function setPromotionid($promotionid){
			$this->promotionid = $promotionid;
		}

		public function setOwnerid($ownerid){
			$this->ownerid = $ownerid;
		}
                
		public function ViewAllVenues(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Venue');
			
			// Get all roles
			$Venues = $collection->find();
			
			return $Venues;
		}

		public function ViewAVenue($venueid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Venue');
			
			// Get all roles
			$Venue = $collection->find(array('_id' => $venueid));
			
			return $Venue;
		}

		public function DeleteAVenue($venueid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Venue');
			
			// Get all roles
			$Venue = $collection->deleteOne(array('_id' => $venueid));
			
			if($Venue->getDeletedCount() == 1){
				return true;
			}
			else{
				return false;
			}
			
		}
}
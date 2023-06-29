<!-- Class for Beer -->
<?php
	class Beer{
		//Properties
		protected $_id;
		protected $origin;
		protected $colour;
		protected $venueid;
		protected $additional;
		protected $flavour;

		//Default constructor
		public function __construct(){
			
		}

		public function set_id($_id){
			$this->_id = $_id;
		}
		
		//Mutator method
		public function setOrigin($origin){
			$this->origin = $origin;
		}

		public function setColour($colour){
			$this->colour = $colour;
		}

		public function setVenueid($venueid){
			$this->venueid = $venueid;
		}

		public function setAdditional($additional){
			$this->additional = $additional;
		}

		public function setFlavour($flavour){
			$this->flavour = $flavour;
		}

		public function ViewAllBeers(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Beer');
			
			// Get all roles
			$Beers = $collection->find();
			
			return $Beers;
		}

		public function BOViewAllBeers($ownerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Beer');
			
			// Get all roles
			$Beers = $collection->find(array('ownerid' => $ownerid));
			
			return $Beers;
		}

		public function ViewABeer($beerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Beer');
			
			// Get all roles
			$beer = $collection->find(array('_id' => $beerid));
			
			return $beer;
		}

		public function DeleteABeer($beerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Beer');
			
			// Get all roles
			$beer = $collection->deleteOne(array('_id' => $beerid));
			
			if($beer->getDeletedCount() == 1){
				return true;
			}
			else{
				return false;
			}
			
		}

		//Search Beer
		public function SearchBeer($searchterm, $ownerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('FreshBeerNearMe','Beer');

			//In order to do text search, need to create index in the database.
			$beer = $collection->find(['ownerid' => $ownerid,'$text' => ['$search' => $searchterm]]);

			return $beer;
		}
	}
?> 


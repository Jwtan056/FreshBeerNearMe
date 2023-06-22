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
		
		//Accessor method
		public function get_id(){
			return $this->_id;
		}
		
		//Mutator method
		public function getOrigin(){
			return $this->origin;
		}

		public function getColour(){
			return $this->colour;
		}

		public function getVenueid(){
			return $this->venueid;
		}

		public function getAdditional(){
			return $this->additional;
		}
		public function getFlavour(){
			return $this->flavour;
		}		

		public function ViewAllBeers(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Beer');
			
			// Get all roles
			$Beers = $collection->find();
			
			return $Beers;
		}

		public function ViewABeer($beerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Beer');
			
			// Get all roles
			$beer = $collection->find(array('_id' => $beerid));
			
			return $beer;
		}

		public function DeleteABeer($beerid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','Beer');
			
			// Get all roles
			$beer = $collection->deleteOne(array('_id' => $beerid));
			
			if($beer->getDeletedCount() == 1){
				return true;
			}
			else{
				return false;
			}
			
		}
	}
?> 


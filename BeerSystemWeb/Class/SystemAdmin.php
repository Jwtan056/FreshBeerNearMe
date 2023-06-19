<!-- Class for System Admin -->
<?php
	class SystemAdmin extends User{
		public function __construct($_id){
			parent::__construct($_id);
		}
		
		public function ViewAllUsers(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			// Get all roles
			$users = $collection->find();
			
			return $users;
		}

		public function ViewAUser($userid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			// Get all roles
			$user = $collection->find(array('_id' => $userid));
			
			return $user;
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
	}
?> 


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

		public function DeleteAUser($userid){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			// Get all roles
			$user = $collection->deleteOne(array('_id' => $userid));
			
			if($user->getDeletedCount() == 1){
				return true;
			}
			else{
				return false;
			}
			
		}

		
		

	}
?> 


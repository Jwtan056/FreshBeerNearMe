<!-- Class for System Admin -->
<?php
	class SystemAdmin extends User{
		public function __construct($_id){
			parent::__construct($_id);
		}
		
		//Mutator method
		public function ViewAllUsers(){
			// Database Connection
			$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
			
			// Selection of database and collection
			$collection = $client->selectCollection('BeerSystem','User');
			
			// Get all roles
			$users = $collection->find();
			
			return $users;
		}
		
	}
?> 


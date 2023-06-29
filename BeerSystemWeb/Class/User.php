<!-- Class for User -->
<?php
class User
{
	//Properties
	protected $_id;
	protected $password;
	protected $fname;
	protected $lname;
	protected $contact;
	protected $dob;
	protected $email;
	protected $gender;
	protected $profile;

	//Default constructor
	public function __construct($_id)
	{
		$this->_id = $_id;
	}

	//Accessor methods03
	public function get_id()
	{
		return $this->_id;
	}

	//Mutator methods
	public function setfirstName($fname)
	{
		$this->fname = $fname;
	}

	public function setlastName($lname)
	{
		$this->lname = $lname;
	}

	public function setContact($contact)
	{
		$this->contact = $contact;
	}

	public function setDob($dob)
	{
		$this->dob = $dob;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	public function setPassword($password)
	{
		$this->password = hash('md5', $password);
	}

	//Validate Login + Retrieve user role if valid
	public function CheckLogin()
	{
		// Database Connection
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/test');

		// Selection of database and collection
		$database = $client->selectDatabase('FreshBeerNearMe');
		$collection = $database->selectCollection('User');
		
		// define query criteria -> retrieve id
		$criteria = ['_id' => $this->_id];
		
		// check if exist in system
		$getuser = $collection->findOne($criteria);

		if ($getuser != NULL and $getuser['password'] == $this->password) {
			$this->profile = $getuser['profile'];
			return ($this->profile);

		} else {
			return false;
		}

	}

	//Create user accounts
	public function CreateUserAccount(){
		// Database Connection
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
		
		// Selection of database and collection
		$collection = $client->selectCollection('FreshBeerNearMe','User');
		
		$exists = $collection->findOne(array('_id' => $this->_id));

		if ($exists != NULL and $exists['_id'] == $this->_id){
			return false;
		}
		
		else {
			
			//Insert into database
			$insertuser = $collection->insertOne(array(
				'_id' => $this->_id,
				'password' => md5($this->password),
				'firstname' => $this->fname,
				'lastname' => $this->lname,
				'gender' => $this->gender,
				'contact' => $this->contact,
				'profile' => 1,
				'email' => $this->email,
				'dob' => $this->dob,

			));

			return true;
		}	
	}

	

}
?>
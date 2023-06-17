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
	protected $role;

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

	public function getfirstName()
	{
		return $this->fname;
	}

	public function getlastName()
	{
		return $this->lname;
	}

	public function getContact()
	{
		return $this->contact;
	}

	public function getDob()
	{
		return $this->dob;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getGender()
	{
		return $this->gender;
	}

	public function getProfile()
	{
		return $this->profile;
	}

	public function getRole()
	{
		return $this->role;
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
		$database = $client->selectDatabase('BeerSystem');
		$collection = $database->selectCollection('User');
		
		// define query criteria -> retrieve id
		$criteria = ['_id' => $this->_id];
		
		// check if exist in system
		$getuser = $collection->findOne($criteria);

		if ($getuser != NULL and $getuser['password'] == $this->password) {
			$this->profile = $getuser['profile'];
			print($this->profile);
			return true;

		} else {
			return false;
		}

	}

	//Get the role of the person
	public function getRoles()
	{
		// Connect to MongoDB
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
		$collection = $client->selectCollection('BeerSystem', 'User');

		// Get all roles
		$role = $collection->findOne(array('_id' => $this->_id));

		if ($role != NULL and $role['profile'] == "1") {
			return "1";

		} 
		else if ($role != NULL and $role['profile'] == "2") {
			return "2";

		} else {
			return "0";
		}
	}
}
?>
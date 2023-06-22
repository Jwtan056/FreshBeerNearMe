<!-- Class for Promotion -->
<?php
class Promotion
{
	//Properties
	protected $_id;
	protected $name;
	protected $timeperiod;
	protected $details;
	protected $venueid;
	protected $ownerid;
	protected $condition;
	protected $status;

	//Default constructor
	public function __construct()
	{

	}

	//Accessor methods
	public function get_id()
	{
		return $this->_id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getTimePeriod()
	{
		return $this->timeperiod;
	}

	public function getDetails()
	{
		return $this->details;
	}

	public function getVenueid()
	{
		return $this->venueid;
	}

	public function getOwnerid()
	{
		return $this->ownerid;
	}

	public function getCondition()
	{
		return $this->condition;
	}

	public function getStatus()
	{
		return $this->status;
	}
	//Mutator methods
	public function set_id($_id)
	{
		return $this->_id = $_id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setTimePeriod($timeperiod)
	{
		$this->timeperiod = $timeperiod;
	}

	public function setDetails($details)
	{
		$this->details = $details;
	}

	public function setVenueid($venueid)
	{
		$this->venueid = $venueid;
	}

	public function setOwnerid($ownerid)
	{
		$this->ownerid = $ownerid;
	}

	public function setCondition($condition)
	{
		$this->condition = $condition;
	}

	public function setStatus($status)
	{
		$this->status = $status;
	}

	
	public function ViewAllPromotion(){
		// Database Connection
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
		
		// Selection of database and collection
		$collection = $client->selectCollection('BeerSystem','Promotion');
		
		// Get all roles
		$promotion = $collection->find(array('ownerid' => $this->ownerid));
		
		return $promotion;
	}

	public function ViewAPromotion($pid){
		// Database Connection
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
		
		// Selection of database and collection
		$collection = $client->selectCollection('BeerSystem','Promotion');
		
		// Get all roles
		$promotion = $collection->find(array('_id' => $pid,'ownerid' => $this->ownerid));
		
		return $promotion;
	}

	public function DeleteAPromotion($promotionid){
		// Database Connection
		$client = new MongoDB\Client('mongodb+srv://phuasiqi:Password123@fyp-test.rv5527m.mongodb.net/?retryWrites=true&w=majority');
		
		// Selection of database and collection
		$collection = $client->selectCollection('BeerSystem','Promotion');
		
		// Get all roles
		$promotion = $collection->deleteOne(array('_id' => $promotionid));
		
		if($promotion->getDeletedCount() == 1){
			return true;
		}
		else{
			return false;
		}
		
	}

}
?>
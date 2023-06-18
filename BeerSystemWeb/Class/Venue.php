<!-- Class for User -->
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
		public function __construct($_id){
			$this->__construct($_id);
		}
		
		//Mutator method
		public function setAddress($address){
			$this->address = $address;
		}

		public function setContect($contact){
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

		//Accessor method
		public function get_id(){
			return $this->_id;
		}
		
		//Mutator method
		public function getAddress(){
			return $this->address;
		}

		public function getContact(){
			return $this->contact;
		}

		public function getOpening(){
			return $this->opening;
		}

		public function getBeer(){
			return $this->beer;
		}

		public function getPromotionid(){
			return $this->promotionid;
		}

		public function getOwnerid(){
			return $this->ownerid;
		}
                
}
<!-- Class for Beer Owner -->
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
		public function __construct($_id){
			$this->__construct($_id);
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
	}
?> 


<!-- Class for User -->
<?php
	class Venue {
		
		//Properties
                protected $venuename;
                protected $flavourprofile;
                protected $origin;
                protected $colour;
                protected $additionalinfo;
                
		
		//Default constructor
		public function __construct($venuename){
			$this->venuename = $venuename;
		}

		//Accessor methods03
		public function getVenuename(){
			return $this->venuename;
		}
		
		public function getFlavourProfile(){
			return $this->flavourprofile;
		}
                
                public function getOrigin(){
			return $this->origin;
		}
		
                public function getColour(){
			return $this->colour;
		}
                
                public function getAdditionalInfo(){
			return $this->additionalinfo;
		}
                             		
		//Mutator methods
		public function setFlavourProfile($flavourprofile){
			$this->flavourprofile = $flavourprofile;
		}
                
                public function setOrigin($origin) {
                        $this->origin = $origin;
                }
                
                public function setColour ($colour) {
                        $this->colour = $colour;
                }
		
                public function setAdditionalInfo ($additionalinfo) {
                        $this->additionalinfo = $additionalinfo;
                }
                
	          
			}
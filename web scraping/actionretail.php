<?php class ActionRetail {


   public function doAction($arguments = null){
		switch ($type) {
			case 1:
				return $this->login();
			break;
			case 2:
				return $this->clickLink();
			break;
			case 3:
				return $this->postAction();
			break;
		}
   }
   
    public function doAllAction() {

	}
	
	function login() {
   
	}
	function clickLink() {
	}
	
	function postAction(){
	
	}
	
}
?>
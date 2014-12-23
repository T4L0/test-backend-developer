<?php 
use Goutte\Client; //Usar Goutte para el Web scraping
class ActionRetail {
	public client;

	public function __construct() {
		$this->client = new Client(); //Nuevo cliente Goutte
	}

	public function doAllActions($arguments = null) {
	
		//Obtener todas las instrucciones para llegar al objetivo.
        $instructions = ActionRetail::where('retail_name', '=', $arguments['retail'])->get();

        foreach ( $instructions as $action) {
			//ejecutar cada una de las instrucciones 
            if (!ActionRetail::doAction($action)) {
				//registrar si hubo un error
                Log::error(__FILE__, __LINE__, $arguments);
				return false;
            }
        }
		return true;
	}

	public function doAction($action = null){
		/*
			
			$action = array( 
			'id' => 1,
			'position' => 1,
			'type' => 1, 
			'xPath' => '#freshLogin > a', 
			'action' => 'GET');
		*/
	
		switch ($action['type']) {
			case 1:
				return $this->login($action);
			break;
			case 2:
				return $this->clickLink($action);
			break;
			case 3:
				return $this->otherAction($action);
			break;
			case 4:
				return $this->saveInfo($action);
			break;
		}
   }
   
	function login() {
		
   
	}
	function clickLink($xpath = "") {
	}
	
	function otherAction(){
	
	}
	function saveInfo() {
	
	}
	
}
?>
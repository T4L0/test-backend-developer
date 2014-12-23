<?php 
use Goutte\Client; //Usar Goutte para el Web scraping
class ActionRetail {
	public $client;
	public $crawler;
	public $form;
	public $portal;

	public function doAllActions($arguments = null) {
		
		$this->portal = Portal::find($arguments['retail']); 		//Obtener datos del portal y la ruta
		$this->client = new Goutte\Client();						//Nuevo cliente Goutte
		$this->crawler = $client->request('GET', $portal['url']);	//abrir el portal
	
        $instructions = ActionRetail::where('tipo_tarea_id', '=', $arguments['task'])
			->where('portal_id', '=', $portal['id'])
			->get();												//Obtener todas las Instrucciones de la Tarea que corresponde al retail.
			
        foreach ( $instructions as $action) {						//ejecutar cada una de las Instrucciones 
            if (!ActionRetail::doAction($action)) { 				
                Log::error(__FILE__, __LINE__, $arguments); 		//registrar si hubo un error
				return false;
            }
        }
		return true;
	}

	public function doAction($action = null){
		/*
		* Esta función ejecutará las acciones dependiendo el tipo de tarea que sea
		* Incluso esta clase podría ser sobreescrita según el portal, en caso de complejidad adicional.
		*/
		switch ($action['tipo']) { 
			case 1:
				return $this->login($action);
			break;
			case 2:
				return $this->clickLink($action);
			break;
			case 3:
				return $this->readInfo($action);
			break;
			case 5:
				return $this->isLogin($action);
			break;
		}
   }
   
	function login($action) {
		// $this->form = $crawler->selectButton('#loginClick')->form();
		$this->form = $crawler->selectButton($action['xpath'])->form();
		$this->crawler = $this->client->submit($this->form, json_decode($action['params']));
		if($this->crawler) {
			return true;
		}
		return false;
	}
	function clickLink($action) {
		// Hacer click en #freshLogin > a para ir al formulario de ingreso.
		// $this->crawler = $this->client->click($this->crawler->selectLink('#freshLogin > a')->link());
		$this->crawler = $this->client->click($this->crawler->selectLink($action['xpath'])->link());
		if($this->crawler) {
			return true;
		}
		return false;
	}
	
	function readInfo($action){
		// $this->crawler->getElementById('.price2')->firstNode()->text() ;
		$read = $this->crawler->getElementById($action['xpath'])->firstNode()->text();
		//aquí guardar información obtenida 
		//Modelo:save ($read, datetime(), etc, etc);
	}
	
	function isLogin($action) { //Lógica para verificar login.-
		
		//Si está logueado, la página tendrá el nombre de usuario bajo el tag  #greeting (falabella)
		// if($this->portal['name'] == $this->crawler->getElementById('#greeting')->firstNode()->text())
		if($this->portal['name'] == $this->crawler->getElementById($action['xpath'])->firstNode()->text()) {
			return true;
		} else {
			//Enviar Correo
		}
		
		return false;
	}
	
}
?>
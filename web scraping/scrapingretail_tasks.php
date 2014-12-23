<?php class ScrapingRetail_Task {

    public function run($arguments = array())
    {
		//$arguments = array('retail' => 'ripley');
		
		if(ActionRetail::doAll($arguments)) { //Ejecutar todas los pasos e instrucciones
			ActionRetail::successful(); //Guardar bandera en caso de éxito
		} else {
			ActionRetail::failed();  //Guardar bandera en caso de error
		}
    }
	
}
?>
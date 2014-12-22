<?php  
require_once  ('algorithms.to_words.class');


$n = $_REQUEST['n'];

try {
	$a = new  to_words($n);

	// echo "Número de ceros: " . $a->getFactorialAndZerosStringAndEasyWay(-10); 
	// echo "\n";
	// echo "Número de ceros: " . $a->getFactorialAndZeros(-10);

} catch (Exception $e) {
    echo 'Excepción: ',  $e->getMessage(), "\n";
}
?>
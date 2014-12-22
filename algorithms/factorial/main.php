<?php  
require_once  ('algorithms.factorial.class.php');


$n = $_REQUEST['n'];

try {
	$a = new  algorithms($n);

	echo "Número de ceros: " . $a->getFactorialAndZerosStringAndEasyWay(-10); 
	echo "\n";
	echo "Número de ceros: " . $a->getFactorialAndZeros(-10);

} catch (Exception $e) {
    echo 'Excepción: ',  $e->getMessage(), "\n";
}
?>
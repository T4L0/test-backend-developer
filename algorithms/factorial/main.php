<?php require_once  ('algorithms.factorial.class.php');
$n = 12;

if(isset($_REQUEST['n'])) {
	$n = $_REQUEST['n'] ;
}

try {
	$a = new  factorial($n);
	echo "Factorial de $n! : " . $a->getFactorial($n) , "; cantidad de ceros en $n! : " . $a->getFactorialAndZeros($n);

} catch (Exception $e) {
	echo 'Excepción: ',  $e->getMessage(), "\n";
}
?>
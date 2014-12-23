<?php require_once  ('algorithms.to_words.class.php');

$n = "1999999999";
// $n = "2147483647";
// if(isset($_REQUEST['n'])) {
	// $n = $_REQUEST['n'] ;
// }

try {
	$tw = new  to_words($n);

	echo "En palabras $n es: " . $tw->convert_number_to_words($n); 

} catch (Exception $e) {
	echo 'Excepción: ',  $e->getMessage(), "\n";
}
?>
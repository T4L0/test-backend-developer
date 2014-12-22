<?php class algorithms {
	/*
	@package: Test-backend-developer
	@description: Class in PHP that resolves algorithms.
	@Author: Ítalo Araya
	*/

	/**
	 * function that resolves the first requirements of algorithms, considering the factor as string.
	 * @param int $n number to calculate the factor and their amount of zeros
	 * @return int $count count of zeros.
	 */
	public function getFactorialAndZerosStringAndEasyWay($n) { 		
		if($n < 0){
			throw new Exception('Número no factorial');
		}
		return substr_count(gmp_fact($n), 0); }

	public function getFactorialAndZeros($n) {
		return $this->getZeroCount($this->getFactorial($n), 0);		
	}

	public function getFactorial($n = 1) {
		if ($n < 2) {
			if($n < 0){
				//http://es.wikipedia.org/wiki/Factorial ; 	
				// 0! = 1; 
				// n! = n * (n-1)!;
				throw new Exception('Número no factorial');
				die();
			}
			return 1; 
		} else { 
			return ($n * $this->getFactorial($n-1)); 
		}
	}

	public function getZeroCount($n) {
		$i = 0;
		while($n > 0) {
			if(($n%10) == 0) {
				$i++;
			}
			$n = round($n/10);
		}
		return $i;
	}
}
?>
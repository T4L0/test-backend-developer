<?php class to_words {
	/*
	@package: Test-backend-developer.
	@description: Class in PHP that convert number on words.
	@author: Ítalo Araya.
	@base: http://www.karlrixon.co.uk/writing/convert-numbers-to-words-with-php/
	*/
	
	
	public function checkNumber($number) {
		if ( (!is_numeric($number)) ) {
			return false;
		} 
		
		$number = (int) $number;
		
		if ( !is_int($number)) {	
			trigger_error('to_words sólo acepta números entre -' . PHP_INT_MAX . ' y ' . PHP_INT_MAX, E_USER_WARNING);
			return false;
		}
		
		if($number > 1999999999 ) {
			echo "modulo operation on big numbers, it will cast a float argument to an int and may return wrong results.";
			return false;
		}
		return true;
	}
	
	public function convert_number_to_words ($number, $plural = false) {
		// print_r(PHP_INT_MAX); print_R("<br/>");
		// print_r($number); die();
		
		if(!$this->checkNumber($number)) {
			print_r("No es número");
			return false;
		}
		
		if ($number < 0) {
			return $this->negative . $this->convert_number_to_words(abs($number)); 
		}
		
		$string = $fraction = null;
		if (strpos($number, '.') !== false) {
			list($number, $fraction) = explode('.', $number);
		}
		
		
		    
		switch (true) {
		
			case $number < 21:
				if($plural) {
					$string = $this->dictionary[$number]['plural'];
					break;
				}
				$string = $this->dictionary[$number]['singular'];
				break;
			case $number < 30:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $this->dictionary[$tens]['plural'];
				if ($units) {
					$string .= $this->dictionary[$units]['singular'];
				}
				break;
			case $number < 100:
				$tens   = ((int) ($number / 10)) * 10;
				$units  = $number % 10;
				$string = $this->dictionary[$tens]['singular'];
				if ($units) {
					$string .= $this->conjunction . $this->dictionary[$units]['singular'];
				}
				break;
			case $number < 1000:
				$hundreds  = $number / 100;
				$remainder = $number % 100;
				$hundreds = ((int)$hundreds) * 100;

				// print_r("hundreds: $hundreds");
				// print_r("remainder: $remainder");

				if($remainder == 0){
					$string = $this->dictionary[$hundreds]['singular'];
					break;
				}
				
				$string = $this->dictionary[$hundreds]['plural'];
				if ($remainder) {
					$string .= $this->separator . $this->convert_number_to_words($remainder);
				}
			break;
			
			case $number < 2000:
				// print_r("baseUnit: $baseUnit | ");
				// print_r("numBaseUnits: $numBaseUnits | ");
				// print_r("remainder: $remainder |");
				// die();
				
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				
				$string = $this->dictionary[$baseUnit]['singular'];
				if ($remainder) {
					// $string .= $remainder < 100 ? $this->separator  : $this->conjunction;
					$string .= $this->separator;
					$string .= $this->convert_number_to_words($remainder);
				}
			break;
			
			default:
				$baseUnit = pow(1000, floor(log($number, 1000)));
				$numBaseUnits = (int) ($number / $baseUnit);
				$remainder = $number % $baseUnit;
				
				// print_r("number: $number | ");
				// print_r("baseUnit: $baseUnit | ");
				// print_r("numBaseUnits: $numBaseUnits | ");
				// print_r("remainder: $remainder |");
				// die();
				
				if($numBaseUnits > 1) {
					$string = $this->convert_number_to_words($numBaseUnits, true) . ' ' . $this->dictionary[$baseUnit]['plural'];
				} else {
					$string = $this->convert_number_to_words($numBaseUnits, true) . ' ' . $this->dictionary[$baseUnit]['singular'];
				}
				
				if ($remainder) {
					$string .= $remainder < 100 ? $this->conjunction : $this->separator;
					$string .= $this->convert_number_to_words($remainder);
				}
				break;
		}

		if (null !== $fraction && is_numeric($fraction)) {
			$string .= $this->decimal;
			$words = array();
			foreach (str_split((string) $fraction) as $number) {
				$words[] = $this->dictionary[$number]['singular'];
			}
			$string .= implode(' ', $words);
		}

		return $string;
		
	
	}
	
	public $conjunction = ' y ';
    public $separator   = ' ';
    public $negative    = 'menos ';
    public $decimal     = ' , ';
	public $dictionary  = array(
		0 => array('singular' => 'cero', 'plural' => 'cero'),
		1 => array('singular' => 'uno', 'plural' => 'un'),
		2 => array('singular' => 'dos', 'plural' => 'dos'),
		3 => array('singular' => 'tres', 'plural' => 'tres'),
		4 => array('singular' => 'cuatro', 'plural' => 'cuatro'),
		5 => array('singular' => 'cinco', 'plural' => 'cinco'),
		6 => array('singular' => 'seis', 'plural' => 'seis'),
		7 => array('singular' => 'siete', 'plural' => 'siete'),
		8 => array('singular' => 'ocho', 'plural' => 'ocho'),
		9 => array('singular' => 'nueve', 'plural' => 'nueve'),
		10 => array('singular' => 'diez', 'plural' => 'dieci'),
		11 => array('singular' => 'once', 'plural' => 'once'),
		12 => array('singular' => 'doce', 'plural' => 'doce'),
		13 => array('singular' => 'trece', 'plural' => 'trece'),
		14 => array('singular' => 'catorce', 'plural' => 'catorce'),
		15 => array('singular' => 'quince', 'plural' => 'quince'),
		16 => array('singular' => 'dieciséis', 'plural' => 'dieciséis'),
		17 => array('singular' => 'diecisiete', 'plural' => 'diecisiete'),
		18 => array('singular' => 'dieciocho', 'plural' => 'dieciocho'),
		19 => array('singular' => 'diecinueve', 'plural' => 'diecinueve'),
		20 => array('singular' => 'veinte', 'plural' => 'veinti'),
		30 => array('singular' => 'treinta', 'plural' => 'treinta y'),
		40 => array('singular' => 'cuarenta', 'plural' => 'cuarenta y'),
		50 => array('singular' => 'cincuenta', 'plural' => 'cincuenta y'),
		60 => array('singular' => 'sesenta', 'plural' => 'sesenta'),
		70 => array('singular' => 'setenta', 'plural' => 'setenta'),
		80 => array('singular' => 'ochenta', 'plural' => 'ochenta'),
		90 => array('singular' => 'noventa ', 'plural' => 'noventa'),
		100 => array('singular' => 'cien', 'plural' => 'ciento'),
		200 => array('singular' => 'doscientos', 'plural' => 'doscientos'),
		300 => array('singular' => 'trescientos', 'plural' => 'trescientos'),
		400 => array('singular' => 'cuatrocientos', 'plural' => 'cuatrocientos'),
		500 => array('singular' => 'quinientos', 'plural' => 'quinientos'),
		600 => array('singular' => 'seiscientos', 'plural' => 'seiscientos'),
		700 => array('singular' => 'setecientos', 'plural' => 'setecientos'),
		800 => array('singular' => 'ochocientos', 'plural' => 'ochocientos'),
		900 => array('singular' => 'novecientos', 'plural' => 'novecientos'),
		1000 => array('singular' => 'mil', 'plural' => 'mil'),
		1000000 => array('singular' =>'millón', 'plural' => 'millones'),
		1000000000 => array('singular' =>'billón', 'plural' => 'billones'),
		//http://php.net/manual/es/language.types.integer.php
		//Bug: modulo out of the range 
		// 1000000000000 => array('singular' =>'trillón', 'plural' => 'trillones'),
		// 1000000000000000 => array('singular' =>'cuatrillón', 'plural' => 'cuatrillones'),
		// 1000000000000000000  => array('singular' =>'quintillón', 'plural' =>  'quintillones')
	);
}
?>
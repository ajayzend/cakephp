<?php

App::import('Helper', 'Form');
class RoundHelper extends AppHelper 
{
   	var $helpers = array('Form', 'Javascript', 'Html');
   
    function round_number($number)
    {	
		$number =  ceil($number);
		$second_last_digit = substr($number, -2,1);
		$first_last_digit = substr($number, -1,1);
		if($second_last_digit >= 1 || $first_last_digit >= 1)
		{
			$end = strlen($number);
			$start = strlen($number)-2;
			$out = substr($number, $start, $end); 

			$num = $number - $out + 100;
		}
		else
		{
			$num = $number;
		}
		return $num;
	}
	
	function round_number_yen($number)
    {	
		$number =  ceil($number);
		$second_last_digit = substr($number, -3,1);
		if($second_last_digit >= 0)
		{
			$end = strlen($number);
			$start = strlen($number)-3;
			$out = substr($number, $start, $end); 

			$num = $number - $out + 1000;
		}
		else
		{
			$num = $number;
		}
		return $num;
	}
    
}
?>

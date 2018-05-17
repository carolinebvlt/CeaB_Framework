<?php

/*
	v.2 :
		chrono1 = 0.000084 s.
		chrono100 = 0.001470 s.
*/
function generateRandomVar(int $lenght, bool $numbers, bool $uppercase, bool $lowercase)
{
	$var = "";
	for ($i=0; $i < $lenght; $i++) {
		$chr[0] = ($numbers === true) ? chr(mt_rand(48-57)) : null;
		$chr[1] = ($uppercase === true) ? chr(mt_rand(65,90)) : null;
		$chr[2] = ($lowercase === true) ? chr(mt_rand(97,122)) : null;
		do {
			$x = mt_rand(0,2);
			$new_chr = $chr[$x];
		} while ($new_chr === null);
		$var .= $new_chr;
	}
	var_dump($var);
}


/*
	v.1 :
		chrono1 = 0.000081 s.
		chrono100 = 0.001305 s.
*/
// function generateRandomVar(int $lenght, bool $numbers, bool $uppercase, bool $lowercase)
// {
// 	$var = "";
// 	for ($i=0; $i < $lenght ; $i++){
// 		do{
// 			$x = mt_rand(0,2);
// 			switch ($x) {
// 				case 0: $new_chr = ($numbers === true) ? chr(mt_rand(48-57)) : null; break;
// 				case 1: $new_chr = ($uppercase === true) ? chr(mt_rand(65,90)) : null; break;
// 				case 2: $new_chr = ($lowercase === true) ? chr(mt_rand(97,122))	: null; break;
// 			}
// 		} while ($new_chr === null);
// 		$var .= $new_chr;
// 	}
// 	var_dump($var);
// }

 ?>

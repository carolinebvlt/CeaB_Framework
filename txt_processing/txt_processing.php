<?php

/*
	Include this script to transforme a txt file into associative arrays.
	It generates '$result', an array containing associative arrays.

	.txt file must have this format :
		- first line = fields names
		- one line  = one entity
		- fields separator = \s+

	To turn off the interactive mode (CLI), define before including this script :
		$argv[1] = '';	// path/file.txt
		$argv[2] = ''; 	// 'true' or 'false' : echo report or not
		$argv[3] = '';	// 'y' or 'n' : continue if errors or not
*/

// DRY tools

function askUser($prompt)
{
	echo $prompt;
	$response = rtrim(fgets(STDIN));
	return $response;
}

// Opening file

if (!$file = @fopen($argv[1], 'r+')) {
	do {
		$file_path = askUser("Enter the path of the file you want to process (or Q to quit) : ");
		if ($file_path === "Q")
			exit();
		$file = @fopen($file_path, 'r+');
	} while (!$file);
}

// File to array

while (($line = fgets($file)) !== false) {
	$file_in_array[] = rtrim($line);
}

// Errors & closing file

if (!feof($file))
	throw new \Exception("Error Processing 'fgets()'", 1);
fclose($file);

// REPORT

$fields_names = preg_split('/\s+/', $file_in_array[0]);

for ($i=1; $i < (count($file_in_array)) ; $i++) {
	$entity = preg_split('/\s+/', $file_in_array[$i]);
	if (count($entity) !== count($fields_names))
	 	$errors_entities["Line #".($i+1)] = $entity;
	else
		$entities[] = $entity;
}

$nbr_fields = count($fields_names);
$nbr_entries = count($file_in_array)-1;
$nbr_complete_entities = (isset($entities)) ? count($entities) : 0;
$nbr_errors_entities = (isset($errors_entities)) ? count($errors_entities) : 0;

if(!isset($argv[2]) OR $argv[2] === 'true') {
	$report = "\n ********* REPORT *********\n\n";
	$report .= " Number of fields : \t".$nbr_fields."\n";
	$report .= " Number of entries : \t".$nbr_entries."\n";
	$report .= " Complete entities : \t".$nbr_complete_entities."\n";
	$report .= " Errors : \t\t".$nbr_errors_entities."\n";

	$report .= "\n **************************\n\n";
	echo $report;
}

if ($nbr_errors_entities !== 0) {
	echo "\n ********* ERRORS *********\n\n";
	var_dump($errors_entities);
	echo "\n **************************\n\n";
	if(!isset($argv[3])) {
		do {
			$prompt = "\n Do you want to continue without these lines ? (y/n) : ";
			$argv[3] = askUser($prompt);
		} while ($argv[3] !== 'y' AND $argv[3] !== 'n');
	}
	if ($argv[3] === 'n')
		exit();
}

// Associative arrays

foreach ($entities as $entity) {
	foreach ($entity as $key => $value) {
		$key = $fields_names[$key];
		$new_entity[$key] = $value;
	}
	$result[] = $new_entity;
}

// Display result

foreach ($result as $entity) {
	$rs = rtrim(fgets(STDIN));
	if (is_string($rs))
		print_r($entity);
}

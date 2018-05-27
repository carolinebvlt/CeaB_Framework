<?php
/*
	Assume that :
		- first line = fields names
		- one line  = one entity
		- fields separator = \s+
	=> It can be checked with this script : 'txt_processing.php'.

	Return an array containing associative arrays
*/

function makeAssociativeArrays($txt_file_path)
{
	$file = fopen($txt_file_path, 'r+')
	if (!$file)
		throw new \Exception("Error Processing 'fopen(".$txt_file_path.")'", 4001);
	while (($line = fgets($file)) !== false) {
		$file_in_array[] = rtrim($line);
	}
	if (!feof($file))
		throw new \Exception("Error Processing 'fgets()'", 1);
	fclose($file);

	$fields_names = preg_split('/\s+/', $file_in_array[0]);
	for ($i=1; $i < (count($file_in_array)) ; $i++) {
		$entity = preg_split('/\s+/', $file_in_array[$i]);
		$entities[] = $entity;
	}

	foreach ($entities as $entity) {
		foreach ($entity as $key => $value) {
			$key = $fields_names[$key];
			$new_entity[$key] = $value;
		}
		$result[] = $new_entity;
	}

	return $result;
}

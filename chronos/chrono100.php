<?php
$timestamp_start = microtime(true);
for ($i=0 ; $i<100 ; $i++) {
	// <- script ->
}
$timestamp_stop = microtime(true);
$diff_ms = $timestamp_stop - $timestamp_start;
echo 'Execution time[chrono100] : ' . number_format($diff_ms, 6) . ' s.'."\n";
?>

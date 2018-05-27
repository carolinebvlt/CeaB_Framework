<?php
$timestamp_start = microtime(true);
// <- script ->
$timestamp_stop = microtime(true);
$diff_ms = $timestamp_stop - $timestamp_start;
echo 'Execution time[chrono1] : ' . number_format($diff_ms, 6) . ' s.'."\n";
?>

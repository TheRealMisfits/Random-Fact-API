<?php
// Start Error Logging
error_reporting(E_ALL); 
ini_set('ignore_repeated_errors', TRUE); 
ini_set('display_errors', FALSE); 
ini_set('log_errors', TRUE); 
ini_set('error_log', '/errors.log'); 

// Start Page Load Counter
$start_time = microtime(TRUE);

// Set JSON Headers
header('Access-Control-Allow-Origin: *');
header("Content-type: application/json; charset=utf-8");
header("HTTP/1.1 206 Partial Content");

// Get Fact From TXT List
$f_contents = file("list.txt");
$line = $f_contents[array_rand($f_contents)];
$data = $line;

// Finish Load Time Counter 
$end_time = microtime(TRUE);
$time_taken =($end_time - $start_time)*1000;
$time_taken = round($time_taken,2);

// Generate JSON
$RandomFact = new stdClass();
$RandomFact->fact = str_replace(array("\n", "\r"), '', $line);
$RandomFact->loadtime = $time_taken;
$RandomFact->response = http_response_code();

// Send JSON
$FinalJSON = json_encode($RandomFact);
echo $FinalJSON;
?>
<?php

defined('ABSPATH') || exit;
ini_set('memory_limit', '-1');
ini_set('max_execution_time', '-1');
ini_set('display_errors', 1);

require __DIR__ . '/vendor/autoload.php';

// Insert into Google sheet code
$client = new \Google_Client();
$client->setApplicationName('Contact Test');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccesstype('offline');
$client->setAuthConfig(__DIR__ . '/credentials.json');

$service		= new Google_Service_Sheets($client);
$spreadsheetId  = "1mwAZixObpX5xl77YeUkRrsuTcdh2kbn6pdQcf915jow";
$range			= "Sheet1"; //Sheet name

$params = [
	'valueInputOption' => 'RAW'
];
$insert = [
	'insertDataOptions' => 'INSERT_ROWS'
];

$values = [
	['test', 'now'],
];

//scho "<pre>";print_r($values);echo "</pre>";exit;
$body = new Google_Service_Sheets_ValueRange([
	'values' => $values
]);
$params = [
	'valueInputOption' => 'RAW'
];

$result = $service->spreadsheets_values->append(
	$spreadsheetId,
	$range,
	$body,
	$params
);

if($result->updates->updatedRows == 1){
	echo "Success";
} else {
	echo "Fail";
}

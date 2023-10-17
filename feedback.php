<?php
require __DIR__ . '/vendor/autoload.php';

$spreadsheetId = 'YOUR_SPREADSHEET_ID';
$range = 'Sheet1!A1:C100'; // Adjust range as per your data

putenv('GOOGLE_APPLICATION_CREDENTIALS=/https://docs.google.com/spreadsheets/d/e/2PACX-1vTzMxJEs4veps0VR0FEKleveC3vINUe8NWI0GzUrV34zSecGXYIHoIkjJcbe5FFnQlMm63UqgFGm3sh/pubhtml'); // Set your credentials file path

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);

$service = new Google_Service_Sheets($client);
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        // Process each row of feedback data
        print_r($row);
    }
}

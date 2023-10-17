<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = $_POST['feedback'];

    // Define your Google Sheets API credentials and spreadsheet ID
    $credentials = '/Users/harun/code/mess/mess-402315-3c30e3670f90.json'; // Path to your credentials file
    $spreadsheetId = '101598037508472573796'; // Replace with your spreadsheet ID

    // Load Google Sheets API library
    require 'vendor/autoload.php';
    $client = new Google_Client();
    $client->setAuthConfig($credentials);
    $client->addScope(Google_Service_Sheets::SPREADSHEETS);
    $service = new Google_Service_Sheets($client);

    // Define the data to be written
    $values = [
        [$feedback]
    ];

    // Define the range where the data will be written (e.g., A2)
    $range = 'Sheet1!A2';

    // Prepare the request to update the spreadsheet
    $requestBody = new Google_Service_Sheets_ValueRange([
        'values' => $values
    ]);

    // Send the request to update the spreadsheet
    $response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, [
        'valueInputOption' => 'RAW'
    ]);

    // Check if the data was successfully written
    if ($response->getUpdatedCells() > 0) {
        echo "Feedback submitted successfully!";
    } else {
        echo "Error submitting feedback. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>

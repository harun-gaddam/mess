<?php

// Set your FCM server key
$serverKey = 'BH-J9owr7wiqPf7KsO6qoGaa_ZSpKMXS6OtjxhqP92bBxFPTU-tZNissGpcdNvehLPDdcnCTcANcBapaaSWJ4YA
';

// Set your Sender ID
$senderId = '438622363688';

// Define the notification payload
$message = [
    'title' => 'New Mess Menu Available',
    'body' => 'Check out the latest menu in the Mess App!',
];

$fields = [
    'to' => '/topics/mess_updates', // or use the registration token of the specific user
    'notification' => $message,
];

$headers = [
    'Authorization: key=' . $serverKey,
    'Content-Type: application/json',
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>

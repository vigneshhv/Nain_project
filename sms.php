<?php

require_once __DIR__ . '/vendor/autoload.php';
$abc="123";
$number='+918431030800';
// Set your Twilio account information
$accountSid = 'AC395b054e1279169508e8e843855401c3';
$authToken = 'c76348c69b1303caec6b07c820cfc434';
$twilioNumber = '+15673812378';

// Set the recipient's phone number and the message body
$recipientNumber = $number;
$message = 'Hello this is from isafe '.$abc;

// Create a new Twilio client
$client = new Twilio\Rest\Client($accountSid, $authToken);

// Send the SMS message
$client->messages->create(
    $recipientNumber,
    array(
        'from' => $twilioNumber,
        'body' => $message
    )
);

echo 'SMS message sent!';

?>
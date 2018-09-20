<?php

require 'vendor/autoload.php';

use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\Model\SendMessageRequest;

// Configure client
$config = Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJhZG1pbiIsImlhdCI6MTUzNzQ3OTA5OSwiZXhwIjo0MTAyNDQ0ODAwLCJ1aWQiOjYxMDY4LCJyb2xlcyI6WyJST0xFX1VTRVIiXX0.4bK2djJR2EbTsGaQdGkMPGrmVYKJjpiwbYB2oKsbTXE');
$apiClient = new ApiClient($config);
$messageClient = new MessageApi($apiClient);

// Sending a SMS Message
$sendMessageRequest1 = new SendMessageRequest([
    'phoneNumber' => '09774040516',
    'message' => 'test1',
    'deviceId' => 1
]);
$sendMessageRequest2 = new SendMessageRequest([
    'phoneNumber' => '07791064781',
    'message' => 'test2',
    'deviceId' => 2
]);
$sendMessages = $messageClient->sendMessages([
    $sendMessageRequest1,
    $sendMessageRequest2
]);
print_r($sendMessages);

<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Require the Composer autoloader.
require '../vendor/autoload.php';

use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Template\Component;

// Instantiate the WhatsAppCloudApi super class.
$whatsapp_cloud_api = new WhatsAppCloudApi([
    'from_phone_number_id' => '241590615712355',
    'access_token' => 'EAARLiN8UaWQBO2OjbYP8BHZCDCXsZBS6ZA06Qna8tELWUYF5oI8mehYgCIi0kpwrjJ94WJvQxiD0fy4ZBAKGZBDlfabxKcSlmb6m6coINv6YZC2ZArtLZBWIcfzZBRpd3cMG4kRQXC3raZAsDwj9ezAiP5hn5p8LZA5sNPIM9O0nBNRVvNE9BMZB1gXZCuCDvvSOVZBiBZC',
]);

//$r = $whatsapp_cloud_api->sendTextMessage('919431426600', 'Hey there! I\'m using WhatsApp Cloud API. Visit https://www.netflie.es');

$component_header = [
        [
            'type' => 'document',
            'document' => [
                'link' => 'https://artechcomputer.com/apprise/pdf_c_ms.php?link=c3R1ZGVudF9pZD0xMw--',
            ],
        ],
];

$component_body = [
    [
        'type' => 'text',
        'text' => 'Body text goes here',
    ],
];

$components = new Component($component_header, $component_body);


//$components = new Component($component_header, $component_body, $component_buttons);

//$r =$whatsapp_cloud_api->sendTemplate('919431426600', 'hello_world'); // Language is optional

 //$r =$whatsapp_cloud_api->sendTemplate('919431426600', 'general_text', 'en', $components); // Language is optional
 
 $r =$whatsapp_cloud_api->sendTemplate('919431426600', 'send_pdf', 'en_US', $components); // Language is optional
print_r($r);


?>
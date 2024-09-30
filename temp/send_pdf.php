<?php
require __DIR__ . '/vendor/autoload.php';

use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Template\Component;

function sendWhatsAppMessageWithPDF($recipientPhoneNumber, $pdfUrl, $bodyText) {
    $whatsapp_cloud_api = new WhatsAppCloudApi([
        'from_phone_number_id' => '241590615712355',
        'access_token' => 'EAARLiN8UaWQBO2OjbYP8BHZCDCXsZBS6ZA06Qna8tELWUYF5oI8mehYgCIi0kpwrjJ94WJvQxiD0fy4ZBAKGZBDlfabxKcSlmb6m6coINv6YZC2ZArtLZBWIcfzZBRpd3cMG4kRQXC3raZAsDwj9ezAiP5hn5p8LZA5sNPIM9O0nBNRVvNE9BMZB1gXZCuCDvvSOVZBiBZC',
    ]);

    $component_header = [
        [
            'type' => 'document',
            'document' => [
                'link' => $pdfUrl,
            ],
        ],
    ];

    $component_body = [
        [
            'type' => 'text',
            'text' => $bodyText,
        ],
    ];

    $components = new Component($component_header, $component_body);

    $response = $whatsapp_cloud_api->sendTemplate($recipientPhoneNumber, 'send_pdf', 'en_US', $components);

    return $response;
}


$recipientPhoneNumber = '91'.$_REQUEST['mobile'];
$pdfUrl = $_REQUEST['url'];
$bodyText = $_REQUEST['text'];

$response = sendWhatsAppMessageWithPDF($recipientPhoneNumber, $pdfUrl, $bodyText);

echo json_encode($response);

?>

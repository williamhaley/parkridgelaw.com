<?php

define('REQUIRED_FILE', '../vendor/autoload.php');
define('SENDER',        $_SERVER['MAIL_DAEMON_SENDER']);
define('RECIPIENT',     $_SERVER['MAIL_DAEMON_RECIPIENT']);
define('REGION',        'us-east-1');

define('SUBJECT', '[parkridgelaw.com - new message]');

require REQUIRED_FILE;

use Aws\Ses\SesClient;

$client = SesClient::factory(array(
    'version'=> 'latest',
    'region' => REGION
));

function getVar($arr, $named) {
    return !empty($arr[$named]) ? $arr[$named] : "$named not provided";
}

$name    = getVar($_POST, 'name');
$email   = getVar($_POST, 'email');
$comment = getVar($_POST, 'comment');
$phone   = getVar($_POST, 'phone');

$subject = "[parkridgelaw.com - new message]";

$message = "Hi Dad,\n\nYou received a new message from someone through your website.\n\n";

$message .= implode("\n", array("Name: $name", "Email: $email", "Phone: $phone", "Comment: $comment"));

$request = array();
$request['Source'] = SENDER;
$request['Destination']['ToAddresses'] = array(RECIPIENT);
$request['Message']['Subject']['Data'] = SUBJECT;
$request['Message']['Body']['Text']['Data'] = $message;

try {
    $result = $client->sendEmail($request);
    $messageId = $result->get('MessageId');
    echo("Email sent! Message ID: $messageId"."\n");
} catch (Exception $e) {
    echo("The email was not sent. Error message: ");
    echo($e->getMessage()."\n");
}

?>

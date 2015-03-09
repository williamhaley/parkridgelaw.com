<?php

function getVar($arr, $named) {
        return !empty($arr[$named]) ? $arr[$named] : "$named not provided";
}

$name    = getVar($_POST, 'name');
$email   = getVar($_POST, 'email');
$comment = getVar($_POST, 'comment');
$phone   = getVar($_POST, 'phone');

$subject = "[parkridgelaw.com - new message]";

$message = "Hey Dad,\n\nYou got a message from someone through your website.\n\n";

$message .= implode("\n", array("Name: $name", "Email: $email", "Phone: $phone", "Comment: $comment"));

$result = mail('', $subject, $message);

if (!$result) {
	header("HTTP/1.0 500 Internal Server Error");
} else {
	header("HTTP/1.1 200 OK");
}

header('Content-Type: application/json');
echo json_encode($result == true);

<?php

function getVar($arr, $named) {
        return !empty($arr[$named]) ? $arr[$named] : "$named not provided";
}

$name    = getVar($_GET, 'name');
$email   = getVar($_GET, 'email');
$comment = getVar($_GET, 'comment');
$phone   = getVar($_GET, 'phone');

$subject = "[parkridgelaw.com - new message]";

$message = "Hey Dad,\n\nYou got a message from someone through your website.\n\n";

$message .= implode("\n", array("Name: $name", "Email: $email", "Phone: $phone", "Comment: $comment"));

$result = mail('willhy@gmail.com', $subject, $message);

header('Content-Type: application/json');
echo json_encode($result == true);

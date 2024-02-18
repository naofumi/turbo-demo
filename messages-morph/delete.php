<?php
include('../inc/start.php');
$id = $_GET['id'];

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    array_splice($messages, intval($id), 1);
    $_SESSION['messages'] = $messages;

    http_response_code(303);
    header("Location: index.php");
} else {
}

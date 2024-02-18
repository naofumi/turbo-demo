<?php
include('../inc/start.php');

global $default_messages;
require('../inc/default_messages.php');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $_SESSION['messages'] = $default_messages;

    http_response_code(303);
    header("Location: index.php");
} else {
}

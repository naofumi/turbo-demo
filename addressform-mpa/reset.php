<?php
include('../inc/start.php');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    unset($_SESSION['name']);
    unset($_SESSION['zipcode']);
    unset($_SESSION['prefecture']);
    unset($_SESSION['city']);
    unset($_SESSION['address']);

    http_response_code(303);
    header("Location: index.php");
} else {
}

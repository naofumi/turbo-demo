<?php
session_start();
if (isset($_SESSION['sleep_duration'])) {
    sleep($_SESSION['sleep_duration']);
} else {
    $_SESSION['sleep_duration'] = 0;
}

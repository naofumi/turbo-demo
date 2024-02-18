<?php
session_start();

global $skip_sleep;
if (!isset($skip_sleep) || !$skip_sleep) {
    if (isset($_SESSION['sleep_duration'])) {
        usleep($_SESSION['sleep_duration'] * 1000000);
    } else {
        $_SESSION['sleep_duration'] = 0;
    }
}

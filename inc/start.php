<?php
session_start();
if (isset($_SESSION['sleep_duration'])) {
    usleep($_SESSION['sleep_duration'] * 1000000);
} else {
    $_SESSION['sleep_duration'] = 0;
}

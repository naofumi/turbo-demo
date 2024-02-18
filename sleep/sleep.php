<?php
$skip_sleep = true;
include('../inc/start.php');

// 本当はここでopen redirect vulnerabilityの対策をしないといけないけど、省略した
// https://www.techradar.com/features/what-is-open-redirect-vulnerability
$return_to = $_GET['return_to'] ?? 'index.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['sleep_duration'];
    $_SESSION['sleep_duration'] = $_POST['sleep_duration'];

    http_response_code(303);
    header("Location: {$return_to}");
} else {
    $sleep_duration = $_SESSION['sleep_duration'];
}
?>

<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head-mpa.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<div class="content">
    <h1>Edit Sleep Duration</h1>
    <form method="post">
        <input type="text" name="sleep_duration" value="<?php echo $sleep_duration ?>">
        <input type="submit" value="Save" class="btn btn-primary">
    </form>
</div>


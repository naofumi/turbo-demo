<?php
include('../inc/start.php');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    array_push($messages, $_POST['message']);
    $_SESSION['messages'] = $messages;

    http_response_code(303);
    header("Location: index.php");
} else {
    $message = "";
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head-redirect.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<turbo-frame id="edit-pane">
    <h1>New message</h1>
    <form method="post" action="new.php">
        <textarea name="message" rows="5" cols="50"><?php echo $message ?></textarea>
        <div style="text-align: right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</turbo-frame>

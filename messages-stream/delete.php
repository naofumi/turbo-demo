<?php
include('../inc/start.php');
$id = $_GET['id'];

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    array_splice($messages, intval($id), 1);
    $_SESSION['messages'] = $messages;
    // ここでTurboStream
    header('Content-Type: text/vnd.turbo-stream.html');
    ?>
    <turbo-stream action="remove" target="message_<?php echo $id ?>">
    </turbo-stream>
    <turbo-stream action="replace" target="message_count">
        <template>
            <span style="font-size: 2rem" id="message_count"><?php echo sizeof($messages); ?></span>
        </template>
    </turbo-stream>
    <?php
    die();
} else {
}

<?php
include('../inc/start.php');

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    array_push($messages, $_POST['message']);
    $_SESSION['messages'] = $messages;
    // ここでTurboStream
    header('Content-Type: text/vnd.turbo-stream.html');
    $id = sizeof($messages) - 1;
    ?>
    <turbo-stream action="append" target="messages">
        <template>
            <div class="each-line" id="message_<?php echo $id ?>">
                <?php echo $messages[$id] ?>
                <a href="edit.php?id=<?php echo $id ?>"
                   onclick="getElementById('edit-dialog').show()"
                   data-turbo-frame="edit-pane" class="ml-2 btn btn-primary">Edit</a>
                <form method="post" action="delete.php?id=<?php echo $id ?>" style="display:inline-block;">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </template>
    </turbo-stream>
    <turbo-stream action="replace" target="message_count">
        <template>
            <span style="font-size: 2rem" id="message_count"><?php echo sizeof($messages); ?></span>
        </template>
    </turbo-stream>
    <?php
    die();
} else {
    $message = "";
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head-stream.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<turbo-frame id="edit-pane">
    <h1>New message</h1>
    <form method="post" action="new.php">
        <textarea name="message" rows="5" cols="50"><?php echo $message ?></textarea>
        <div style="text-align: right">
            <input type="submit"
                   onclick="getElementById('edit-dialog').close()"
                   value="Save"
                   class="btn btn-primary">
        </div>
    </form>
</turbo-frame>

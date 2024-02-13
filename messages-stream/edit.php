<?php
include('../inc/start.php');
$id = $_GET['id'];

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    $messages[$id] = $_POST['message'];
    $_SESSION['messages'] = $messages;
    // ここでTurboStream
    header('Content-Type: text/vnd.turbo-stream.html');
    ?>
    <turbo-stream action="replace" target="message_<?php echo $id ?>">
        <template>
            <div class="each-line" id="message_<?php echo $id ?>">
                <?php echo $messages[$id] ?>
                <a href="edit.php?id=<?php echo $id ?>"
                   onclick="getElementById('edit-dialog').show()"
                   data-turbo-frame="edit-pane" class="ml-2 btn btn-sm btn-primary">Edit</a>
                <form method="post" action="delete.php?id=<?php echo $id ?>" style="display:inline-block;">
                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                </form>
            </div>
        </template>
    </turbo-stream>
    <?php
    die();
} else {
    $message = $_SESSION['messages'][$id];
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head-stream.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<turbo-frame id="edit-pane">
    <h1>Edit message</h1>
    <form action="edit.php?id=<?php echo $id ?>" method="post">
        <textarea name="message" rows="5" cols="50"><?php echo $message ?></textarea>
        <div style="text-align: right">
            <input type="submit"
                   value="Save"
                   onclick="getElementById('edit-dialog').close()"
                   class="btn btn-primary">
        </div>
    </form>
</turbo-frame>

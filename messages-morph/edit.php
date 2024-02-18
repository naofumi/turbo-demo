<?php
include('../inc/start.php');
$id = $_GET['id'];

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $messages = $_SESSION['messages'];
    $messages[$id] = $_POST['message'];
    $_SESSION['messages'] = $messages;

    http_response_code(303);
    header("Location: index.php");
} else {
    $message = $_SESSION['messages'][$id];
}
?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<turbo-frame id="edit-pane">
    <h1>Edit message</h1>
    <form action="edit.php?id=<?php echo $id ?>" method="post">
        <textarea name="message" rows="5" cols="50"><?php echo $message ?></textarea>
        <div style="text-align: right">
            <input type="submit" value="Save" class="btn btn-primary">
        </div>
    </form>
</turbo-frame>

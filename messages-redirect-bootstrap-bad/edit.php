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
<?php include('../inc/head-turbo-bootstrap.php') ?>
<body>
<?php include('../inc/top_nav.php') ?>

<turbo-frame id="edit-modal">
    <div class="modal fade" id="exampleModal" tabindex="-1"
         aria-labelledby="exampleModalLabel" aria-hidden="true"
         data-controller="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit.php?id=<?php echo $id ?>" method="post">
                        <textarea name="message" rows="5" cols="50"><?php echo $message ?></textarea>
                        <div style="text-align: right">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</turbo-frame>

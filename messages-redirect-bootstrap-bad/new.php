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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New message</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="new.php">
                        <textarea name="message" rows="5" class="w-100"><?php echo $message ?></textarea>
                        <div style="text-align: right">
                            <input type="submit" value="Save" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</turbo-frame>

<?php
include('../inc/start.php');

if (!isset($_SESSION['messages'])) {
    load_default_messages();
}

$messages = $_SESSION['messages'];

function load_default_messages()
{
    global $default_messages;
    require('../inc/default_messages.php');
    $_SESSION['messages'] = $default_messages;
}

?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head-stream.php') ?>
<body style="position:relative">

<?php include('../inc/top_nav.php') ?>

<div class="content">
    <h1>Messages Index</h1>
    <div class="align-right">
        <form action="reset.php" method="post">
            <input type="submit" value="Reset content" class="btn btn-danger">
        </form>
    </div>
    <div>
        メッセージ数: <span style="font-size: 2rem" id="message_count"><?php echo sizeof($messages); ?></span>
        <a href='new.php'
           onclick="getElementById('edit-dialog').show()"
           data-turbo-frame="edit-pane"
           class="btn btn-primary ml-2">New message</a>
        <a href="javascript:void(0)" onclick="getElementById('help').classList.toggle('hidden')"
           class="btn btn-outline-primary ml-2">Help</a>
    </div>
    <div style="display: flex;align-items: center;" class="hidden" id="help" data-turbo-permanent>
        <div style="width: 2rem">
            <div style="height: 2rem; width: 2rem; display: inline-block; color: blue;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                          clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div style="padding: 8px;">
            <ol>
                <li>New messageで新しいメッセージを作成します。Editへメッセージの編集。Deleteでメッセージを削除できます。</li>
                <li>トップナビゲーションのSleepを使うと、サーバの応答時間を調整できます。遅いネットワークのシミュレーションに使えます。</li>
            </ol>
        </div>

    </div>
    <div class="mt-2" id="messages">
        <?php for ($i = 0; $i < sizeof($messages); $i++): ?>
            <div class="each-line" id="message_<?php echo $i ?>">
                <?php echo $messages[$i] ?>
                <a href="edit.php?id=<?php echo $i ?>"
                   onclick="getElementById('edit-dialog').show()"
                   data-turbo-frame="edit-pane" class="ml-2 btn btn-sm btn-primary">Edit</a>
                <form method="post" action="delete.php?id=<?php echo $i ?>" style="display:inline-block;">
                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                </form>
            </div>
        <?php endfor; ?>
    </div>
    <dialog id="edit-dialog" class="dialog">
        <div style="text-align: right">
            <a href="javascript:void(0)" onclick="getElementById('edit-dialog').close()">[X] Close</a>
        </div>
        <turbo-frame id="edit-pane" target="_top">
        </turbo-frame>
    </dialog>
</div>
</body>

<?php
include('../inc/start.php');

$zipcode_dictionary = array("1020072" => array("東京都", "千代田区", "飯田橋"),
                            "1040044" => array("東京都", "中央区", "明石町"),
                            "1060045" => array("東京都", "港区", "麻布十番"));

$zipcodes = array_keys($zipcode_dictionary);

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['zipcode'] = $_POST['zipcode'];
    $_SESSION['prefecture'] = $_POST['prefecture'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['address'] = $_POST['address'];

    http_response_code(303);
    header("Location: index.php");
} else {
    $name = $_SESSION['name'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $zipcode = $_SESSION['zipcode'] ?? '';
    $prefecture = $_SESSION['prefecture'] ?? '';
    $city = $_SESSION['city'] ?? '';
    $address = $_SESSION['address'] ?? '';

    if (isset($_GET['zipcode'])) {
        $zipcode = $_GET['zipcode'];
        $prefecture = $zipcode_dictionary[$zipcode][0];
        $city = $zipcode_dictionary[$zipcode][1];
    }
}


?>
<!DOCTYPE html>
<html lang="ja">
<?php include('../inc/head.php') ?>
<body>
<script>
  function fetchAddressForZipcode() {
    const select = document.getElementById('zipcode');
    const url = `index.php?zipcode=${select.value}`;
    // document.location.href = url;
    Turbo.visit(url, {action: 'replace', frame: 'zipable-address'});
  }
</script>
<?php include('../inc/top_nav.php') ?>
<div class="content">
    <h1>Address Form</h1>
    <div>
        <form method="post">
            <div class="mt-2">
                <label for="name">お名前</label>
                <input type="text" name="name" id="name" value="<?php echo $name ?>">
            </div>
            <div class="mt-2">
                <label for="name">メールアドレス</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>">
            </div>
            <turbo-frame id="zipable-address" target="_top">
                <div class="mt-2">
                    <label for="zipcode">郵便番号</label>
                    <select name="zipcode" id="zipcode">
                        <?php foreach ($zipcodes as $my_zipcode): ?>
                            <option value="<?php echo $my_zipcode ?>" <?php echo $my_zipcode == $zipcode ? 'selected' : '' ?>>
                                <?php echo $my_zipcode ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="button" class="btn btn-outline-primary" onclick="fetchAddressForZipcode()">
                        郵便番号の送信
                    </button>
                </div>

                <div class="mt-2">
                    <label for="prefecture">都道府県</label>
                    <input type="text" name="prefecture"
                           id="prefecture" value="<?php echo $prefecture ?>">
                </div>
                <div class="mt-2">
                    <label for="city">市区町村</label>
                    <input type="text" name="city"
                           id="city" value="<?php echo $city ?>">
                </div>
            </turbo-frame>
            <div class="mt-2">
                <label for="address">以降の住所</label>
                <input type="text" name="address" ,
                       id="address" , value="<?php echo $address ?>">
            </div>
            <div class="mt-2">
                <input type="submit" value="住所を送信" class="btn btn-primary">
            </div>
        </form>
        <form action="reset.php" method="post" style="display:inline-block;">
            <input type="submit" value="住所をクリア" class="btn btn-danger">
        </form>
    </div>
</div>
</body>
</html>

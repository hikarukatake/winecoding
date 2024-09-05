<?php
session_start();
$form_error = false;
$_SESSION['errors'] = [];

// 名前のチェック
if (!empty($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
} else {
    $_POST['name'] = "";
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['errors']['name'] = "名前が空でした";
    $form_error = true;
}


// メアド
if (!empty($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
} else {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['errors']['email'] = "emailが空でした";
    $form_error = true;
}


// メアド確認用
if (!empty($_POST['email2'])) {
    if ($_POST["email2"] === $_POST["email"]) {
        $_SESSION['email2'] = $_POST['email2'];
    } else {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['errors']['email2'] = "メールアドレスが同じではないかもしれません。";
        $form_error = true;
    }
    $_SESSION['email2'] = $_POST['email2'];
} else {
    $_SESSION['email2'] = $_POST['email2'];
    $_SESSION['errors']['email2'] = "emailが空でした";
    $form_error = true;
}

// フォームの入力ページに返す
if ($form_error) {
    header('Location: inquiry.php');
}






if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // フォームデータの取得
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $tell = htmlspecialchars($_POST["tell"]);
    $message = htmlspecialchars($_POST['message']);

    // メールの宛先と件名の設定
    $to = "h.matsuba.sys23@morijyobi.ac.jp"; // ここに受信するメールアドレスを設定
    $subject = "お問い合わせフォームからのメッセージ";

    // メールの内容
    $body = "名前: $name\n";
    $body .= "メールアドレス: $email\n";
    $body .= "電話番号: $tell\n";
    $body .= "メッセージ:\n$message";

    // メールのヘッダー
    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // メールを送信
    if (mb_send_mail($to, $subject, $body, $headers)) {
        // セッションを破棄する処理
        // 1)セッションの中身を空にする（からの配列で上書きする）
        $_SESSION = [];

        // 2)セッションのキー(クッキー)を消去する
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 1800);
        }
        $ok = "送信に成功しました！！５秒後に戻ります！！";
        // 3)セッションのファイル(サーバー上にあるファイル)を削除する
        session_destroy();
    } else {
        $ok = "送信に失敗しました！！５秒後に戻ります！！";
    }
} else {
    echo "無効なリクエストです。";
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/send.css">
</head>

<body>
    <div class="back1">
        <div class="idea2">
            <ul>

                <span>
                    <img src="img/ルイージ.webp" class="mario fwari yoko" alt="">
                </span>
            </ul>
        </div>
        <div class="idea">
            <ul>
                <li>
                    <span>
                        <img class="noko spin" src="img/kuppa.webp" alt="">
                        <img class="noko spin" src="img/send/図1.png" alt="">
                        <img class="noko spin" src="img/send/図2.png" alt="">
                        <img class="noko spin" src="img/f.webp" alt="">
                    </span>
                </li>
            </ul>
        </div>
        <div class="animal">
            <ul>
                <li>
                    <span class="s">
                        <img class="do d1" src="img/send/nakama7.png" alt="">
                        <img class="do d2" src="img/send/nakama1.png" alt="">
                        <img class="do d3" src="img/send/nakama2.png" alt="">
                        <img class="do d4" src="img/send/nakama3.png" alt="">
                    </span>
                </li>
            </ul>
        </div>
    </div>
    <h1><?php echo $ok; ?></h1>
    <img class="damage" src="img/send/damage1.png" alt="">
    <img class="block" src="img/send/block.png" alt="">
    <meta http-equiv="Refresh" content="20; url=http://localhost/php_demo/%E3%83%AF%E3%82%A4%E3%83%B3%E9%96%8B%E7%99%BA/winecoding/index.html">
</body>

</html>
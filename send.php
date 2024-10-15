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
    $_SESSION['errors']['name'] = "名前が記入されていません";
    $form_error = true;
}

// 名前のチェック
if (!empty($_POST['tell'])) {
    $_SESSION['tell'] = $_POST['tell'];
} else {
    $_SESSION['tell'] = $_POST['tell'];
}

if (!empty($_POST['message'])) {
    $_SESSION['message'] = $_POST['message'];
} else {
    $_POST['message'] = "";
    $_SESSION['message'] = $_POST['message'];
    $_SESSION['errors']['message'] = "お問い合わせ内容が記入されていません";
    $form_error = true;
}

// メアド
if (!empty($_POST['email'])) {
    $_SESSION['email'] = $_POST['email'];
} else {
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['errors']['email'] = "メールアドレスが記入されていません";
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
} else {
    $_SESSION['email2'] = $_POST['email2'];
    $_SESSION['errors']['email2'] = "メールアドレスが記入されていません";
    $form_error = true;
}

// フォームの入力ページに返す
if ($form_error) {
    header('Location: inquiry.php');
} else {
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
            $ok = "送信が完了しました";
            // 3)セッションのファイル(サーバー上にあるファイル)を削除する
            session_destroy();
        } else {
            $ok = "送信に失敗しました！！５秒後に戻ります！！";
        }
    } else {
        echo "無効なリクエストです。";
    }
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
    <h1><?php echo $ok; ?></h1>
    <div class="border"></div>
    <h3>メッセージが送信されましたありがとうございます。<br>５秒後に戻ります。</h3>
    <meta http-equiv="Refresh" content="5; url=http://localhost/php_demo/winecoding/inquiry.php">

</body>

</html>
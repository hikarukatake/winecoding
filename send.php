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
        echo "メッセージが送信されました。";
    } else {
        echo "メッセージの送信に失敗しました。";
    }
} else {
    echo "無効なリクエストです。";
}

<?php
session_start();

// エラー内容を格納する変数
$errors = [
    "name" => "",
    "name2" => "",
    "gender" => "",
    "date" => "",
    "age" => "",
    "email" => "",
    "email2" => "",
    "hobby" => "",
    "plan" => "",
];

// confirmでエラーがあったかどうかaチェック数r
if (isset($_SESSION["errors"])) {
    // nameがあったらその値を入れるし、なかったら空の値を入れる
    // セッションのエラーメッセージがあった場合はそれぞれの変数にメッセージを格納
    $errors["name"] = isset($_SESSION["errors"]["name"]) ? $_SESSION["errors"]["name"] : "";
    $errors["name2"] = isset($_SESSION["errors"]["name2"]) ? $_SESSION["errors"]["name2"] : "";
    $errors["gender"] = isset($_SESSION["errors"]["gender"]) ? $_SESSION["errors"]["gender"] : "";
    $errors["date"] =    isset($_SESSION["errors"]["date"]) ? $_SESSION["errors"]["date"] : "";
    $errors["age"] = isset($_SESSION["errors"]["age"]) ? $_SESSION["errors"]["age"] : "";
    $errors["email"] = isset($_SESSION["errors"]["email"]) ? $_SESSION["errors"]["email"] : "";
    $errors["email2"] = isset($_SESSION["errors"]["email2"]) ? $_SESSION["errors"]["email2"] : "";
    $errors["hobby"] = isset($_SESSION["errors"]["hobby"]) ? $_SESSION["errors"]["hobby"] : "";
    $errors["plan"] = isset($_SESSION["errors"]["plan"]) ? $_SESSION["errors"]["plan"] : "";
}

// plan.phpに送ったnameを$nameに入れて戻ってきたときに同じ値を表示するための処理
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$name2 = isset($_SESSION['name2']) ? $_SESSION['name2'] : "";

$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$email2 = isset($_SESSION['email2']) ? $_SESSION['email2'] : "";

// radioボタンは必ずいずれかのフォームにちぇっくが入ってる状態が望ましいので
// 最初にページを開いた段階=セッションがない状態での初期tを設定する(例:初期値をその他にする)
$gender = isset($_SESSION['gender']) ? $_SESSION['gender'] : "男性";
$genderCheck = [
    "男性" => "",
    "女性" => "",
    "その他" => "",
];
$genderCheck[$gender] = "checked";

$date = isset($_SESSION['date']) ? $_SESSION['date'] : "";
$age = isset($_SESSION['age']) ? $_SESSION['age'] : "";



$hobby = isset($_SESSION['hobby']) ? $_SESSION['hobby'] : [];
$hobbyCheck = [
    "洋画" => "",
    "邦画" => "",
    "アニメ" => "",
    "ドラマ" => "",
    "ドキュメンタリー" => "",
    "ホラー" => "",
    "バラエティ" => "",
];
// hobbyは配列が入っているので一つずつ値を取り出して処理をする
foreach ($hobby as $data) {
    $hobbyCheck[$data] = "checked";
};
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="css/inquiry.css">
    <link rel="stylesheet" href="css/global.css">
</head>

<body>
    <header>
        <div class="header">
            <a href="index.html"><img src="img/winelogo.png" alt="トップイメージ" class="main-img" />
            </a>
            <ul>
                <li class="list">
                    <a href="index.html">
                        <img src="img/event.png" alt="" class="li-img" />
                        <p>イベント</p>
                    </a>
                </li>
                <li class="list">
                    <a href="Facility-introduction.html">
                        <img src="img/sisetusyoukai.png" alt="" />
                        <p>施設紹介</p>
                    </a>
                </li>
                <li class="list">
                    <a href="Company-Profile.html">
                        <img src="img/kaisyagaiyou.png" alt="" />
                        <p>会社概要</p>
                    </a>
                </li>
                <li class="list">
                    <a href="inquiry.html">
                        <img src="img/otoiawase.png" alt="" />
                        <p>お問い合わせ</p>
                    </a>
                </li>
            </ul>
        </div>
    </header>
    <div class="img">
        <img src="img/s-IMG_3851 1.png" class="img" alt="">
    </div>
    <ol class="breadcrumb-001">
        <li><a href="index.html">ホーム</a></li>
        <li><a href="inquiry.html">お問い合わせ</a></li>
    </ol>
    <div class="border">
        <h1>お問い合わせ</h1>
    </div>
    <div class="white">
        <div class="Form">
            <div class="Form-Item">
                <p class="Form-Item-Label">お名前</p>
                <input type="text" class="Form-Item-Input">
            </div>
            <div class="Form-Item">
                <p class="Form-Item-Label mail">メールアドレス</p>
                <input type="email" class="Form-Item-Input">
            </div>
            <div class="Form-Item">
                <p class="Form-Item-Label">電話番号</p>
                <input type="text" class="Form-Item-Input">
            </div>
            <div class="Form-Item">
                <p class="Form-Item-Label isMsg box">お問い合わせ内容</p>
                <textarea class="Form-Item-Textarea"></textarea>
            </div>
            <input type="submit" class="Form-Btn" value="送信する">
        </div>
    </div>
</body>

</html>
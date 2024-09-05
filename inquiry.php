<?php
session_start();

// エラー内容を格納する変数
$errors = [
    "name" => "",
    "email" => "",
    "email2" => "",
];

// エラーが起こっていたら表示する
if (isset($_SESSION["errors"])) {
    $errors["name"] = isset($_SESSION["errors"]["name"]) ? $_SESSION["errors"]["name"] : "";
    $errors["email"] = isset($_SESSION["errors"]["email"]) ? $_SESSION["errors"]["email"] : "";
    $errors["email2"] = isset($_SESSION["errors"]["email2"]) ? $_SESSION["errors"]["email2"] : "";
}

// send.phpに送ったnameを$nameに入れて戻ってきたときに同じ値を表示するための処理
$name = isset($_SESSION['name']) ? $_SESSION['name'] : "";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "";
$email2 = isset($_SESSION['email2']) ? $_SESSION['email2'] : "";



?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ</title>
    <link rel="stylesheet" href="css/inquiry.css">
    <link rel="stylesheet" href="css/global.css">
    <style>
        .err {
            color: red;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <img src="img/img.png" alt="トップイメージ" class="main-img" />
            <div class="gnavi__wrap">
                <ul class="gnavi__lists">
                    <li class="gnavi__list"><a href="#">イベント　　</a></li>

                    <li class="gnavi__list">
                        <a href="#">施設紹介　　</a>
                        <ul class="dropdown__lists">
                            <li class="dropdown__list"><a href="#">ホテルベルンドルフ</a></li>
                            <li class="dropdown__list"><a href="#">レストランベルンドルフ</a></li>
                            <li class="dropdown__list"><a href="#">ガラス体験工房　もりの国</a></li>
                        </ul>
                    </li>

                    <li class="gnavi__list"><a href="#">会社概要　　</a></li>
                    <li class="gnavi__list"><a href="#">お問い合わせ</a></li>
                </ul>
            </div>
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
    <form action="send.php" method="post">
        <div class="white">
            <div class="Form">
                <div class="Form-Item">
                    <p class="Form-Item-Label">お名前</p>
                    <input type="text" name="name" class="Form-Item-Input" value="<?php echo $name ?>">
                    <p class="err"><?php echo $errors["name"]; ?></p>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label mail">メールアドレス</p>
                    <input type="email" name="email" class="Form-Item-Input" value="<?php echo $email ?>">
                    <p class="err"><?php echo $errors["email"]; ?></p>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label mail" style="width: 100%;">メールアドレス確認用</p>
                    <input type="email" name="email2" class="Form-Item-Input" value="<?php echo $email2 ?>">
                    <p class="err"><?php echo $errors["email2"]; ?></p>
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label">電話番号</p>
                    <input type="text" name="tell" class="Form-Item-Input">
                </div>
                <div class="Form-Item">
                    <p class="Form-Item-Label isMsg box">お問い合わせ内容</p>
                    <textarea class="Form-Item-Textarea" name="message"></textarea>
                </div>
                <input type="submit" class="Form-Btn" value="送信する">
            </div>
        </div>
    </form>
</body>

</html>
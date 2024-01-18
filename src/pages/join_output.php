<?php
session_start();

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $name = $_POST['name'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $mail = $_POST['email'];
    $today = date("Y-m-d");
    $time = date("Y-m-d H:i");
    $file = $_FILES['upFile'];
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timeNow = time();
    $fileName = "images/" .  $timeNow . "." . $fileExt;
    move_uploaded_file($file['tmp_name'], $fileName);

    $insertSql = $pdo->prepare("insert into users values(null, ?, ?, ?, ?, null, ?)");
    $insertSql->execute([$name, $pass, $mail, $fileName, $today]);

    $pdo->commit();


    include './includes/header_top.php';
    echo '<link rel="stylesheet" href="/php2/final/src/css/join.css">';
    include './includes/header_under.php';

    echo '
        <div class="comp_wrap">
            <p class="comp">新規登録が完了しました</p>
            <a href="/php2/final/src/login" class="compA">ログイン</a>
        </div>
    ';

    include './includes/footer.php';
} catch (PDOException $e) {
    $pdo->rollBack();

    include './includes/header_top.php';
    echo '<link rel="stylesheet" href="/php2/final/src/css/error.css">';
    include './includes/header_under.php';

    echo '
        <div class="container-fluid">
            <p class="row justify-content-center">エラーが発生しました。</p>
            <div class="row justify-content-center">
                <div class="button" onclick="prev()">マイページへ</div>
            </div>
        </div>
        <script src="/php2/final/src/js/error.js"></script>
    ';

    include './includes/footer.php';

    file_put_contents("error.txt", $time . ": " . $e->getMessage() . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND);
}

<?php
session_start();

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $userID = $_SESSION['user']['id'];
    $name = nl2br($_POST['name']); // ファイル名
    $info = nl2br($_POST['info']);  // ファイル説明
    $today = date("Y-m-d"); // アップロード日
    $time = date("Y-m-d H:i");
    $imgFileName = null;    // サムネ画像

    if (isset($_POST['check'])) {
        $flg = 1;
    } else {
        $flg = 0;
    }

    if (isset($_FILES['img']) && $_FILES['img']['error'] !== UPLOAD_ERR_NO_FILE) {
        $imgFile = $_FILES['img'];
        $imgFileExt = pathinfo($imgFile['name'], PATHINFO_EXTENSION);
        $imgTimeNow = time();
        $imgFileName = "images/" .  $imgTimeNow . "." . $imgFileExt;
        move_uploaded_file($imgFile['tmp_name'], $imgFileName);
    }

    $file = $_FILES['file'];
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timeNow = time();
    $extension = $_POST['extension'];   // 拡張子

    switch ($extension) {
        case 'video':
            $fileName = "users/video/" .  $timeNow . "." . $fileExt;
            break;
        case 'audio':
            $fileName = "users/audio/" .  $timeNow . "." . $fileExt;
            break;
        case 'img':
            $fileName = "users/img/" .  $timeNow . "." . $fileExt;
            break;
    }

    move_uploaded_file($file['tmp_name'], $fileName);

    $insertSql = $pdo->prepare("insert into files values(null, ?, ?, ?, ?, ?, ?, ?, null, ?)");
    $insertSql->execute([$fileName, $name, $info, $imgFileName, $extension, $flg, $today, $userID]);

    $pdo->commit();

    include './includes/header_top.php';
    echo '<link rel="stylesheet" href="/php2/final/src/css/fileUpload.css">';
    include './includes/header_under.php';

    echo '
        <div class="comp_wrap">
            <p class="comp">ファイル登録が完了しました</p>
            <div class="compA_wrap">
                <a href="/php2/final/src/allFile" class="compA">ファイル一覧へ</a>
                <a href="/php2/final/src/fileUpload" class="compA">追加でファイルを登録する</a>
            </div>
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

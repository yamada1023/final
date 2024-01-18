<?php
session_start();

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $userID = $_SESSION['user']['id'];
    $today = date("Y-m-d");
    $time = date("Y-m-d H:i");
    $file = $_FILES['upFile'];
    $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
    $timeNow = time();
    $fileName = "images/" .  $timeNow . "." . $fileExt;
    move_uploaded_file($file['tmp_name'], $fileName);

    $updateSql = $pdo->prepare("update users set img_path = ? where id = ?");
    $updateSql->execute([$fileName, $userID]);

    $pdo->commit();

    $_SESSION['user']['img_path'] = $fileName;
    header('Location:/php2/final/src/myPage');
    exit;
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

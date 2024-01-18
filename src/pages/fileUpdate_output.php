<?php
include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $name = nl2br($_POST['name']); // ファイル名
    $info = nl2br($_POST['info']);  // ファイル説明
    $today = date("Y-m-d"); // 更新日
    $time = date("Y-m-d H:i");
    $imgFileName = null;    // サムネ画像
    $id = $_POST['id']; // ファイルID

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

    $updateSql = $pdo->prepare("update files set name = ?, info = ?, img_path = ?, flg = ?, update_date = ? where id = ?");
    $updateSql->execute([$name, $info, $imgFileName, $flg, $today, $id]);

    $pdo->commit();

    header('Location:/php2/final/src/allFile');
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

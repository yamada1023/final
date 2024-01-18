<?php
session_start();

include './config/db-connect.php';

$time = date("Y-m-d H:i");
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $updateSql = $pdo->prepare("update users set token = null where id = ?");
    $updateSql->execute([$_SESSION['user']['id']]);

    setcookie('token', '', time() - 6000, '/');
    unset($_SESSION['user']);

    include './includes/header_top.php';
    echo '<link rel="stylesheet" href="/php2/final/src/css/logout.css">';
    include './includes/header_under.php';

    echo '<p class="info">ログアウトしました。</p>';

    $pdo->commit();
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

include './includes/footer.php';

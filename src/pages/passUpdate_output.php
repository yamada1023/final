<?php
session_start();

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $userID = $_SESSION['user']['id'];
    $nowPass = $_POST['nowPass'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    $selectSql = $pdo->prepare("select * from users where id = ?");
    $selectSql->execute([$userID]);
    $select = $selectSql->fetch(PDO::FETCH_ASSOC);

    if (password_verify($nowPass, $select['password'])) {
        $updateSql = $pdo->prepare("update users set password = ? where id = ?");
        $updateSql->execute([$pass, $userID]);

        $_SESSION['user']['password'] = $pass;
        header('Location:/php2/final/src/myPage');
    } else {
        include './includes/header_top.php';
        echo '<link rel="stylesheet" href="/php2/final/src/css/error.css">';
        include './includes/header_under.php';

        echo '
            <div class="container-fluid">
                <p class="row justify-content-center">現在のパスワードが一致しません。</p>
                <a href="/php2/final/src/login" class="back">戻る</a>
            </div>
            <script src="/php2/final/src/js/error.js"></script>
        ';

        include './includes/footer.php';
    }

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

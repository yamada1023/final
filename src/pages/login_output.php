<?php
session_start();

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $mail = $_POST['e_mail'];
    $pass = $_POST['pass'];

    $sql = $pdo->prepare("select * from users where e_mail = ?");
    $sql->execute([$mail]);

    foreach ($sql as $row) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['user'] = [
                'id' => $row['id'], 'name' => $row['name'], 'password' => $row['password'],
                'e_mail' => $row['e_mail'], 'img_path' => $row['img_path'], 'token' => $row['token'],
                'join_date' => $row['join_date']
            ];
        }
    }

    if (isset($_SESSION['user'])) {
        if (empty($_POST['check'])) {
            header('Location:/php2/final/src/myPage');
        } else {
            $token = bin2hex(random_bytes(32));
            $updateSql = $pdo->prepare("update users set token = ? where id = ?");
            $updateSql->execute([$token, $_SESSION['user']['id']]);

            $options = [
                'expires' => time() + 60 * 60 * 24 * 30,
                'path' => '/',
                'httponly' => true
            ];

            setcookie('token', $token, $options);
            header('Location: ' . '/php2/final/src/myPage', true, 301);
        }
    } else {
        include './includes/header_top.php';
        echo '<link rel="stylesheet" href="/php2/final/src/css/error.css">';
        include './includes/header_under.php';

        echo '
            <div class="container-fluid">
                <p class="row justify-content-center">パスワードまたはメールアドレスが一致しません。</p>
                <a href="/php2/final/src/login" class="back">戻る</a>
            </div>
            <script src="/php2/final/src/js/error.js"></script>
        ';
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

include './includes/footer.php';

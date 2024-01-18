<?php
session_start();
if (empty($_SESSION['user']) && empty($_COOKIE['token'])) {
    header('Location:/php2/final/src/login');
    exit;
}

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    if (isset($_SESSION['user'])) {
        include './includes/header_top.php';
        echo '<link rel="stylesheet" href="/php2/final/src/css/myPage.css">';
        include './includes/header_under.php';

        echo '<p class="title">マイページ</p>';
        $selectSql = $pdo->prepare("select * from users where id = ?");
        $selectSql->execute([$_SESSION['user']['id']]);
        $select = $selectSql->fetch(PDO::FETCH_ASSOC);

        echo '
            <table class="table">
                <tr>
                    <td class="subtitle">
                        <div class="img_wrap">
                            <img class="icon" src="', $select['img_path'], '" onclick="imgUpdate()">
                            <div class="imgBack"></div>
                        </div>
                    </td>
                    <td class="data" id="name">
                        <div class="tableP" onclick="nameUpdate()">', $select['name'], '<div class="tableDiv"></div></div>
                    </td>
                </tr>
                <tr>
                    <td class="subtitle">メールアドレス：</td>
                    <td class="data">
                        <div class="tableP" onclick="mailUpdate()">', $select['e_mail'], '<div class="tableDiv"></div></div>
                    </td>
                </tr>
            </table>
            <div class="submit_wrap">
                <a class="delete" onclick="withdrawal()">アカウント削除</a>
                <a class="delete" onclick="share(', $select['id'], ')">共有URL</a>
                <a class="delete" onclick="passChange()">パスワード変更</a>
            </div>
        ';
        echo '<script src="/php2/final/src/js/myPage.js"></script>';
    } else if (isset($_COOKIE['token'])) {
        $selectSql = $pdo->prepare("select * from users where token = ?");
        $selectSql->execute([$_COOKIE['token']]);
        $select = $selectSql->fetch(PDO::FETCH_ASSOC);

        if ($select !== false) {
            include './includes/header_top.php';
            echo '<link rel="stylesheet" href="/php2/final/src/css/myPage.css">';
            include './includes/header_under.php';

            echo '<p class="title">マイページ</p>';
            $_SESSION['user'] = [
                'id' => $select['id'], 'name' => $select['name'], 'password' => $select['password'],
                'e_mail' => $select['e_mail'], 'img_path' => $select['img_path'], 'token' => $select['token'],
                'join_date' => $select['join_date']
            ];

            echo '
                <table class="table">
                    <tr>
                        <td class="subtitle">
                            <div class="img_wrap">
                                <img class="icon" src="', $select['img_path'], '" onclick="imgUpdate()">
                                <div class="imgBack"></div>
                            </div>
                        </td>
                        <td class="data" id="name">
                            <div class="tableP" onclick="nameUpdate()">', $select['name'], '<div class="tableDiv"></div></div>
                        </td>
                    </tr>
                    <tr>
                        <td class="subtitle">メールアドレス：</td>
                        <td class="data">
                            <div class="tableP" onclick="nameUpdate()">', $select['e_mail'], '<div class="tableDiv"></div></div>
                        </td>
                    </tr>
                </table>
                <div class="submit_wrap">
                    <a class="delete" onclick="withdrawal()">アカウント削除</a>
                    <a class="delete" onclick="passChange()">パスワード変更</a>
                </div>
            ';
            echo '<script src="/php2/final/src/js/myPage.js"></script>';
        } else {
            header('Location:/php2/final/src/login');
            exit;
        }
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

    file_put_contents("error.txt", $time . ": " . $e->getMessage() . "\n", FILE_USE_INCLUDE_PATH | FILE_APPEND);
}

include './includes/footer.php';

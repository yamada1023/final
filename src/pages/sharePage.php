<?php
session_start();
include './config/db-connect.php';

include './includes/header_top.php';
echo '<link rel="stylesheet" href="/php2/final/src/css/allFile.css">';
include './includes/header_under.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $selectUserSql = $pdo->prepare("select * from users where id = ?");
    $selectUserSql->execute([$_GET['id']]);
    $selectUser = $selectUserSql->fetch(PDO::FETCH_ASSOC);

    echo '<p class="title">', $selectUser['name'], 'さんの共有ファイル</p>';

    $selectFileSql = $pdo->prepare("select * from files where user_id = ? and flg = 1");
    $selectFileSql->execute([$_GET['id']]);
    $selectFile = $selectFileSql->fetchAll();

    if ($selectFile === []) {
        echo '
            <div class="container-fluid">
                <p class="row justify-content-center">登録されたファイルがありません。</p>
            </div>
        ';
    } else if (empty($_GET['ext'])) {
        echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ファイル種類選択
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '">すべて</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=video">動画</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=audio">音声</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=img">画像</a></li>
                </ul>
            </div>
        ';
        foreach ($selectFile as $row) {
            echo '<div class="container-fluid wrap"><div class="row justify-content-center">';

            if (isset($row['img_path'])) {
                echo '<img src="', $row['img_path'], '" class="icon">';
            }

            echo '<div class="row justify-content-center">';

            if ($row['extension'] == 'img') {
                echo '<img src="', $row['file_path'], '" class="img">';
            } else if ($row['extension'] == 'audio') {
                echo '<audio controls class="audio"><source src="', $row['file_path'], '" type="audio/mpeg"></audio>';
            } else if ($row['extension'] == 'video') {
                echo '<video controls class="audio"><source src="', $row['file_path'], '" type="video/mp4"></video>';
            }

            echo '</div><div class="row justify-content-center info fileName">';
            echo $row['name'];
            echo '</div><div class="row justify-content-center info">', $row['info'], '</div></div><hr>';
        }
    } else if ($_GET['ext'] == "video") {
        $cnt = true;

        echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ファイル種類選択
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '">すべて</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=video">動画</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=audio">音声</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=img">画像</a></li>
                </ul>
            </div>
        ';
        foreach ($selectFile as $row) {
            echo '<div class="container-fluid wrap"><div class="row justify-content-center">';

            if ($row['extension'] == "video") {
                if (isset($row['img_path'])) {
                    echo '<img src="', $row['img_path'], '" class="icon">';
                }

                echo '
                    <div class="row justify-content-center">
                    <video controls class="audio"><source src="', $row['file_path'], '" type="video/mp4"></video>
                    </div>
                    <div class="row justify-content-center info fileName">', $row['name'], '</div>
                    <div class="row justify-content-center info">', $row['info'], '</div></div>
                    <hr>
                ';

                $cnt = false;
            }
        }

        if ($cnt) {
            echo '
                <div class="container-fluid">
                    <p class="row justify-content-center">登録されたファイルがありません。</p>
                </div>
            ';
        }
    } else if ($_GET['ext'] == "audio") {
        $cnt = true;

        echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ファイル種類選択
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '">すべて</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=video">動画</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=audio">音声</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=img">画像</a></li>
                </ul>
            </div>
        ';
        foreach ($selectFile as $row) {
            echo '<div class="container-fluid wrap"><div class="row justify-content-center">';

            if ($row['extension'] == "audio") {
                if (isset($row['img_path'])) {
                    echo '<img src="', $row['img_path'], '" class="icon">';
                }

                echo '
                    <div class="row justify-content-center">
                    <audio controls class="audio"><source src="', $row['file_path'], '" type="audio/mpeg"></audio>
                    </div>
                    <div class="row justify-content-center info fileName">', $row['name'], '</div>
                    <div class="row justify-content-center info">', $row['info'], '</div></div>
                    <hr>
                ';

                $cnt = false;
            }
        }

        if ($cnt) {
            echo '
                <div class="container-fluid">
                    <p class="row justify-content-center">登録されたファイルがありません。</p>
                </div>
            ';
        }
    } else if ($_GET['ext'] == "img") {
        $cnt = true;

        echo '
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ファイル種類選択
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '">すべて</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=video">動画</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=audio">音声</a></li>
                    <li><a class="dropdown-item" href="/php2/final/src/sharePage?id=', $_GET['id'], '&ext=img">画像</a></li>
                </ul>
            </div>
        ';
        foreach ($selectFile as $row) {
            echo '<div class="container-fluid wrap"><div class="row justify-content-center">';

            if ($row['extension'] == "img") {
                if (isset($row['img_path'])) {
                    echo '<img src="', $row['img_path'], '" class="icon">';
                }

                echo '
                    <div class="row justify-content-center">
                        <img src="', $row['file_path'], '" class="img">
                    </div>
                    <div class="row justify-content-center info fileName">', $row['name'], '</div>
                    <div class="row justify-content-center info">', $row['info'], '</div></div>
                    <hr>
                ';
            }
        }

        if ($cnt) {
            echo '
                <div class="container-fluid">
                    <p class="row justify-content-center">登録されたファイルがありません。</p>
                </div>
            ';
        }
    }

    echo '<script src="/php2/final/src/js/allFile.js"></script>';

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

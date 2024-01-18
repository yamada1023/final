<?php
session_start();
include './includes/header_top.php';

echo '<link rel="stylesheet" href="/php2/final/src/css/fileUpdate.css">';

include './includes/header_under.php';

echo '
    <p class="title">登録ファイル更新</p>
    <p class="required">*は必須項目です</p>
';

include './config/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

    $selectSql = $pdo->prepare("select * from files where id = ?");
    $selectSql->execute([$_GET['id']]);
    $select = $selectSql->fetch(PDO::FETCH_ASSOC);

    echo '
        <form action="/php2/final/src/fileUpdate_comp" method="post" name="fileUpdateForm" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td class="subtitle"><label for="name"><span class="required">*</span>ファイル名：</label></td>
                    <td class="content">
                        <textarea name="name" id="name" cols="30" rows="1" class="input" placeholder="50文字以内">', str_replace("<br />", "", $select['name']), '</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="subtitle"><label for="info"><span class="required">*</span>ファイル説明：</label></td>
                    <td class="content">
                        <textarea name="info" id="info" cols="30" rows="10" class="input" placeholder="メモなど自由に記入しましょう！">', str_replace("<br />", "", $select['info']), '</textarea>
                    </td>
                </tr>
                <tr>
                    <td class="subtitle"><label for="img">サムネ画像：</label></td>
                    <td class="content">
                        <input type="file" name="img" id="img" onchange="prevImg()" accept="image/*">
                        <img id="preview">
                    </td>
                </tr>
            </table>';

    if ($select['flg'] === 0) {
        echo '<label class="label"><input type="checkbox" name="check" id="check">共有ファイルにする</label>';
    } else {
        echo '<label class="label"><input type="checkbox" name="check" id="check" checked>共有ファイルにする</label>';
    }

    echo '
            <input type="text" name="id" id="id" value="', $select['id'], '" hidden>
            <div class="button_wrap">
                <div class="button prev" onclick="prev()">戻る</div>
                <div class="button next" onclick="send()">更新</div>
            </div>
        </form>
    ';

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

echo '<script src="/php2/final/src/js/fileUpdate.js"></script>';

include './includes/footer.php';

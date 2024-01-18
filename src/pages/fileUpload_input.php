<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/fileUpload.css">

<?php include './includes/header_under.php'; ?>

<p class="title">ファイル登録</p>
<p class="notice">10MBまでの動画ファイル(mp4)、音声ファイル(mp3)、画像ファイルのみアップロードできます</p>
<p class="required">*は必須項目です</p>
<form action="/php2/final/src/fileUpload_comp" method="post" name="fileUploadForm" enctype="multipart/form-data" class="form">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="file"><span class="required">*</span>ファイル：</label></td>
            <td class="content">
                <input type="file" name="file" id="file" accept="video/mp4, audio/mpeg, image/*" class="input" onchange="checkFileType()">
                <input type="text" name="extension" id="extension" hidden>
            </td>
        </tr>
        <tr>
            <td class="subtitle"><label for="name"><span class="required">*</span>ファイル名：</label></td>
            <td class="content"><textarea name="name" id="name" cols="30" rows="1" class="input" placeholder="50文字以内"></textarea></td>
        </tr>
        <tr>
            <td class="subtitle"><label for="info"><span class="required">*</span>ファイル説明：</label></td>
            <td class="content"><textarea name="info" id="info" cols="30" rows="10" class="input" placeholder="メモなど自由に記入しましょう！"></textarea></td>
        </tr>
        <tr>
            <td class="subtitle"><label for="img">サムネ画像：</label></td>
            <td class="content">
                <input type="file" name="img" id="img" onchange="prevImg()" accept="image/*">
                <img id="preview">
            </td>
        </tr>
    </table>
    <label class="label"><input type="checkbox" name="check" id="check">共有ファイルにする</label>
    <div class="button_wrap">
        <div class="button prev" onclick="prev()">戻る</div>
        <div class="button next" onclick="send()">登録</div>
    </div>
</form>

<script src="/php2/final/src/js/fileUpload.js"></script>

<?php include './includes/footer.php'; ?>
<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/imgUpdate.css">

<?php include './includes/header_under.php'; ?>

<p class="title">アイコン画像変更</p>
<form action="/php2/final/src/imgUpdate_comp" method="post" name="imgUpdateForm" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td class="content">
                <img id="preview">
                <input type="file" name="upFile" id="file" onchange="prevImg()" accept="image/*" class="input">
            </td>
        </tr>
    </table>
    <div class="button_wrap">
        <div class="button prev" onclick="prev()">戻る</div>
        <div class="button next" onclick="update()">更新</div>
    </div>
</form>

<script src="/php2/final/src/js/imgUpdate.js"></script>

<?php include './includes/footer.php'; ?>
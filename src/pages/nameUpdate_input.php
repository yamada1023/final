<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/nameUpdate.css">

<?php include './includes/header_under.php'; ?>

<p class="title">ユーザーネーム変更</p>
<form action="/php2/final/src/nameUpdate_comp" method="post" name="nameUpdateForm">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="name">ユーザーネーム：</label></td>
            <td class="content"><input type="text" name="name" class="input" id="name" placeholder="10文字以内"></td>
        </tr>
    </table>
    <div class="button_wrap">
        <div class="button prev" onclick="prev()">戻る</div>
        <div class="button next" onclick="update()">更新</div>
    </div>
</form>

<script src="/php2/final/src/js/nameUpdate.js"></script>

<?php include './includes/footer.php'; ?>
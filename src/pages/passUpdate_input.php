<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/passUpdate.css">

<?php include './includes/header_under.php'; ?>

<p class="title">パスワード変更</p>
<form action="/php2/final/src/passUpdate_comp" method="post" name="passUpdateForm">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="pass">現在のパスワード：</label></td>
            <td class="content">
                <input type="password" name="nowPass" class="input" id="nowPass">
                <span class="far fa-eye" id="buttonEyeNow" onclick="HidePassNow()"></span>
            </td>
        </tr>
        <tr>
            <td class="subtitle"><label for="pass">パスワード：</label></td>
            <td class="content">
                <input type="password" name="pass" class="input" id="pass">
                <span class="far fa-eye" id="buttonEye" onclick="HidePass()"></span>
            </td>
        </tr>
    </table>
    <p id="passError" class="error"></p>
    <div class="button_wrap">
        <div class="button prev" onclick="prev()">戻る</div>
        <div class="button next" onclick="update()">更新</div>
    </div>
</form>

<script src="/php2/final/src/js/passUpdate.js"></script>

<?php include './includes/footer.php'; ?>
<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/join.css">

<?php include './includes/header_under.php'; ?>

<p class="title">新規登録</p>
<p class="info">※すべて必須項目です</p>
<form action="/php2/final/src/join_comp" method="post" name="joinForm" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="name">ユーザーネーム：</label></td>
            <td class="content"><input type="text" name="name" class="input" id="name" placeholder="10文字以内"></td>
        </tr>
        <tr>
            <td class="subtitle"><label for="pass">パスワード：</label></td>
            <td class="content">
                <input type="password" name="pass" class="input" id="pass" placeholder="半角英数字のみ">
                <span class="far fa-eye" id="buttonEye" onclick="HidePass()"></span>
            </td>
        </tr>
        <tr>
            <td class="subtitle"><label for="e_mail">メールアドレス：</label></td>
            <td class="content"><input type="email" name="email" class="input" id="e_mail"></td>
        </tr>
        <tr>
            <td class="subtitle"><label for="file">アイコン画像：</label></td>
            <td class="content">
                <input type="file" name="upFile" id="file" onchange="prevImg()" accept="image/*" class="input">
                <img id="preview">
            </td>
        </tr>
    </table>
    <p id="passError" class="error"></p>
    <p id="mailError" class="error"></p>
    <div class="submit" onclick="send()">登録</div>
</form>

<script src="/php2/final/src/js/join.js"></script>

<?php include './includes/footer.php'; ?>
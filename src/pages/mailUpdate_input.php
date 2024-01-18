<?php
session_start();
include './includes/header_top.php';
?>

<link rel="stylesheet" href="/php2/final/src/css/mailUpdate.css">

<?php include './includes/header_under.php'; ?>

<p class="title">メールアドレス変更</p>
<form action="/php2/final/src/mailUpdate_comp" method="post" name="mailUpdateForm">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="e_mail">メールアドレス：</label></td>
            <td class="content"><input type="email" name="email" class="input" id="e_mail"></td>
        </tr>
    </table>
    <p id="mailError" class="error"></p>
    <div class="button_wrap">
        <div class="button prev" onclick="prev()">戻る</div>
        <div class="button next" onclick="update()">更新</div>
    </div>
</form>

<script src="/php2/final/src/js/mailUpdate.js"></script>

<?php include './includes/footer.php'; ?>
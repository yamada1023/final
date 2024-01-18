<?php
session_start();
if (isset($_SESSION['user']) || isset($_COOKIE['token'])) {
    header('Location:/php2/final/src/myPage');
    exit;
}
?>

<?php include './includes/header_top.php'; ?>

<link rel="stylesheet" href="/php2/final/src/css/login.css">

<?php include './includes/header_under.php'; ?>

<p class="title">ログイン</p>
<form action="/php2/final/src/login_comp" method="post" name="loginForm">
    <table class="table">
        <tr>
            <td class="subtitle"><label for="e_mail">メールアドレス：</label></td>
            <td><input type="email" name="e_mail" class="input" id="e_mail"></td>
        </tr>
        <tr>
            <td class="subtitle"><label for="pass">パスワード：</label></td>
            <td>
                <input type="password" name="pass" class="input" id="pass">
                <span class="far fa-eye" id="buttonEye" onclick="HidePass()"></span>
            </td>
        </tr>
    </table>
    <label class="label"><input type="checkbox" name="check" id="check">ログイン状態を維持する</label>
    <div class="submit" onclick="send()">ログイン</div>
    <p class="info">アカウントがない方は<a href="/php2/final/src/join">こちら</a></p>
</form>

<script src="/php2/final/src/js/login.js"></script>

<?php include './includes/footer.php'; ?>
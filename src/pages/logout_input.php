<?php session_start(); ?>

<?php include './includes/header_top.php'; ?>

<link rel="stylesheet" href="/php2/final/src/css/logout.css">

<?php include './includes/header_under.php'; ?>

<?php
if (empty($_SESSION['user'])) {
    echo '<p class="info">すでにログアウトしています</p>';
} else {
    echo '
        <p class="info">ログアウトしますか？</p>
        <a href="/php2/final/src/logout_comp" class="infoA">ログアウト</a>
    ';
}
?>

<?php include './includes/footer.php'; ?>
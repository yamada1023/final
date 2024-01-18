<?php
$path = explode("/", $_SERVER["PATH_INFO"]);
switch ($path[1]) {
    case "login":
        include "pages/login_input.php";
        break;
    case "login_comp":
        include "pages/login_output.php";
        break;
    case "join":
        include "pages/join_input.php";
        break;
    case "join_comp":
        include "pages/join_output.php";
        break;
    case "myPage":
        include "pages/myPage.php";
        break;
    case "logout":
        include "pages/logout_input.php";
        break;
    case "logout_comp":
        include "pages/logout_output.php";
        break;
    case "delete":
        include "pages/deleteUser.php";
        break;
    case "imgUpdate":
        include "pages/imgUpdate_input.php";
        break;
    case "imgUpdate_comp":
        include "pages/imgUpdate_output.php";
        break;
    case "passUpdate":
        include "pages/passUpdate_input.php";
        break;
    case "passUpdate_comp":
        include "pages/passUpdate_output.php";
        break;
    case "nameUpdate":
        include "pages/nameUpdate_input.php";
        break;
    case "nameUpdate_comp":
        include "pages/nameUpdate_output.php";
        break;
    case "mailUpdate":
        include "pages/mailUpdate_input.php";
        break;
    case "mailUpdate_comp":
        include "pages/mailUpdate_output.php";
        break;
    case "allFile":
        include "pages/allFile.php";
        break;
    case "fileUpload":
        include "pages/fileUpload_input.php";
        break;
    case "fileUpload_comp":
        include "pages/fileUpload_output.php";
        break;
    case "fileUpdate":
        include "pages/fileUpdate_input.php";
        break;
    case "fileUpdate_comp":
        include "pages/fileUpdate_output.php";
        break;
    case "fileDelete":
        include "pages/fileDelete.php";
        break;
    case "sharePage":
        include "pages/sharePage.php";
        break;
}

function uploadFile() {
    location.href = "/php2/final/src/fileUpload";
}

function updateFile(el) {
    location.href = "/php2/final/src/fileUpdate?id=" + el;
}

function deleteFile(el) {
    var flg = confirm("本当に削除しますか？");

    if (flg) {
        location.href = "/php2/final/src/fileDelete?id=" + el;
    }
}
function prev() {
    location.href = "/php2/final/src/allFile";
}

function send() {
    var input = document.getElementsByClassName("input");
    var inputFlg = false;
    var flg = false;

    for (i = 0; i < input.length; i++) {
        if (input[i].value.length == 0) {
            inputFlg = true;
        }
    }

    if (inputFlg) {
        alert("未入力の項目があります");
    } else {
        flg = confirm("現在の内容で登録します。\nよろしいですか？");
    }

    if (flg) {
        document.fileUpdateForm.submit();
    }
}
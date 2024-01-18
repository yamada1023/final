function prevImg() {
    var preview = document.getElementById("preview");
    var file = document.querySelector("input[type=file]").files[0];
    var reader = new FileReader();
    reader.addEventListener(
        "load",
        () => {
            // 画像ファイルを base64 文字列に変換します
            preview.src = reader.result;
        },
        false,
    );

    if (file) {
        reader.readAsDataURL(file);
    }
}

function update() {
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
        flg = confirm("現在の内容で更新します。\nよろしいですか？");
    }

    if (flg) {
        document.imgUpdateForm.submit();
    }
}

function prev() {
    location.href = "/php2/final/src/myPage";
}
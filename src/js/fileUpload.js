function prevImg() {
    var preview = document.getElementById("preview");
    var file = document.getElementById("img").files[0];
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
        document.fileUploadForm.submit();
    }
}

function prev() {
    location.href = "/php2/final/src/allFile";
}

function checkFileType() {
    var fileInput = document.getElementById('file');
    var resultDiv = document.getElementById('extension');

    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const fileType = file.type;

        if (fileType.startsWith('video/')) {
            resultDiv.value = 'video';
        } else if (fileType.startsWith('audio/')) {
            resultDiv.value = 'audio';
        } else if (fileType.startsWith('image/')) {
            resultDiv.value = 'img';
        }
    }
}
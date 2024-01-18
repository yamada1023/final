var userName = document.getElementById("name");

userName.addEventListener('input', function () {
    var input = this.value;

    if (input.length > 10) {
        input = input.slice(0, 10);
    }

    this.value = input;
});

var pass = document.getElementById("pass");
var passError1 = document.getElementById("passError");

pass.addEventListener('blur', function () {
    var password = this.value;
    var regex = /^[0-9a-zA-Z]*$/;

    if (regex.test(password) || this.length == 0) {
        passError1.innerText = "";
    } else {
        passError1.innerText = "不正なパスワードです。";
    }
});

var mail = document.getElementById("e_mail");
var mailError = document.getElementById("mailError");

mail.addEventListener('blur', function () {
    var email = mail.value;
    var regex = /^[a-zA-Z0-9_+-]+(\.[a-zA-Z0-9_+-]+)*@([a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]*\.)+[a-zA-Z]{2,}$/;

    if (regex.test(email) || this.value.length == 0) {
        mailError.innerText = "";
    } else {
        mailError.innerText = "無効なメールアドレスです。";
    }
});

function send() {
    var input = document.getElementsByClassName("input");
    var error = document.getElementsByClassName("error");
    var errorFlg = false;
    var inputFlg = false;
    var flg = false;

    for (i = 0; i < input.length; i++) {
        if (input[i].value.length == 0) {
            inputFlg = true;
        }
    }

    for (i = 0; i < error.length; i++) {
        if (error[i].innerText.length != 0) {
            errorFlg = true;
        }
    }

    if (inputFlg) {
        alert("未入力の項目があります");
    } else if (errorFlg) {
        alert("不正な項目があります");
    } else {
        flg = confirm("現在の内容で登録します。\nよろしいですか？");
    }

    if (flg) {
        document.joinForm.submit();
    }
}

function HidePass() {
    var pass = document.getElementById("pass");
    var eye = document.getElementById("buttonEye");

    if (pass.type === "text") {
        pass.type = "password";
        eye.className = "far fa-eye";
    } else {
        pass.type = "text";
        eye.className = "far fa-eye-slash";
    }
}

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

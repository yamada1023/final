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

function HidePassNow() {
    var pass = document.getElementById("nowPass");
    var eye = document.getElementById("buttonEyeNow");

    if (pass.type === "text") {
        pass.type = "password";
        eye.className = "far fa-eye";
    } else {
        pass.type = "text";
        eye.className = "far fa-eye-slash";
    }
}

function update() {
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
        document.passUpdateForm.submit();
    }
}

function prev() {
    location.href = "/php2/final/src/myPage";
}
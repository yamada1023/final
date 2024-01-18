var userName = document.getElementById("name");

userName.addEventListener('input', function () {
    var input = this.value;

    if (input.length > 10) {
        input = input.slice(0, 10);
    }

    this.value = input;
});

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
        document.nameUpdateForm.submit();
    }
}

function prev() {
    location.href = "/php2/final/src/myPage";
}
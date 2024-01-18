function withdrawal() {
    var flg = confirm("本当に削除しますか？");

    if (flg) {
        location.href = "/php2/final/src/delete";
    }
}

function update() {
    location.href = "/php2/final/src/profUpdate";
}

function passChange() {
    location.href = "/php2/final/src/passUpdate";
}

function imgUpdate() {
    location.href = "/php2/final/src/imgUpdate";
}

function nameUpdate() {
    location.href = "/php2/final/src/nameUpdate";
}

function mailUpdate() {
    location.href = "/php2/final/src/mailUpdate";
}

function share(el) {
    navigator.clipboard.writeText("https://aso2201030.verse.jp/php2/final/src/sharePage?id=" + el).then(
        () => {
            alert("共有用URLをコピーしました！");
        },
        () => {
            alert("コピーに失敗しました…");
        },
    );

}
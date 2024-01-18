</head>

<body>
    <div class='fixed-top'>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">MemLook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php
                    if (isset($_SESSION['user']) || isset($_COOKIE['token'])) {
                        echo '<a class="nav-link" aria-current="page" href="/php2/final/src/logout">ログアウト</a>';
                        echo '<a class="nav-link" aria-current="page" href="/php2/final/src/myPage">マイページ</a>';
                        echo '<a class="nav-link" aria-current="page" href="/php2/final/src/allFile">ファイル一覧</a>';
                        echo '<a class="nav-link" aria-current="page" href="/php2/final/src/fileUpload">ファイル登録</a>';
                    } else {
                        echo '<a class="nav-link" aria-current="page" href="/php2/final/src/login">ログイン</a>';
                    }
                    ?>
                </div>
            </div>
    </div>
    </nav>
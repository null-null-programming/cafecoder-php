<nav class="navbar navbar-expand-sm navbar-dark " style="background-color:#a0522d;">
    <?php
    echo '<a href="/" class="navbar-brand">CafeCoder</a>';
    ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navmenu1">
        <div class="navbar-nav">
            <?php
            echo '<a class="nav-item nav-link" href="/">ホーム</a>';
            echo '<a class="nav-item nav-link" href="/Contest.php">コンテスト一覧</a>';
            ?>
        </div>
    </div>
    <div class="navbar-nav" class="username">
        <span class="nav-item">
            <?php
            if ($_SESSION["username"] != "") {
                echo '<a style="background-color:white">'.$_SESSION["username"] . '</a>';
                echo '<a href="/signout.php">サインアウト</a>';
            } else {
                echo '<a href="/signin.php">サインイン</a>';
            }
            ?>
        </span>
    </div>
</nav>
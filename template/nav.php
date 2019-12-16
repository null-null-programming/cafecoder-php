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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

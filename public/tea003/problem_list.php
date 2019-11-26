<!doctype html>
<html lang="ja">
<head>
<?php include_once "../../template/head.php"; ?>
</head>
<body>
<?php include_once "../../template/nav.php"; ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>




    <!--メインコン�?ン�?-->
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1" aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <?php
                            echo '<a class="nav-item nav-link" href="/tea003/">コンテストTOP</a>';
                            echo '<a class="nav-item nav-link" href="/tea003/problem_list.php">問題一覧</a>';
                            echo '<a class="nav-item nav-link" href="/ranking.php?contest_id=3">ランキング</a>';
                            echo '<a class="nav-item nav-link" href="/my_submit.php?contest_id=3">自分の提出</a>';
                            echo '<a class="nav-item nav-link" href="/all_submit.php?contest_id=3">みんなの提出</a>';
                            ?>
                        </div>
                    </div>
                </nav>
                <br>
                <?php 
                include_once("../../util/util.php"); 
                block_out_of_contest();
                ?>

                <table class="table">
                    <thead>
                        <tr>
                            <th>難易度</th>
                            <th scope="col">
                                問題名
                            </th>
                            <th>
                                実行制限時間
                            </th>
                            <th>
                                writer
                            </th>
                    </thead>
                    <tbody>
                        

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
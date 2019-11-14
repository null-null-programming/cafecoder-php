<?php

<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script type="text/x-mathjax-config">
MathJax.Hub.Config({ tex2jax: { inlineMath: [['$','$'], ["\\(","\\)"]] } });
</script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.5/latest.js?config=TeX-MML-AM_CHTML&locale=ja">
        </script>

    <title>A - Semiprime-like</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-3 mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4"
            aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="https://www.kakecoder.com/">KakeCoder</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="https://www.kakecoder.com/">ホーム</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.kakecoder.com/Contest.html">コンテスト</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>




    <!--メインコン�?ン�?-->
    <div class="container">
        <div class="card" style="width: auto">
            <div class="card-body">
                <nav class="navbar navbar-expand-sm navbar-light bg-light mt-3 mb-3">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav4"
                        aria-controls="navbarNav4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link"
                                    href="https://www.kakecoder.com/Contests/kgtc008/index.html">コンテストTOP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://www.kakecoder.com/Contests/kgtc008/problems.html">問題一覧</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="https://www.kakecoder.com/Contests/kgtc008/submit.html">提出する</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.kakecoder.com/Contests/kgtc008/ranking.html">順位</a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <h3>A - Semiprime-like　【配点：100 点】</h3>
                <hr>
                <h4><strong>問題文</strong></h4>
                <p>
                    自然数$N$が与えられます。<br>
                    $N$が以下の条件を満たすかどうか判定してください。<br>
                    <h5>条件</h5>
                </p>
                <ul>
                    <li>$N = a \times b$を満たす$2$以上の自然数$a, b$が存在する。</li>
                </ul>
                <br>
                <h4><strong>制約</strong></h4>
                $1$ &le; $N$ &le; $100$
                <h4><strong>入力</strong></h4>
                <span style="background-color:#c7c7c7">
                    N
                </span>

                <br>
                <h4><strong>出力</strong></h4>
                条件を満たすなら"Yes"、満たさないなら"No"と出力してください。(ダブルクオーテーションは不要)<br>
                改行を忘れずに。
                <br>
                <br>
                <h4><strong>入力例1</strong></h4>
                <span style="background-color:#c7c7c7">
                    4
                </span>
                <br>
                <h4><strong>出力例1</strong></h4>
                <span style="background-color:#c7c7c7">
                    Yes<br>
                </span>
                <p>$4 = 2 \times 2$です。</p>

                <br>
                <h4><strong>入力例2</strong></h4>
                <span style="background-color:#c7c7c7">
                    5
                </span>
                <br>
                <h4><strong>出力例2</strong></h4>
                <span style="background-color:#c7c7c7">
                    No<br>
                </span>
                <p>条件を満たす$a, b$はありません。</p>

                <br>
                <h4><strong>入力例3</strong></h4>
                <span style="background-color:#c7c7c7">
                    12
                </span>
                <br>
                <h4><strong>出力例3</strong></h4>
                <span style="background-color:#c7c7c7">
                    Yes<br>
                </span>
                <p>$(a, b) = (2, 6), (3, 4), (4, 3), (6, 2)$が条件を満たします。</p>



            </div>
        </div>
    </div>
</body>

</html>
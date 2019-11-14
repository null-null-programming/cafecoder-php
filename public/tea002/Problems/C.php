<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144747694-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-144747694-2');
    </script>

    <title>Earlgray - 最小全域木？なにそれおいしいの？</title>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a href="https://www.kakecoder.com/" class="navbar-brand">KakeCoder</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1"
            aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu1">
            <div class="navbar-nav">
                <a class="nav-item nav-link" href="https://www.kakecoder.com/">ホーム</a>
                <a class="nav-item nav-link" href="https://www.kakecoder.com/Contest.html">コンテスト一覧</a>
            </div>
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
                <nav class="navbar navbar-expand-sm navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu1"
                        aria-controls="navmenu1" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navmenu1">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea002">コンテストTOP</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/problem_list.html">問題一覧</a>
                            <a class="nav-item nav-link" href="https://www.kakecoder.com/tea002/ranking.html">ランキング</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/my_submit.html">自分の提出</a>
                            <a class="nav-item nav-link"
                                href="https://www.kakecoder.com/tea002/all_submit.html">みんなの提出</a>
                        </div>
                    </div>
                </nav>
                <br>
                <h3>Earlgray - 最小全域木？なにそれおいしいの？　【配点：300 点】</h3>


                <hr>
                <h4><strong>問題文</strong></h4>
                <var>N</var>個の街を相互に行き来可能とするように街道を作りたいです。<br>
                具体的には、各街からいくつかの街と街道を通って、すべての街へ行けるようにしたいです。<br>
                今、街を<var>1,2,...,N</var>として、<var>2</var>つの街<var>(i,j)</var>同士をつなぐ街道に対するコスト<var>C<sub>i,j</sub></var>が以下のように推定されています。<br>
                <center><var>C<sub>i,j</sub></var> = <var>i+j</var> <var>( i&ne;j , 1≦i,j≦N )</var></center><br>
                この時、<var>N-1</var>個の街道を建設して、<var>N</var>個の街が相互に行き来可能となるようにするために必要なコストの最小値を求めなさい。<br>

                <details>
                    <summary>余談</summary>
                    N個以上の街道を建設すると最小のコストにはならないことは示せます。<br>
                    このような問題は一般に最小全域木と呼ばれ、AtCoderでは500点以上の問題に出題されることが多いです。<br>
                    ただし、この問題を解くには最小全域木のアルゴリズムは必要なく、想定解の1つはО(1)です。<br>
                    もちろん、最小全域木のアルゴリズムを用いても解くことが出来ます。<br>
                </details>
                <details>
                    <summary>ヒント</summary>
                    ・N=3,N=5の時のサンプルの図を見て、どの街道を選べば最小のコストになるかを考えてみる。<br>
                    ・NとN+1の答えに法則性があるかを考えてみる。<br>
                    ・最小コストになる街道の繋げ方には決まりがある？<br>
                    といったことを考えてみましょう。以下のようにしても良いですが、UnionFind等の知識が必要になり、難易度は高いです。<br>
                    ・最小全域木のアルゴリズムを調べて貼る。(上級者向け)<br>
                </details>
                <br>
                <h4><strong>制約</strong></h4>
                ・3≦<var>N</var>≦10<sup>3</sup><br>

                <br>
                <h4><strong>入力</strong></h4>
                <span style="background-color:#c7c7c7">
                    <var>N</var><br>
                </span>

                <br>
                <h4><strong>出力</strong></h4>
                コストが最小となるように街道を作った際に必要なコストを出力せよ。<br>

                <br>
                <h4><strong>入力例1</strong></h4>
                <span style="background-color:#c7c7c7">
                    3<br>
                </span>

                <br>
                <h4><strong>出力例1</strong></h4>
                <span style="background-color:#c7c7c7">
                    7<br>
                </span>
                <br>
                街1,2をつなぐ街道と街3,1をつなぐ街道を作ることで、全ての街は街道を通って相互に行き来可能となります。<br>
                また、これよりコストの総和が少なくなる街道の選び方はありません。<br>
                <img src="graph_B_sample1.png" width="40%"><br>

                <br>
                <h4><strong>入力例2</strong></h4>
                <span style="background-color:#c7c7c7">
                    5<br>
                </span>

                <br>
                <h4><strong>出力例2</strong></h4>
                <span style="background-color:#c7c7c7">
                    18<br>
                </span>
                <br>
                <img src="graph_B_sample2.png" width="40%"><br>



                <h4><strong>入力例3</strong></h4>
                <span style="background-color:#c7c7c7">
                    99<br>
                </span>

                <br>
                <h4><strong>出力例3</strong></h4>
                <span style="background-color:#c7c7c7">
                    5047<br>
                </span>
                <br>

                <hr>

                <h4><strong>提出する</strong></h4><br>
                <form action="https://www.kakecoder.com/submit.php" method="POST" name="submit_form">

                    <label>問題：</label>
                    <select name="problem">
                        
                        <option value="C">Darjeeling - 最小全域木？なにそれおいしいの？</option>
                        
                    </select>
                    <br><br>

                    <label>言語：</label>
                    <select name="language">
                        <option value="0">C(C11)</option>
                        <option value="1">C++(C++17)</option>
                        <option value="2">Java8(OpenJDK1.8.0)</option>
                        <option value="3">Python3(ver3.6.8)</option>
                    </select>

                    <br><br>
                    <label>ソースコード：</label>
                    <br>
                    <textarea cols="60" name="sourcecode" rows="20"></textarea>

                    <br>
                    <input type="submit" value="送信" class="btn" onclick="return checkform();">
                    <div>
                        <script>
                            function checkform() {
                                if (document.submit_form.userid.value == "" || document.submit_form.contestid.value == "" || document.submit_form.sourcecode.value == "") {
                                    alert("ユーザIDもしくはソースコードが入力されていません。");
                                    return false;
                                } else {
                                    //location.href='WaitForJudgging.php';
                                    return true;
                                }
                            }
                        </script>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<br />
<div class="container">
    <div class="card" style="width:auto">
        <div class="card-body">
            <form action="../../change.php" method="POST">
                <p>ユーザーページ(仮)</p>
                <p2>ユーザーネーム</p2>
                <p class="username"><input type="text" name="username" maxlength="32" autocomplete="OFF" value="<?=$_SESSION["username"]?>"/></p>
                <p2>パスワード</p2>
                <p class="password"><input type="password" name="password" maxlength="32" autocomplete="OFF" value=""/></p>
                <p>ユーザー情報の変更の対応は少々お待ち下さい。</p><br>
                <a href="https://www.kakecoder.com/signout.php">サインアウトする</a>
                <!--<p class="submit"><input type="submit" value="change.php" /></p>-->
                
            </form>
        </div>
    </div>
</div>
<br />
-

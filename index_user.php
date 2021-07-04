<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>User登録</title>
  <link href="css/index_kadai.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class=index_header>
  <nav class="navbar_navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="menu.php">■トップページ</a></div>
    <div class="navbar-header"><a class="navbar-brand" href="select_user.php">■User一覧画面の表示</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert_user.php">
  <div class="jumbotron">
   <fieldset>
    <legend>User登録</legend>
     <label>名前     ：<input type="text" name="name"></label><br>
     <label>Login-ID       ：<input type="text" name="lid"></label><br>
     <label>Login-PW：<input type="text" name="lpw"></label><br>
     <label>管理者     ：<select name="kanri_flg">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        </select>
     </label><br>
     <label>退勤管理    ：<select name="life_flg">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        </select>
     </label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

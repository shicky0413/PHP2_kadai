<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>案件登録</title>
  <link href="css/index_kadai.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header class=index_header>
  <nav class="navbar_navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select_kadai.php">案件パイプラインの表示</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert_kadai.php">
  <div class="jumbotron">
   <fieldset>
    <legend>案件登録</legend>
     <label>物件名     ：<input type="text" name="realestate_name"></label><br>
     <label>価格       ：<input type="text" name="price"></label><br>
     <label>専有面積：<input type="text" name="space"></label><br>
     <label>間取り     ：<input type="text" name="room_type"></label><br>
     <label>物件URL    ：<input type="text" name="realestate_url"></label><br>
     <label>メモ：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

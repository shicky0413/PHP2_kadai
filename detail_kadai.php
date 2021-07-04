<?php
session_start();
//selsect.phpから処理を持ってくる
//1.外部ファイル読み込みしてDB接続(funcs.phpを呼び出して)
require_once('funcs_kadai.php');

loginCheck();

$pdo = db_conn();


//2.対象のIDを取得
$id = $_GET["id"];
// echo $id;

//3．データ取得SQLを作成（SELECT文）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");//ここの書き方で取れるデータ、表示データが変わる。
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
  //   //execute（SQL実行時にエラーがある場合）
  // $error = $stmt->errorInfo();
  // exit("ErrorQuery:".$error[2]);
  sql_error($status);
}else{
  $result = $stmt->fetch();
}



?>

<!-- 以下はindex_kadai.phpのHTMLをまるっと持ってくる -->
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
<form method="POST" action="update_kadai.php">
  <div class="jumbotron">
   <fieldset>
    <legend>案件登録</legend>
     <label>物件名     ：<input type="text" name="realestate_name" value="<?= $result['realestate_name']?>"></label><br>
     <label>価格       ：<input type="text" name="price" value="<?= $result['price']?>"></label><br>
     <label>専有面積：<input type="text" name="space" value="<?= $result['space']?>"></label><br>
     <label>間取り     ：<input type="text" name="room_type" value="<?= $result['room_type']?>"></label><br>
     <label>物件URL    ：<input type="text" name="realestate_url" value="<?= $result['realestate_url']?>"></label><br>
     <label>メモ：<textArea name="comment" rows="4" cols="40"><?= $result['comment']?></textArea></label><br>
     <!-- ユーザーに見えないインプット -->
     <input type="hidden" name="id" value="<?= $result['id']?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

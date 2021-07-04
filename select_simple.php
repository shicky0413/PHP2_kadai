<?php
//funcs.phpを読み込む
require_once('funcs_kadai.php');
//1.  DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = 
        // new PDO('mysql:dbname=brownturtle3_22_nishimura;charset=utf8;host=mysql57.brownturtle3.sakura.ne.jp','brownturtle3','05kawahara_22nishimura');
        new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");//ここの書き方で取れるデータ、表示データが変わる。

//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
  //   //execute（SQL実行時にエラーがある場合）
  // $error = $stmt->errorInfo();
  // exit("ErrorQuery:".$error[2]);
  sql_error($status);
}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<a href="detail_kadai.php?id=' . $result['id'] . '">';
    $view .= "<p class=indate>";
    $view .= h($result['indate']);
    // $view .= h($result['indate']).':'.h($result['realestate_name']).':'.h($result['price']).':'.h($result['space']).':'.h($result['room_type']).':'.h($result['comment']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=realestate_name>";
    $view .= h($result['realestate_name']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=price>";
    $view .= h($result['price']);
    $view .= "万円</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=space>";
    $view .= h($result['space']);
    $view .= "㎡</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=unit_price>";
    $view .= h($result['unit_price']);
    $view .= "万円/㎡</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=room_type>";
    $view .= h($result['room_type']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=comment>";
    $view .= h($result['comment']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= '</a>';
    $view .= '<a href="delete_kadai.php?id='.$result["id"].'">';
    $view .= ' [ 削除 ]';
    $view .= '</a>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<div id="your_container">
<title>案件パイプラインリスト</title>
<link rel="stylesheet" href="css/range.css">
<!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
<link href="css/kadai.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px; border: 1px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index_simple.php">■案件登録画面の表示</a>
      <br>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  パイプラインリスト
    <div class="container_jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->
</div>
</body>
</html>

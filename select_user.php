<?php
session_start();

//funcs.phpを読み込む
require_once('funcs_kadai.php');

loginCheck('funcs_user.php');//user?
$user_name = $_SESSION['name'];
//以下ログインユーザーのみ

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
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");//ここの書き方で取れるデータ、表示データが変わる。

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
    $view .= '<a href="detail_user.php?id=' . $result['id'] . '">';
    $view .= "<p class=indate>";
    $view .= h($result['indate']);
    // $view .= h($result['indate']).':'.h($result['realestate_name']).':'.h($result['price']).':'.h($result['space']).':'.h($result['room_type']).':'.h($result['comment']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=name>";
    $view .= h($result['name']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=lid>";
    $view .= h($result['lid']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=lpw>";
    $view .= h($result['lpw']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=kanri_flg>";
    $view .= h($result['kanri_flg']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= "<p class=life_flg>";
    $view .= h($result['life_flg']);
    $view .= "</p>";//.=で変数を上書きではなく足していくことができる
    $view .= '</a>';
    $view .= '<a href="delete_user.php?id='.$result["id"].'">';
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
<title>■User一覧画面</title>
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

      <div class="navbar-header"><a class="navbar-brand" href="menu.php">■トップページ</a></div>
      <a class="navbar-brand" href="index_user.php">■User登録画面の表示</a>
      <p class="navbar-brand"><?= $user_name ?></p>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
  User一覧
    <div class="container_jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->
</div>
</body>
</html>

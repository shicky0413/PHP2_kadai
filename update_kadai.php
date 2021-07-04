<?php
//insert.phpの処理を持ってくる
//1. POSTデータ取得
$realestate_name = $_POST["realestate_name"];
$price = $_POST["price"];
$space = $_POST["space"];
$unit_price = $_POST["price"]/$_POST["space"];
$room_type = $_POST["room_type"];
$realestate_url = $_POST["realestate_url"];
$comment = $_POST["comment"];
$id = $_POST["id"];

//2. DB接続します
require_once('funcs_kadai.php');
$pdo = db_conn();

//３．データ更新SQL作成（UPDATE テーブル名 SET 更新対象1=:更新データ ,更新対象2=:更新データ2,... WHERE id = 対象ID;）
$stmt = $pdo->prepare(
   "UPDATE gs_bm_table SET realestate_name = :realestate_name, price = :price, space = :space, unit_price = :unit_price, room_type = :room_type, realestate_url = :realestate_url, comment = :comment, indate = sysdate() 
   WHERE id = :id;"
  );
  
  // 4. バインド変数を用意
  $stmt->bindValue(':realestate_name', $realestate_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':price', $price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':space', $space, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':unit_price', $unit_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':room_type', $room_type, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':realestate_url', $realestate_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  
  // 5. 実行
  $status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    sql_erro($stmt);
  
  }else{
    //select_kadai.phpへリダイレクト
    redirect('select_kadai.php');
  }

<?php
// 1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$realestate_name = $_POST["realestate_name"];
$price = $_POST["price"];
$space = $_POST["space"];
$unit_price = $_POST["price"]/$_POST["space"];
$room_type = $_POST["room_type"];
$realestate_url = $_POST["realestate_url"];
$comment = $_POST["comment"];
//平文で受け取る
// $password = $_POST['pw'];
//ハッシュ化
// $pw = Password_hash($passwprd);

// 2. DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','root');//pdoでmysqlに接続してくれる
// } catch (PDOException $e) {
//   exit('DBConnectError:'.$e->getMessage());
// }
//関数を呼び出す.
require_once('funcs_kadai.php');
$pdo = db_conn();//db_connの関数を呼び出す。つまりDbへ接続。スリム化成功。

// ３．SQL文を用意(データ登録：INSERT)
$stmt = $pdo->prepare(
  "INSERT INTO  gs_bm_table( id, realestate_name, price, space,  unit_price, room_type, realestate_url, comment, pw, indate )
  VALUES( NULL, :realestate_name, :price , :space, :unit_price, :room_type, :realestate_url, :comment, :pw, sysdate())"
);

// 4. バインド変数を用意
$stmt->bindValue(':realestate_name', $realestate_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':price', $price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':space', $space, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':unit_price', $unit_price, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':room_type', $room_type, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':realestate_url', $realestate_url, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

// 5. 実行
$status = $stmt->execute();

// 6．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_erro($stmt);

}else{
  //５．index.phpへリダイレクト
  redirect('index_kadai.php');
}
?>

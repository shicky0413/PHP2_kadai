<?php
session_start();

require_once('funcs_kadai.php');

loginCheck();

//selsect.phpから処理を持ってくる
//1.対象のIDを取得
$id = $_GET["id"];

//2.DB接続します

$pdo = db_conn();

//3.削除SQLを作成
$stmt = $pdo->prepare("DELETE FROM gs_bm_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('select_kadai.php');
}
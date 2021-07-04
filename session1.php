<?php
// SESSIONスタート
session_start();


// SESSIONのidを取得
$sid = session_id();

//Session変数にデータ登録
$_SESSION['name'] = '西村';
$_SESSION['price'] = '5600';

echo $sid;//IDを確認個々人のブラウザによるものCOOKIEのようなもの、



?>
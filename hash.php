<?php

//パスワードをハッシュ化（暗号化）する処理
$pw = password_hash('test1',PASSWORD_DEFAULT);

echo $pw ;


?>
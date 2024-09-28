<?php
require 'db-mysql.php'; # データベースに接続する。
$db->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE"); # トランザクション分離レベルをシリアライザブルに設定
require 'order-safe.php'; # 注文処理を行う。

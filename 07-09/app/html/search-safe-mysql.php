<?php
require 'db-mysql.php'; # データベースに接続する。
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); # プリペアドステートメントのエミュレーションを無効にする．
require 'search-safe.php'; # 検索処理を行う。

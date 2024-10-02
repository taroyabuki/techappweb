<?php
$params = session_get_cookie_params();
$params['secure'] = true; // HTTPSでのみ送信される（localhostは例外）。
//$params['samesite'] = 'Strict'; //aでも送信されない。
//$params['samesite'] = 'Lax';    //imgやiframeでは送信されない。
$params['samesite'] = 'None';     //別ドメインにも送信される。
session_set_cookie_params($params);
session_start();

if (isset($_GET['username'])) {
  session_regenerate_id(true); // セッションを作り直す。
  $_SESSION['username'] = $_GET['username'];
}

if (isset($_SESSION['username'])) {
  echo "Hello, {$_SESSION['username']}.\n";
}

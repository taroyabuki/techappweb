<?php
session_start();

if (isset($_GET['username'])) {
  session_destroy();
  $params = session_get_cookie_params();
  $params['secure'] = true; // HTTPSでのみ送信される。
  //$params['samesite'] = 'Strict'; //aでも送信されない。
  //$params['samesite'] = 'Lax';    //imgやiframeでは送信されない。
  $params['samesite'] = 'None';     //別ドメインにも送信される。
  //$params['httponly'] = true; // JavaScriptからのアクセスを禁止する。
  session_set_cookie_params($params);
  session_start();
  session_regenerate_id(true);
  
  $_SESSION['username'] = $_GET['username'];
}

if (isset($_SESSION['username'])) {
  echo "Hello, {$_SESSION['username']}.\n";
}

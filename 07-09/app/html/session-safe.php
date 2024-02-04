<?php
session_start();

if (isset($_GET['name'])) {
  session_destroy();
  $params = session_get_cookie_params();
  $params['secure'] = true;
  //$params['samesite'] = 'Strict';//aでも送信されない。
  $params['samesite'] = 'Lax';//imgやiframeでは送信されない。
  //$params['samesite'] = 'None';//別ドメインにも送信される。
  $params['httponly'] = true;
  session_set_cookie_params($params);
  session_start();
  session_regenerate_id(true);
  $_SESSION['name'] = $_GET['name'];
}

if (isset($_SESSION['name'])) {
  echo "Hello, {$_SESSION['name']}.\n";
}

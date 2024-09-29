<?php
session_start();

if (isset($_GET['username'])) {
  session_destroy();
  $params = session_get_cookie_params();
  $params['secure'] = true;
  $params['samesite'] = 'None';
  session_set_cookie_params($params);
  session_start();
  session_regenerate_id(true);
  $_SESSION['username'] = $_GET['username'];
}

if (isset($_SESSION['username'])) {
  echo "Hello, {$_SESSION['username']}.\n";
}

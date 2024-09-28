<?php
$params = session_get_cookie_params();
$params['secure'] = true;
$params['samesite'] = 'None';
$params['httponly'] = true;
session_set_cookie_params($params);
session_start();

if (isset($_GET['username'])) {
  $_SESSION['username'] = $_GET['username'];
}

if (isset($_SESSION['username'])) {
  echo "Hello, {$_SESSION['username']}.\n";
}

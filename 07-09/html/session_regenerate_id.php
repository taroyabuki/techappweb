<?php
session_start();

if (isset($_GET['username'])) {
  session_regenerate_id(true); // セッションを作り直す。
  $_SESSION['username'] = $_GET['username'];
}

if (isset($_SESSION['username'])) {
  $safe_name = htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8');
  echo "Hello, {$safe_name}.\n";
}

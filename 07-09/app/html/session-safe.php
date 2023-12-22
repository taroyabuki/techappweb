<?php
session_start();

if (isset($_GET['name'])) {
  session_destroy();
  session_start();
  session_regenerate_id(true);
  $_SESSION['name'] = $_GET['name'];
}

if (isset($_SESSION['name'])) {
  echo "Hello, {$_SESSION['name']}.\n";
}

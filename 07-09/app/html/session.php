<?php
session_start();

if (isset($_GET['name'])) {
  $_SESSION['name'] = $_GET['name'];
}

if (isset($_SESSION['name'])) {
  echo "Hello, {$_SESSION['name']}.\n";
}

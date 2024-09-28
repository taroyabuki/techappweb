<?php
$params = session_get_cookie_params();
$params['secure'] = true;
$params['samesite'] = 'None';
$params['httponly'] = true;
session_set_cookie_params($params);
session_start();

$_SESSION['username'] = $_SESSION['username'].'*';

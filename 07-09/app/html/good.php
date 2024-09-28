<?php
$params = session_get_cookie_params();
$params['samesite'] = 'None';
$params['secure'] = true;
session_set_cookie_params($params);
session_start();

error_log($_SESSION['username'] ?? 'Guest');

header('Content-Type: image/svg+xml');
echo '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg">
  <circle cx="50" cy="50" r="40" fill="black" />
</svg>';

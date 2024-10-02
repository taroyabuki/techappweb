<?php
$name = $_GET['username'] ?? 'Guest';
$safe_name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
echo "Hello, {$safe_name}.\n";

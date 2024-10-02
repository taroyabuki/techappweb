<?php
header("Content-Security-Policy: script-src 'self'");
echo "Hello, {$_GET['username']}.";

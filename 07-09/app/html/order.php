<?php
echo date("r");
$db = new SQLite3("/var/data/mydb.db");
$stock = $db->querySingle("SELECT stock FROM items WHERE id = 2");

if ($stock >= 1) {
  echo "\n<p>Current stock for item ID 2: {$stock}</p>\n";
  sleep(10); // 10秒待つ
  $newStock = $stock - 1;
  $db->exec("UPDATE items SET stock = $newStock WHERE id = 2");
  echo "<p>Order placed successfully! New stock: {$newStock}</p>\n";
} else {
  echo "<p>Not enough stock.</p>\n";
}

<?php
echo date("r");
$db = new SQLite3("/var/data/mydb.db");
$db->enableExceptions(true);
try {
  $db->exec("BEGIN");
  $stock = $db->querySingle("SELECT stock FROM items WHERE id = 2");
  if ($stock >= 1) {
    echo "\n<p>Current stock for item ID 2: {$stock}</p>\n";
    sleep(10); // 10秒
    $newStock = $stock - 1;
    $db->exec("UPDATE items SET stock = {$newStock} WHERE id = 2");
    $db->exec("COMMIT");
    echo "<p>Order placed successfully! New stock: $newStock</p>\n";
  } else {
    $db->exec("ROLLBACK");
    echo "<p>Not enough stock.</p>\n";
  }
} catch (Exception $e) {
  $db->exec("ROLLBACK");
  echo "<p>An error occurred: " . $e->getMessage() . "</p>\n";
}

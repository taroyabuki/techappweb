<?php
echo date("r");

try {
  $stmt = $db->prepare("SELECT stock FROM items WHERE id = 2"); # 在庫確認
  $stmt->execute();
  $stock = $stmt->fetchColumn();
  if ($stock >= 1) { # 在庫あり
    echo "\n<p>Current stock for item ID 2: {$stock}</p>\n";
    sleep(5);               # 5秒待つ。
    $newStock = $stock - 1; # 在庫を1減らし，データベースを更新する。
    $stmt = $db->prepare("UPDATE items SET stock = {$newStock} WHERE id = 2");
    $stmt->execute();
    echo "<p>Order placed successfully! New stock: {$newStock}</p>\n";
  } else { # 在庫なし
    echo "<p>Not enough stock.</p>\n";
  }
} catch (Exception $e) {
  echo "<p>An error occurred: " . $e->getMessage() . "</p>\n";
}

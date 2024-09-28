<?php
$foo = $_GET['search_name'];
$query = "SELECT * FROM items WHERE name LIKE '%{$foo}%'";
$stmt = $db->prepare($query);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
  echo '<table><tr><th>name</th><th>price</th></tr>';
  foreach ($results as $item) {
    echo '<tr>';
    echo "<td>{$item['name']}</td>";
    echo "<td>{$item['price']}</td>";
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo "Not found.";
}

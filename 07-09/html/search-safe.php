<?php
$foo = $_GET['search_name'];
$query = "SELECT * FROM items WHERE name LIKE :search_name";
$stmt = $db->prepare($query);
$stmt->bindValue(':search_name', "%{$foo}%", PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($results) {
  echo '<table><tr><th>name</th><th>price</th></tr>';
  foreach ($results as $item) {
    $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
    echo '<tr>';
    echo "<td>{$name}</td>";
    echo "<td>{$item['price']}</td>";
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo "Not found.";
}

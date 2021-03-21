<?php
include('sqlite.php');


if (empty($_GET['id'])) {
  echo 'Erreur';
  exit();
}

$name = $_GET['id'];

$stmt = $pdo->prepare('DELETE FROM main.scene WHERE name = :name');
$stmt->execute(['name' => $name]);


?>


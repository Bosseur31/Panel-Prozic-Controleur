<?php

include('sqlite.php');
include('url_api.php');

$id = $_GET['id'];

if (empty($id)) {
  echo 'empty';
  exit();
}

$stmt = $pdo->prepare('DELETE FROM main.commands WHERE id=:id');
$stmt->execute(array(
  'id' => $id,
));
$donnees = $stmt->fetch();

$target = $donnees['device'];
$name_command = $donnees['command'];

$url = "{$url_emetteur}/targets/{$target}/commands/{$name_command}";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);

$response = json_decode($response_json, true);

//todo : Tester le retour de donnée pour valider la fait que la commande est passé

curl_close($ch);

echo 'true';


<?php
include('sqlite.php');
include('url_api.php');


if (empty($_GET['id'])) {
  echo 'empty';
  exit();
}

$node_id = $_GET['id'];

// todo list : ajouter args a la requete API

$url = "{$url_zwave}/execute";
$data = array('type' => 'request', 'action' => 'zwave.remove_failed_node', 'args' => array('node_id' => $node_id), "target" => "localhost");
$data_json = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json = curl_exec($ch);

$response = json_decode($response_json, true);

if($errno = curl_errno($ch)) {
  $error_message = curl_strerror($errno);
  echo 'false';
  exit();
}
curl_close($ch);

$stmt = $pdo->prepare('DELETE FROM main.appareil WHERE node_id = :id');
$stmt->execute(['id' => $node_id]);

echo 'true';
?>

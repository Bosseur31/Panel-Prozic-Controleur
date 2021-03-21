<?php
include('sqlite.php');
include('url_api.php');

$name = $_POST['name'];
$node_id = $_POST['node_id'];

if (empty($node_id) or empty($name)) {
  echo 'empty';
  exit();
}

$url = "{$url_zwave}/execute";
$data = array('type' => 'request', 'action' => 'zwave.set_node_name', 'args' => array('new_name' => $name, 'node_id' => $node_id), "target" => "localhost");
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

//todo : Tester le retour de donnée pour valider la fait que la commande est passé


$stmt = $pdo->prepare("UPDATE main.appareil SET node_name=:name WHERE node_id=:node_id");
$stmt->execute(array(
  'name' => $name,
  'node_id' => $node_id,
));

echo 'true';

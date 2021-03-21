<?php
include('sqlite.php');
include('url_api.php');

$network = $_GET['id'];

if (empty($network)) {
  echo 'empty';
  exit();
}

$stmt = $pdo->prepare('SELECT `node_id`, `data`, `is_set` FROM main.appareil WHERE id_on_network=:network');
$stmt->execute(array(
  'network' => $network,
));
$donnees = $stmt->fetch();

$data = $donnees['data'];
$node_id = $donnees['node_id'];
$state = $donnees['is_set'];

if($state != '1'){
  echo 'empty';
  exit();
}

if($data === '1'){
  $data = 'False';
}else{
  $data = 'True';
}

$url = "{$url_zwave}/execute";
$data = array('type' => 'request', 'action' => 'zwave.set_value', 'args' => array('data' => $data,'id_on_network' => $network, 'node_id' => $node_id), "target" => "localhost");
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

echo 'true';

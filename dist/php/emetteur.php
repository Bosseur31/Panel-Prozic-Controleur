<?php
include('sqlite.php');
include('url_api.php');


$url = "{$url_emetteur}/blasters";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$blasters_json = curl_exec($ch);

$blasters = json_decode($blasters_json, true);

if ($errno = curl_errno($ch)) {
  $error_message = curl_strerror($errno);
  echo 'false';
  exit();
}
curl_close($ch);

//todo : si blaster non disponible bouton supprimé apparait

foreach ($blasters as $groupId => $group) {


  foreach ($group as $keyId => $value) {

    $mac = $value['mac'];
    $stmt = $pdo->prepare('SELECT mac FROM main.telecommande WHERE mac = :mac');
    $stmt->execute(array('mac' => $mac));
    $result = $stmt->fetch();

    if (empty($result)) {

      $ip = $value['ip'];
      $mac = $value['mac'];
      $name = $value['name'];
      $state = $value['available'];
      $stmt = $pdo->prepare("INSERT INTO main.telecommande(`name`, `ip`, `mac`, `state`) VALUES ('$name', '$ip', '$mac', '$state')");
      $result = $stmt->execute();

    } else {
      $ip = $value['ip'];
      $mac = $value['mac'];
      $name = $value['name'];
      $state = $value['available'];
      $stmt = $pdo->prepare("UPDATE main.telecommande SET name=:name, ip=:ip, mac=:mac, state=:state WHERE mac=:mac");
      $result = $stmt->execute(array(
        'name' => $name,
        'ip' => $ip,
        'mac' => $mac,
        'state' => $state
      ));
    }
  }
}

echo 'true';

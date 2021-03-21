<?php

include('sqlite.php');
include('url_api.php');


//discover blaster avant de les récupérer
$url = "{$url_emetteur}/discoverblasters";

$options = array(
  CURLOPT_URL => $url, // Url cible (l'url la page que vous voulez télécharger)
  CURLOPT_RETURNTRANSFER => true, // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
  CURLOPT_HEADER => false // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
);

$CURL = curl_init();
curl_setopt_array($CURL, $options);
$content_json = curl_exec($CURL);
$content = json_decode($content_json, true);

//todo : Tester le retour de donnée pour valider la fait que la commande est passé

curl_close($CURL);

//Tester si un nouvel appareil a etais détécté.
$nbr_device = $content['new_devices'];



// Récuperer blaster precedement decouvert

$url = "{$url_emetteur}/blasters";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$blasters_json = curl_exec($ch);

$blasters = json_decode($blasters_json, true);

//todo : Tester le retour de donnée pour valider la fait que la commande est passé

curl_close($ch);

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

if ($nbr_device != '0') {
  echo 'true';
} else {
  echo 'false';
}



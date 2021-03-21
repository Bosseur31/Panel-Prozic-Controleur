<?php

include('sqlite.php');
include('url_api.php');

$name = $_POST['name'];
$mac = $_POST['mac'];

$url = "{$url_emetteur}/blasters/mac/{$mac}?new_name={$name}";

$options=array(
  CURLOPT_URL            => $url, // Url cible (l'url la page que vous voulez télécharger)
  CURLOPT_RETURNTRANSFER => true, // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
  CURLOPT_HEADER         => false, // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
  CURLOPT_PUT            => true
);

$CURL=curl_init();

curl_setopt_array($CURL,$options);

$content=curl_exec($CURL);

//todo : Tester le retour de donnée pour valider la fait que la commande est passé

curl_close($CURL);

$stmt = $pdo->prepare("UPDATE main.telecommande SET name=:name WHERE mac=:mac");
$stmt->execute(array(
  'name' => $name,
  'mac' => $mac,
));

echo 'true';

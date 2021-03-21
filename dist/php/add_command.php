<?php
include('sqlite.php');
include('url_api.php');

$mac_blasters = $_POST['telecommande'];
$name = $_POST['name'];
$device = $_POST['appareil'];
$command = $_POST['bouton'];
$id = time() ;

if ( empty($mac_blasters) or empty($name) or empty($device) or empty($command) ){
  echo 'empty';
  exit();
}

//todo : regex pour eviter les caractéres spéciaux

// create targets
// todo list: si la target existe deja ne pas en cree
$url = "{$url_emetteur}/targets/{$device}";

$options=array(
  CURLOPT_URL            => $url, // Url cible (l'url la page que vous voulez télécharger)
  CURLOPT_RETURNTRANSFER => true, // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
  CURLOPT_HEADER         => false, // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
  CURLOPT_PUT            => true
);

$CURL=curl_init();

curl_setopt_array($CURL,$options);

$content=curl_exec($CURL);

curl_close($CURL);

//learn command

$url = "{$url_emetteur}/targets/{$device}/commands/{$command}?blaster_attr=mac&blaster_value={$mac_blasters}";

$options=array(
  CURLOPT_URL            => $url, // Url cible (l'url la page que vous voulez télécharger)
  CURLOPT_RETURNTRANSFER => true, // Retourner le contenu téléchargé dans une chaine (au lieu de l'afficher directement)
  CURLOPT_HEADER         => false, // Ne pas inclure l'entête de réponse du serveur dans la chaine retournée
  CURLOPT_PUT            => true
);

$CURL=curl_init();

curl_setopt_array($CURL,$options);

$content=curl_exec($CURL);

curl_close($CURL);


$stmt = $pdo->prepare("INSERT INTO main.commands(`id`, `name`, `device`, `command`, `mac_blasters`) VALUES ('$id', '$name', '$device', '$command', '$mac_blasters')");
$result = $stmt->execute();

echo 'true';

<?php
include('url_api.php');

$url = "{$url_zwave}/execute";
$data = array('type' => 'request', 'action' => 'zwave.add_node', "args" => array("do_security" => "false"), "target"=>"localhost");
$data_json = json_encode($data);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response_json  = curl_exec($ch);
$response = json_decode($response_json);
$affich = var_export($response->{'response'}->{'output'}->{'success'});
echo $affich;
curl_close($ch);


// todo list : Seulement un bouton pour interupteur et switch en effet ces la meme requete API
// todo list : Ajouter bouton pour ajouter un vrai bouton et pas interupteur

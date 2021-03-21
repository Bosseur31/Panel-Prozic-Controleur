<?php

include('sqlite.php');
include('url_api.php');

$url = "{$url_zwave}/execute";
$data = array('type' => 'request', 'action' => 'zwave.get_switches', "target" => "localhost");
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

foreach ($response as $groupId => $group) {

  foreach ($group as $itemId => $item) {

    foreach ($item as $key => $value) {

      $node_id = $value['node_id'];
      $node_name = $value['node_name'];
      $command_class = $value['command_class'];
      $data = $value['data'];
      $data_as_string = $value['data_as_string'];
      $data_items = $value['data_items'];
      $genre = $value['genre'];
      $help = $value['help'];
      $home_id = $value['home_id'];
      $id_on_network = $value['id_on_network'];
      $index = $value['index'];
      $instance = $value['instance'];
      $is_polled = $value['is_polled'];
      $is_read_only = $value['is_read_only'];
      $is_set = $value['is_set'];
      $is_write_only = $value['is_write_only'];
      $label = $value['label'];
      $last_update = $value['last_update'];
      $min = $value['min'];
      $max = $value['max'];
      $object_id = $value['object_id'];
      $outdated = $value['outdated'];
      $parent_id = $value['parent_id'];
      $poll_intensity = $value['poll_intensity'];
      $precision = $value['precision'];
      $type = $value['type'];
      $units = $value['units'];
      $use_cache = $value['use_cache'];
      $value_id = $value['value_id'];

      $stmt = $pdo->prepare('SELECT value_id FROM main.appareil WHERE value_id = :value_id');
      $stmt->execute(array('value_id' => $value_id));
      $result = $stmt->fetch();

      if (empty($result)) {

        $stmt = $pdo->prepare("INSERT OR IGNORE INTO main.appareil (node_id, node_name, command_class, data, data_as_string, data_items, genre, help, home_id, id_on_network, index_z, instance, is_polled, is_read_only, is_set, is_write_only, label, last_update, min, max, object_id, outdated, parent_id, poll_intensity, precision, type, units, use_cache, value_id ) VALUES (:node_id, :node_name, :command_class, :data, :data_as_string, :data_items, :genre, :help, :home_id, :id_on_network, :index_z, :instance, :is_polled, :is_read_only, :is_set, :is_write_only, :label, :last_update, :min, :max, :object_id, :outdated, :parent_id, :poll_intensity, :precision, :type, :units, :use_cache, :value_id)");
        $result = $stmt->execute(array(

          'node_id' => $node_id,
          'node_name' => $node_name,
          'command_class' => $command_class,
          'data' => $data,
          'data_as_string' => $data_as_string,
          'data_items' => $data_items,
          'genre' => $genre,
          'help' => $help,
          'home_id' => $home_id,
          'id_on_network' => $id_on_network,
          'index_z' => $index,
          'instance' => $instance,
          'is_polled' => $is_polled,
          'is_read_only' => $is_read_only,
          'is_set' => $is_set,
          'is_write_only' => $is_write_only,
          'label' => $label,
          'last_update' => $last_update,
          'min' => $min,
          'max' => $max,
          'object_id' => $object_id,
          'outdated' => $outdated,
          'parent_id' => $parent_id,
          'poll_intensity' => $poll_intensity,
          'precision' => $precision,
          'type' => $type,
          'units' => $units,
          'use_cache' => $use_cache,
          'value_id' => $value_id
        ));
      } else {
        $stmt = $pdo->prepare("UPDATE main.appareil SET node_id=:node_id, node_name=:node_name, command_class=:command_class, data=:data, data_as_string=:data_as_string, data_items=:data_items, genre=:genre, help=:help, home_id=:home_id, index_z=:index_z, instance=:instance, is_polled=:is_polled, is_read_only=:is_read_only, is_set=:is_set, is_write_only=:is_write_only, label=:label, last_update=:last_update, min=:min, max=:max, object_id=:object_id, outdated=:outdated, parent_id=:parent_id, poll_intensity=:poll_intensity, precision=:precision, type=:type, units=:units, use_cache=:use_cache, value_id=:value_id  WHERE id_on_network=:id_on_network");
        $stmt->execute(array(

          'node_id' => $node_id,
          'node_name' => $node_name,
          'command_class' => $command_class,
          'data' => $data,
          'data_as_string' => $data_as_string,
          'data_items' => $data_items,
          'genre' => $genre,
          'help' => $help,
          'home_id' => $home_id,
          'id_on_network' => $id_on_network,
          'index_z' => $index,
          'instance' => $instance,
          'is_polled' => $is_polled,
          'is_read_only' => $is_read_only,
          'is_set' => $is_set,
          'is_write_only' => $is_write_only,
          'label' => $label,
          'last_update' => $last_update,
          'min' => $min,
          'max' => $max,
          'object_id' => $object_id,
          'outdated' => $outdated,
          'parent_id' => $parent_id,
          'poll_intensity' => $poll_intensity,
          'precision' => $precision,
          'type' => $type,
          'units' => $units,
          'use_cache' => $use_cache,
          'value_id' => $value_id
        ));
      }
    }
  }
}
echo 'true';

<?php
include('sqlite.php');

$name = $_POST['name'];
if (!empty($name)) {

  $stmt = $pdo->prepare("INSERT INTO main.scene(`name`) VALUES ('$name')");
  $result = $stmt->execute();

} else {
  echo 'false';
  exit();
}

foreach ($_POST as $key => $data) {


  $stmt = $pdo->prepare("SELECT COUNT('name') AS CNTREC FROM pragma_table_info('scene') WHERE name=:key");
  $stmt->execute(array('key' => $key));
  $temp_result = $stmt->fetch();
  $result = $temp_result['CNTREC'];

  if ($result > 0) {
    if ($data !== $name) {
      $stmt = $pdo->prepare("UPDATE main.scene SET '$key'='$data' WHERE name = :name ");
      $result = $stmt->execute(array('name' => $name));
      echo "Le champ existe' $key '-----'$result'----'";
    }
  } else {
    $stmt = $pdo->prepare("alter table main.scene add column '$key' varchar(255)");
    $result = $stmt->execute();
    $stmt = $pdo->prepare("UPDATE main.scene SET '$key'='$data' WHERE name = :name ");
    $result = $stmt->execute(array('name' => $name));
    echo "'le champ n'existe pas' $key '-----'$result'----'";
  }

}

//todo list : Gestion des scene, programme python externe

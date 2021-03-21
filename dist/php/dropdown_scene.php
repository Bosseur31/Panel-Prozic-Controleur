<?php
include('sqlite.php');


$stmt = $pdo->prepare('SELECT * FROM main.commands');
$stmt->execute();
// On affiche chaque entrée une à une
while ($donnees = $stmt->fetch()) {
  ?>

  <option value="<?php echo $donnees['id']; ?>" ><?php echo $donnees['name']; ?></option>

  <?php
}

$stmt->closeCursor(); // Termine le traitement de la requête




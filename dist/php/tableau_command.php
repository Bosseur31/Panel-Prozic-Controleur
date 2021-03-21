<?php
include('sqlite.php');
?>

<table class="table table-head-fixed text-nowrap">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Emetteur</th>
    <th>Appareil</th>
    <th>Bouton</th>
    <th>Editer</th>
  </tr>
  </thead>
  <tbody>
  <?php
  // On récupère tout le contenu de la table jeux_video
  $stmt = $pdo->prepare('SELECT * FROM main.commands');
  $stmt->execute();
  // On affiche chaque entrée une à une
  while ($donnees = $stmt->fetch()) {
    ?>
    <tr>
      <td><?php echo $donnees['name']; ?></td>
      <td><?php echo $donnees['mac_blasters']; ?></td>
      <td><?php echo $donnees['device']; ?></td>
      <td><?php echo $donnees['command']; ?></td>
      <td>
        <div >
          <div href="#" id="<?php echo $donnees['id']; ?>" onclick="try_command(this.id)"
             class="btn btn-block btn-outline-success btn-sm">Tester</div>
          <div href="#" id="<?php echo $donnees['id']; ?>" onclick="del_command(this.id)"
             class="btn btn-block btn-outline-danger btn-sm">Supprimer</div>
        </div>
      </td>
    </tr>

    <?php
  }

  $stmt->closeCursor(); // Termine le traitement de la requête


  ?>
  </tbody>
</table>

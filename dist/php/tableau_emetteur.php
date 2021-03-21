<?php
include('sqlite.php');
?>

<table class="table table-head-fixed text-nowrap">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Adresse IP</th>
    <th>Adresse MAC</th>
    <th>Etat</th>
    <th>Editer</th>
  </tr>
  </thead>
  <tbody>
  <?php

  // On récupère tout le contenu de la table jeux_video
  $stmt = $pdo->prepare('SELECT * FROM main.telecommande');
  $stmt->execute();
  // On affiche chaque entrée une à une
  while ($donnees = $stmt->fetch()) {
    ?>
    <tr>
      <td><?php echo $donnees['name']; ?></td>
      <td><?php echo $donnees['ip']; ?></td>
      <td><?php echo $donnees['mac']; ?></td>
      <td><?php if( $donnees['state'] === '1' ){echo 'Connecté';}else{echo 'Déconnecté';} ?></td>
      <td>
        <div href="#" id="<?php echo $donnees['mac']; ?>" onclick="edit_emetteur(this.id)" class="btn btn-block btn-outline-secondary btn-sm">Editer</div>
      </td>
    </tr>

    <?php
  }

  $stmt->closeCursor(); // Termine le traitement de la requête


  ?>
  </tbody>
</table>


<?php
include('sqlite.php');
?>

<table class="table table-head-fixed text-nowrap">
  <thead>
  <tr>
    <th>Nom</th>
    <th>Déclancheur</th>
    <th>Déclanché</th>
    <th>Edit</th>
  </tr>
  </thead>
  <tbody>
  <?php

  // On récupère tout le contenu de la table jeux_video
  $stmt = $pdo->prepare('SELECT * FROM main.scene');
  $stmt->execute();
  // On affiche chaque entrée une à une
  while ($donnees = $stmt->fetch()) {
    ?>
    <tr>
      <td><?php echo $donnees['name']; ?></td>
      <td><?php echo $donnees['declancheur']; ?></td>
      <td>
        <?php echo $donnees['declanche']; ?>
        <?php
        foreach ($donnees as $key => $data) {
          //TODO : selectionner seulement les boutons grace au label et par instance
          if ($key !== 'name' and $key !== 'declancheur' and $key !== 'declanche' and $key !== 'id' and !empty($data)) {
            echo " / $data";
          }
        }


        ?>
      </td>
      <td>
        <div>
          <div href="#" id="<?php echo $donnees['name']; ?>" onclick="try_scene(this.id)"
               class="btn btn-block btn-outline-success btn-sm">Tester</div>
          <div href="#" id="<?php echo $donnees['name']; ?>" onclick="del_scene(this.id)"
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

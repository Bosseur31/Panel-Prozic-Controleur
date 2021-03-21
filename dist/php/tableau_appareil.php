<?php
include('sqlite.php');
?>

<table class="table table-head-fixed text-nowrap">
  <thead>
  <tr>
    <th>Label</th>
    <th>Nom</th>
    <th>Detail</th>
    <th>Node ID</th>
    <th>Status</th>
    <th>Etat</th>
    <th>Editer</th>
  </tr>
  </thead>
  <tbody>
  <?php

  // On récupère tout le contenu de la table jeux_video
  $stmt = $pdo->prepare('SELECT * FROM main.appareil');
  $stmt->execute();
  // On affiche chaque entrée une à une
  while ($donnees = $stmt->fetch()) {
    ?>
    <tr>
      <td><?php echo $donnees['label']; ?></td>
      <td><?php echo $donnees['node_name']; ?></td>
      <td>
        <?php
        if ($donnees['instance'] === '1' and $donnees['label'] === 'Switch') {
          echo 'Switch 1 et 2';
        } elseif ($donnees['instance'] === '2' and $donnees['label'] === 'Switch') {
          echo 'Switch 1';
        } elseif ($donnees['instance'] === '3' and $donnees['label'] === 'Switch') {
          echo 'Switch 2';
        }
        ?>
      </td>
      <td><?php echo $donnees['node_id']; ?></td>
      <td>
        <?php
        if ($donnees['data'] === '1') {
          echo 'Allumé';
        } else {
          echo 'Eteint';
        }
        ?>
      </td>
      <td>
        <?php
        if ($donnees['is_set'] === '1') {
          echo 'Connecté';
        } else {
          echo 'Déconnecté';
        }
        ?>
      </td>
      <td>
        <div>

          <?php
          if ($donnees['is_set'] !== '1') { ?>
            <a href="#" id="<?php echo $donnees['node_id']; ?>" onclick="del_node(this.id)"
               class="btn btn-block btn-outline-danger btn-sm">Supprimer</a>

          <?php }else{ ?>
          <a href="#" id="<?php echo $donnees['node_id']; ?>" onclick="edit_node(this.id)"
             class="btn btn-block btn-outline-secondary btn-sm">Editer</a>
          <a href="#" id="<?php echo $donnees['id_on_network']; ?>" onclick="try_node(this.id)"
             class="btn btn-block btn-outline-success btn-sm">Tester</a>
        </div>
        <?php } ?>
      </td>
    </tr>

    <?php
  }

  $stmt->closeCursor(); // Termine le traitement de la requête


  ?>
  </tbody>
</table>

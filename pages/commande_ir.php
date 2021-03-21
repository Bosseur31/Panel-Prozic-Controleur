<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Dashboard Prozic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Sweet Alert 2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DB connect -->
  <?php include('../dist/php/sqlite_page.php'); ?>

</head>
<body onload="load_tableau()" class="hold-transition sidebar-mini">
<div class="wrapper">
  <!--modal-->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ajouter une commande</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="modal_form">
            <p>Entrer les informations nécessaire a la création de la commande&hellip;</p>

            <label for="in_telecommande">Nom de l'emetteur :</label>
            <select class="form-control" id="in_telecommande" name="telecommande">
              <?php

              $stmt = $pdo->prepare('SELECT * FROM main.telecommande');
              $stmt->execute();
              // On affiche chaque entrée une à une
              while ($donnees = $stmt->fetch()) {
                //TODO : selectionner seulement les boutons grace au label et par instance  ?>

                <option value="<?php echo $donnees['mac']; ?>">
                  <?php if (empty($donnees['name'])) {
                    echo $donnees['mac'];
                  } else {
                    echo $donnees['name'];
                  }
                  ?>
                </option>

                <?php
              }

              $stmt->closeCursor(); // Termine le traitement de la requête

              ?>
            </select>
            <br>
            <label for="in_name">Nom de la commande :</label>
            <input id="in_name" name="in_name" class="form-control" type="text" placeholder="Nom de la commande">
            <br>
            <label for="in_appareil">Nom de l'appareil :</label>
            <input id="in_appareil" name="in_appareil" class="form-control" type="text" placeholder="Nom de l'appareil">
            <br>
            <label for="in_bouton">Nom du bouton :</label>
            <input id="in_bouton" name="in_bouton" class="form-control" type="text" placeholder="Nom du bouton">
            <br>

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

          <a href="#" id="submit_form" onclick="submit_form()" class="btn btn-success">Valider</a>

        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.modal -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.html" class="brand-link">
      <img src="../dist/img/prozic_logo.png"
           alt="Prozic Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Dashboard Prozic</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="../index.html" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="appareil.php" class="nav-link">
              <i class="nav-icon fas fa-microchip"></i>
              <p>
                Appareil
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="commande_ir.php" class="nav-link active">
              <i class="nav-icon fas fa-satellite-dish"></i>
              <p>
                Commande IR
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="scenes.php" class="nav-link">
              <i class="nav-icon fas fa-plus"></i>
              <p>
                Ajouter Scenes
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Commande IR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Commande IR</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">

          <h5 class="m-0"><i class="fas fa-angle-right"></i> Ajouter un Enregistrement Infrarouge</h5>
        </div>
        <div class="card-body">
          <p class="card-text">Apres avoir installé et branché l'émétteur/récépteur infrarouge, lancer la séquence
            d'enregistrement avec le bouton ci-dessous puis suivre les instructions.</p>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
            <i class="fas fa-plus nav-icon"></i> Lancer Enregistrement
          </button>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Liste des Enregistrements Infrarouges</h3>
            <a id="reload_app" href="#" onclick="load_tableau()" style="position: relative; float: right;"
               class="btn btn-success"><i class="fas fa-sync-alt nav-icon"></i></a>
          </div>
          <!-- /.card-header -->
          <div id="tabl_app" class="card-body table-responsive p-0" style="height: 300px;">

            <!-- Tableau de command /dist/php/tableau_command.php -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 <a href="http://prozic.com">Prozic</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script>

  // Load bpard of command
  function load_tableau() {

    $('#tabl_app').load('../dist/php/tableau_command.php').fadeIn("slow");

  }

  //todo : apres validation des noms, laisser actif avec un chargement en testant si une commande est recu.
  // Learn command for emetteur
  function submit_form() {
    var form_url = "../dist/php/add_command.php"; //récupérer l'URL du formulaire
    var form_method = "POST"; //récupérer la méthode GET/POST du formulaire
    var d_name = $("#in_name").val();
    var d_appareil = $("#in_appareil").val();
    var d_bouton = $("#in_bouton").val();
    var d_telecommande = $("#in_telecommande").val();
    var form_data = {
      name: d_name,
      appareil: d_appareil,
      bouton: d_bouton,
      telecommande: d_telecommande
    };
    $.ajax({
      url: form_url,
      type: form_method,
      data: form_data,
      success: function (data) {
        if (data === 'true') {
          $('#modal-default').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'success',
            title: 'L\'éméteur IR est en mode récéption, ' +
              'mettre la telecommande face a l\'éméteur et appuyer sur le bouton désirez !'
          });
          load_tableau();
        } else if (data === 'empty') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Vous ne pouvez pas valider le formulaire  !' +
              ' Il manque une information.'
          });
        } else if (data === 'specialapp') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Vous ne pouvez pas valider le formulaire  !' +
              ' Les caractéres spéciaux ne sont pas autorisé dans le champ Appareil.'
          });
        } else if (data === 'specialbtn') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Vous ne pouvez pas valider le formulaire  !' +
              ' Les caractéres spéciaux ne sont pas autorisé dans le champ Bouton.'
          });
        } else {
          $('#modal-default').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite !' +
              'Si l\'erreur persiste redémarrer la centrale.'
          });
        }
      },
      error: function () {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 10000
        });
        Toast.fire({
          icon: 'warning',
          title: 'Une erreur c\'est produite ! ' +
            'Le nom de votre commande est probablement deja utilisé. ' +
            'Si ce n\'est pas le cas redémarrer le systéme.'
        });
      },
    });
  }

  // Delete command
  function del_command(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/del_command.php?id=" + id,
      success: function () {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 8000
        });
        Toast.fire({
          icon: 'success',
          title: 'La commande a etais supprimé avec succes !'
        });
        load_tableau();
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Try command
  function try_command(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/try_command.php?id=" + id,
      success: function (data) {
        if (data === 'true') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'success',
            title: 'Commande lancé avec succes !'
          });
        } else if (data === 'empty') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'La commande n\'a pas etais trouvé !'
          });
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite !' +
              'Si l\'erreur persiste redémarrer la centrale.'
          });
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

</script>

<!-- Sweet Alert 2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>


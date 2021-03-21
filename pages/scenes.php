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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Sweet Alert 2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DB connect -->
  <?php include('../dist/php/sqlite_page.php'); ?>

</head>
<body onload="load_tableau()" class="hold-transition sidebar-mini">
<div class="wrapper">
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
            <a href="commande_ir.php" class="nav-link">
              <i class="nav-icon fas fa-satellite-dish"></i>
              <p>
                Commande IR
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
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
            <h1>Ajouter Scenes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ajouter Scenes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">

          <h5 class="m-0"><i class="fas fa-angle-right"></i> Ajouter une Scene</h5>
        </div>
        <div class="card-body">
          <p class="card-text">
          <form id="dropdown_scene">
            <div class="form-group">
              <label for="name_sc">Nom Scene</label>
              <input id="name_sc" name="name" class="form-control" type="text" placeholder="Nom de la scene">
            </div>
            <div class="form-group">
              <label for="select_quand">Quand l'appareil</label>
              <select class="form-control" id="select_quand" name="declancheur">
                <?php

                $stmt = $pdo->prepare('SELECT * FROM main.appareil');
                $stmt->execute();
                // On affiche chaque entrée une à une
                while ($donnees = $stmt->fetch()) {
                  //TODO : selectionner seulement les boutons grace au label et par instance  ?>

                  <option>Le <?php echo $donnees['label']; ?> <?php echo $donnees['node_name']; ?> <?php
                    if ($donnees['instance'] === '1' and $donnees['label'] === 'Switch') {
                      echo 'Switch 1 et 2';
                    } elseif ($donnees['instance'] === '2' and $donnees['label'] === 'Switch') {
                      echo 'Switch 1';
                    } elseif ($donnees['instance'] === '3' and $donnees['label'] === 'Switch') {
                      echo 'Switch 2';
                    }
                    ?></option>

                  <?php
                }

                $stmt->closeCursor(); // Termine le traitement de la requête

                ?>
              </select>
            </div>
            <div class="form-group">
              <label for="select_base">est actionné faire</label>
              <select class="form-control" id="select_base" name="declanche">
                <?php

                $stmt = $pdo->prepare('SELECT * FROM main.commands');
                $stmt->execute();
                // On affiche chaque entrée une à une
                while ($donnees = $stmt->fetch()) {
                  //TODO : selectionner seulement les boutons grace au label et par instance  ?>

                  <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['name']; ?></option>

                  <?php
                }

                $stmt->closeCursor(); // Termine le traitement de la requête

                ?>
              </select>
              <div class="form-group" id="Cible">

                <!-- Cible pour l'ajout de champ -->

              </div>
            </div>


            <a href="#" class="btn btn-success" onclick="fAddText()"><i class="fas fa-plus nav-icon"></i></a>
            <a href="#" class="btn btn-danger" id="sup" onclick="fSuppText()"><i class="fas fa-minus nav-icon"></i></a>
            <a href="#" onclick="submit_form()" style="position: relative; float: right;" class="btn btn-success"><i class="fas fa-save nav-icon"></i> Sauvgarder Scene</a>
          </form>
          </p>
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

            <!-- Tableau avec les commandes /dist/php/tableau_scene.php -->

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
<script type="text/javascript">

  var c2

  //aller chercher les donnees sur un php externe
  function fAddText() {
    $.ajax({
      url: '../dist/php/dropdown_scene.php', // La ressource ciblée
      type: 'GET',
      success: function () {
        c = document.getElementById('Cible');
        c2 = c.getElementsByTagName('select');
        select_var = 'select_' + c2.length;
        var Contenu = document.getElementById('Cible').innerHTML;
        Contenu = Contenu + '        <select style="margin-top:10px;" class="form-control" id="' + select_var + '" name="' + select_var + '" >\n' +
          '          </select> \n';
        document.getElementById('Cible').innerHTML = Contenu;
        document.getElementById('sup').style.display = 'inline';
        $('#' + select_var + '').load('../dist/php/dropdown_scene.php').fadeIn("slow");
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  function fSuppText() {
    if (c2.length > 0) {
      $(c2[c2.length - 1]).remove();
    }
    if (c2.length === 0) {
      document.getElementById('sup').style.display = 'none'
    }

  }

  function load_tableau() {

    $('#tabl_app').load('../dist/php/tableau_scene.php').fadeIn("slow");

  }

  function submit_form() {
    var form_url = "../dist/php/add_scene.php"; //récupérer l'URL du formulaire
    var form_method = "POST"; //récupérer la méthode GET/POST du formulaire
    var form_data = $('#dropdown_scene').serialize();
    $.ajax({
      url: form_url,
      type: form_method,
      data: form_data,
      success: function (data) {
        if (data === 'false'){
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'La scene n\'a pas etais enregistré !' +
              ' Veuillez donner un nom a la scene.'
          });
          load_tableau();
        }else{
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'success',
            title: 'La scene a etais enregistré avec succes !'
          });
          load_tableau();
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
            'Le nom de votre scene est probablement deja utilisé. ' +
            'Si ce n\'est pas le cas redémarrer le systéme.'
        });
      },
    });
  }

  function del_scene(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/del_scene.php?id=" + id,
      success: function () {
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 8000
        });
        Toast.fire({
          icon: 'success',
          title: 'La scene a etais supprimé avec succes !'
        });
        load_tableau();
      },
      error: function () {
        alert('Une erreur c\'est produite contacté l\'administrateur du site');
      }
    });
  }
  function try_scene(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/try_scene.php?id=" + id,
      success: function (data) {
        if(data === 'true'){
          const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 8000
        });
          Toast.fire({
            icon: 'success',
            title: 'Scene lancé avec succes !'
          });
        }else if(data === 'empty'){
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'La scene n\'a pas etais trouvé !'
          });
        }else{
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
        alert('Une erreur c\'est produite contacté l\'administrateur du site');
      }
    });
  }


</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js" integrity="sha512-WNLxfP/8cVYL9sj8Jnp6et0BkubLP31jhTG9vhL/F5uEZmg5wEzKoXp1kJslzPQWwPT1eyMiSxlKCgzHLOTOTQ==" crossorigin="anonymous"></script>
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


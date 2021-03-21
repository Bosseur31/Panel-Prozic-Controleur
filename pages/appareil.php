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
<body class="hold-transition sidebar-mini" onload="load_tableau_ir(); load_tableau()">

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
            <a href="appareil.php" class="nav-link active">
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
            <h1>Appareil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Appareil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card">
        <div class="card-header">

          <h5 class="m-0"><i class="fas fa-angle-right"></i> Ajouter un Appareil </h5>
        </div>
        <div class="card-body">
          <p class="card-text">Apres avoir installé et branché l'appareil cértifié, cliquer sur le bouton correspondant
            ci-dessous et suivre les instructions.</p>
          <a href="#" id="add_interupteur" onclick="add_interupteur()" class="btn btn-success"><i
              class="fas fa-plus nav-icon"></i> Interupteur</a>
          <a href="#" id="add_tel" class="btn btn-success" onclick="add_emetteur()"><i
              class="fas fa-plus nav-icon"></i> Emetteur IR</a>
          <a href="#" id="add_switch" onclick="add_switch()" class="btn btn-success"><i
              class="fas fa-plus nav-icon"></i> Switch</a>
        </div>
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Liste des Emetteurs IR</h3>
            <a id="reload_ir" href="#" onclick="reload_app_ir()" style="position: relative; float: right;"
               class="btn btn-success"><i class="fas fa-sync-alt nav-icon"></i></a>
          </div>
          <!-- /.card-header -->
          <div id="tabl_ir" class="card-body table-responsive p-0" style="height: 250px;">

            <!-- Tableau des appareil chargé depuis ../dist/php/tableau_emetteur.php -->

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Liste des Appareils</h3>
            <a id="reload_app" href="#" onclick="reload_app()" style="position: relative; float: right;"
               class="btn btn-success"><i class="fas fa-sync-alt nav-icon"></i></a>
          </div>
          <!-- /.card-header -->
          <div id="tabl_app" class="card-body table-responsive p-0" style="height: 600px;">

            <!-- Tableau des appareil chargé depuis ../dist/php/tableau_appareil.php -->

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
<!--modal edit emetteur-->
<div class="modal fade" id="modal-emetteur">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Changer le nom d'un Emetteur</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal_form_emetteur">
          <p>Entrer les informations nécessaire a la modification du nom&hellip;</p>
          <br>
          <label for="in_name">Nouveau nom :</label>
          <input id="in_name" name="in_name" class="form-control" type="text" placeholder="Nouveau nom">
          <br>
          <div id="mac_hidden"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

        <a href="#" id="submit_form" onclick="submit_form_emetteur()" class="btn btn-success">Valider</a>

      </div>
      </form>
    </div>
  </div>
</div>
<!-- /.modal -->

<!--modal edit zwave-->
<div class="modal fade" id="modal-node">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Changer le nom d'un appareil</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="modal_form_node">
          <p>Entrer les informations nécessaire a la modification du nom&hellip;</p>
          <br>
          <label for="in_new_name">Nouveau nom :</label>
          <input id="in_new_name" name="in_new_name" class="form-control" type="text" placeholder="Nouveau nom">
          <br>
          <div id="node_id_hidden"></div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>

        <a href="#" id="submit_form" onclick="submit_form_node()" class="btn btn-success">Valider</a>

      </div>
      </form>
    </div>
  </div>
</div>
<!-- /.modal -->

<script type="text/javascript">

  // Add emetteur
  function add_emetteur() {
    $.ajax({
      url: '../dist/php/add_emetteur.php',
      type: 'POST',
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
            title: 'Un nouvel emetteur a etais appairé, ' +
              ' pensez a le renommer pour plus de simplicité !'
          })
          load_tableau_ir();
        } else if (data === 'false') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Aucun Emetteur détecté, veuillez mettre votre emetteur en mode appairage ! ' +
              'Si le probléme persiste redémarrer la centrale'
          })
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Echec du démarrage de la séquance d\'appairage ! ' +
              'Si le probléme persiste redémarrer la centrale'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Add switch
  function add_switch() {
    $.ajax({
      url: '../dist/php/add_switch.php',
      type: 'POST',
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
            title: 'Le mode appairage est actif pour 1 minute, ' +
              ' mettre le switch en mode association !'
          })
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Echec du démarrage de la séquance d\'appairage ! ' +
              'Si le probléme persiste redémarrer la centrale'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Add Interupteur
  function add_interupteur() {
    $.ajax({
      url: '../dist/php/add_interupteur.php',
      type: 'POST',
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
            title: 'Le mode appairage est actif pour 1 minute, ' +
              ' mettre l\'interupteur en mode association !'
          })
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Echec du démarrage de la séquance d\'appairage ! ' +
              'Si le probléme persiste redémarrer la centrale'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Load board of Z-Wave devices
  function load_tableau() {
    $.ajax({
      url: '../dist/php/appareil.php', // La ressource ciblée
      type: 'GET',
      success: function (data) {
        if (data === 'true') {
          $('#tabl_app').load('../dist/php/tableau_appareil.php').fadeIn("slow");
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite ! ' +
              'Si le probléme persiste redémarrer la centrale. ' +
              ' La liaison avec les appareils semble rompu.'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Load board of emetteur
  function load_tableau_ir() {
    $.ajax({
      url: '../dist/php/emetteur.php', // La ressource ciblée
      type: 'GET',
      success: function (data) {
        if (data === 'true') {
          $('#tabl_ir').load('../dist/php/tableau_emetteur.php').fadeIn("slow");
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite ! ' +
              'Si le probléme persiste redémarrer la centrale. ' +
              'La liaison avec les appareils semble rompu.'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Reload board of Z-wave devices
  function reload_app() {
    $.ajax({
      url: '../dist/php/appareil.php', // La ressource ciblée
      type: 'GET',
      success: function (data) {
        if (data === 'true') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
          });
          Toast.fire({
            icon: 'success',
            title: ' Liste des appareils mise a jour ! '
          })
          load_tableau();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite ! ' +
              'Si le probléme persiste redémarrer la centrale. ' +
              ' La liaison avec les appareils semble rompu.'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // Reload board of emetteur
  function reload_app_ir() {
    $.ajax({
      url: '../dist/php/emetteur.php', // La ressource ciblée
      type: 'GET',
      success: function (data) {
        if (data === 'true') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000
          });
          Toast.fire({
            icon: 'success',
            title: ' Liste des Emetteurs IR mise a jour ! '
          })
          load_tableau_ir();
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite ! ' +
              'Si le probléme persiste redémarrer la centrale. ' +
              ' La liaison avec les Emetteurs semble rompu.'
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  // delete appareil Z-Wave
  function del_node(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/del_node.php?id=" + id,
      success: function (data) {
        if( data === 'true' ){
          const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 8000
        });
          Toast.fire({
            icon: 'success',
            title: 'L\'appareil a etais supprimé avec succes !'
          });
          load_tableau();
        }else if( data === 'empty' ){
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'L\'element a supprimé n\'a pas etais trouvé ! ' +
              'Si le probléme persiste redémarrer la centrale. '
          })
        }else{
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur c\'est produite ! ' +
              'Si le probléme persiste redémarrer la centrale. '
          })
        }
      },
      error: function () {
        alert('Une erreur c\'est produite');
      }
    });
  }

  //open modal for rename emetteur
  function edit_emetteur(id) {

    if(document.getElementById('in_mac')){
      document.getElementById("in_mac").remove();
    }
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "in_mac");
    input.setAttribute("id", "in_mac");
    input.setAttribute("value", id);
    document.getElementById("mac_hidden").appendChild(input);

    $('#modal-emetteur').modal('show');

  }

  // Rename emetteur in modal
  function submit_form_emetteur() {
    var form_url = "../dist/php/edit_emetteur.php"; //récupérer l'URL du formulaire
    var form_method = "POST"; //récupérer la méthode GET/POST du formulaire
    var d_name = $("#in_name").val();
    var d_mac = $("#in_mac").val();
    var form_data = {
      name: d_name,
      mac: d_mac,
    };
    $.ajax({
      url: form_url,
      type: form_method,
      data: form_data,
      success: function (data) {
        if (data === 'true') {
          $('#modal-emetteur').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'success',
            title: 'Le nom de l\'emetteur a etais modifié avec succés !'
          });
          load_tableau_ir();
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
        } else {
          $('#modal-emetteur').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur  ! ' +
              'Si le probléme persiste redémarrer la centrale'
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
            'Le nom de votre emetteur est probablement deja utilisé. ' +
            'Si ce n\'est pas le cas redémarrer le systéme.'
        });
      },
    });
  }

  //open modal for rename zwave device
  function edit_node(id) {

    if(document.getElementById('in_node_id')){
      document.getElementById("in_node_id").remove();
    }
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "in_node_id");
    input.setAttribute("id", "in_node_id");
    input.setAttribute("value", id);
    document.getElementById("node_id_hidden").appendChild(input);

    $('#modal-node').modal('show');

  }

  // Rename emetteur in modal
  function submit_form_node() {
    var form_url = "../dist/php/edit_node.php"; //récupérer l'URL du formulaire
    var form_method = "POST"; //récupérer la méthode GET/POST du formulaire
    var d_name = $("#in_new_name").val();
    var d_node_id = $("#in_node_id").val();
    var form_data = {
      name: d_name,
      node_id: d_node_id,
    };
    $.ajax({
      url: form_url,
      type: form_method,
      data: form_data,
      success: function (data) {
        if (data === 'true') {
          $('#modal-node').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'success',
            title: 'Le nom de l\'appareil a etais modifié avec succés !'
          });
          reload_app();
        } else if (data === 'empty') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Vous ne pouvez pas valider le changement de nom  !' +
              ' Il manque une information.'
          });
        } else {
          $('#modal-node').modal('hide');
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'Une erreur  ! ' +
              'Si le probléme persiste redémarrer la centrale'
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
            'Le nom de votre appareil est probablement deja utilisé. ' +
            'Si ce n\'est pas le cas redémarrer le systéme.'
        });
      },
    });
  }

  // Try node
  function try_node(id) {
    $.ajax({
      type: "GET",
      url: "../dist/php/try_node.php?id=" + id,
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
            title: 'Test lancé avec succes !'
          });
          setTimeout(reload_app, 500);
        } else if (data === 'empty') {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 8000
          });
          Toast.fire({
            icon: 'error',
            title: 'L\'appareil nécessaire pour ce test n\'a pas etais trouvé !'
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

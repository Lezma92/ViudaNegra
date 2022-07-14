<?php
session_name("sesion_viudanegra");
session_start();
if (isset($_SESSION['id_usuario']) && isset($_SESSION['usuario']) && isset($_SESSION['nivel_privilegios'])) {

  if ($_SESSION['nivel_privilegios'] == "ADMIN") {
    # code...

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="../dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="../css/dashboard.rtl.css">
      <link rel="stylesheet" href="../css/dashboard.css">
      <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
      <script src="../js/sweetalert2.all.js"></script>


      <title>Bary restaurante viuda negra</title>
    </head>

    <body>

      <?php include("../integraciones/headers.php"); ?>

      <div class="container-fluid">
        <div class="row">
          <?php include("../integraciones/nav_bar.php"); ?>

          <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="ListadoProductos">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Productos</h1>
              <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#categoriaMenu">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                    Agregar categoria
                  </button>

                </div>
              </div>
            </div>
            <p>Listado de los cocteles y bebidas que se manejan dentro del bar</p>


            <div class="card">
              <div class="card-header">
                <h2>Categorias</h2>
              </div>
              <div class="card-body">
                <div class="row">
                  <?php include("../controlador/opc_coctelesybebidas.php"); ?>

                  <?php
                  $Categoria = operacionesCoctelesyBebidas::getCategoriasCoctelesyBebidas();
                  foreach ($Categoria as $key => $value) {
                  ?>
                    <div class="col-md-4 m-0 p-1">
                      <div class="card card_platillos bold text-dark  border" style="max-width: 25rem;">
                        <div class="card-header">
                          <p class="font-weight-bold text-center" style="font-size: 17px;">
                            <?php echo ($value["nombremenu"]); ?>
                          </p>
                          <img class="card-img-top" height="150px" width="130%" src="<?php echo ('../img/' . $value['url_imagen']); ?>" alt="Imagenes">
                        </div>

                        <div class="card-body text-center">
                          <button type="button" class="btn btn-primary" onclick="explorar(<?php echo ($value['id']); ?>,'<?php echo ($value['nombremenu']); ?>');">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                            </svg>
                            Explorar
                          </button>
                          <button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#modalActualizarTiposComidas">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                              <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z" />
                              <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                            </svg>
                            Editar

                          </button>
                          <button id="btn_eliminar" class="btn btn-danger" onclick="eliminarCategoria(<?php echo ($value['id']); ?>,'<?php echo ($value['nombremenu']); ?>');" data-toggle="tooltip" data-placement="top" title="Eliminar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                            </svg>
                          </button>

                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
      <?php include("../integraciones/modal_categoriaMenu.php"); ?>


    </body>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="../js/dashboard.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
    <script src="../js/ajax_coctelesybebidas.js"></script>
    <script src="../js/cerrar_sesion.js"></script>


    </html>

<?php
  } else {

    echo ("<script>window.location.href = '../controlador/logout.php';</script>");
  }
} else {

  echo ("<script>window.location.href = '../controlador/logout.php';</script>");
}
?>
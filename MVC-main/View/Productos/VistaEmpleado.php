<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.108.0">
    <title>TextilExport</title>
    
    <?php
    include_once './View/cabecera.php';
    ?>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

    </style>

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom">
      <div class="d-flex justify-content-around">

      
      <a href="#" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="../View/img/textil.svg" alt="logo" width="50" height="50" class="me-2" viewBox="0 0 118 94">
        <span class="fs-4">TextilExport</span>
      </a>

      <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-regular fa-user"></i> <?=isset($_SESSION['login_data']['Nombres'])? $_SESSION['login_data']['Nombres']:' Cuenta' ?>
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
        <?php
            if(!isset($_SESSION['login_data']['Nombres'])){            
            ?>
          <li><a class="dropdown-item" href="<?= PATH ?>/Usuarios/login">Iniciar Session</a></li>
          <?php
            } else{ ?>
          <li><a class="dropdown-item" href="<?= PATH ?>/Usuarios/logout">Cerrar Session</a></li>
          <?php
            }
          ?>
        </ul>
      </div>

      </div>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3 ">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Tienda de productos textiles y artículos promocionales.</h1>
        <p class="col-md-8 fs-4">Contamos con variedad de productos de acuerdo a tus gustos y necesidades como prendas de vestir, complementos, accesorios, tazas, termos,
          entre otros articulos de uso cotidiano.
        </p>
      </div>
    </div>

    <div class="row align-items-md-stretch">

      <div class="col-md-12">
        <div class="h-100 p-5 text-bg-dark rounded-3 ">
          <center>
            <h1>Administracion</h1>
            <p>Bienvenido, se encuentra en la interfaz administrativa.</p>
          </center>
          <div class="d-flex justify-content-around">
            <button type="button" class="btn btn-light" href="#agregar" data-bs-toggle="modal"><i class="fa-solid fa-plus fa-lg"></i>  Agregar Producto</button>
            <button type="button" class="btn btn-light" href="#agregar" data-bs-toggle="modal"><i class="fa-solid fa-chart-column fa-lg"></i>  Detalle de Ventas</button>
          </div>
        </div>
      </div>
    
      <!--<div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Add borders</h2>
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <button class="btn btn-outline-secondary" type="button">Example button</button>
        </div>
      </div>-->

    </div>

    <div class="row align-items-md-stretchS py-4">

       <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover table-responsive table-condensed" id="tabla" style="margin-top:20px;">
                <thead>
                    <th>img</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>ID Categoria</th>
                    <th>Precio</th>
                    <th>Existencias</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php                   
                    foreach($productos as $producto){                      
                    ?>
                    <tr>
                        <td><img src="../View/img/<?=$producto['Img']?>" class="card-img-top" style="width: 10rem; height: 10rem;" alt="Producto"></td>
                        <td><?=$producto['ID_Producto']?></td>
                        <td><?=$producto['Nombre']?></td>
                        <td><?=$producto['Descripcion']?></td>
                        <td><?=$producto['id_categoria']?></td>
                        <td><?=$producto['Precio']?></td>
                        <td><?=$producto['Existencias']?></td>
                        <td>
                          <button type="button" class="btn btn-primary d-grid gap-2 m-3" data-bs-toggle="modal" data-bs-target="#modal" href="javascript:void(0)" onclick="detalles('<?=$producto['ID_Producto']?>')">Ver mas</button>
                          <button type="button" class="btn btn-primary d-grid gap-2 m-3" data-bs-toggle="modal" data-bs-target="#editar">Editar</button>
                          <button type="button" class="btn btn-danger d-grid gap-2 m-3" data-bs-toggle="modal" data-bs-target="#eliminar>">Eliminar</button>                    
                        </td>
                    </tr>
                    <?php          
                    }
                    ?>
                </tbody>
        </table>
      </div>
    </div>

 
    <!-- <div class="row align-items-md-stretch">

      <div class="col-md-12">
        <div class="h-100 p-5 text-bg-dark rounded-3 ">
          <center>
            <h2>Administracion</h2>
            <p>Zona para personal de la tienda. Si desea agregar, editar y eliminar productos; ingresar al siguiente apartado que presetara
              una pagina principal para administrara la informacion de los productos.
            </p>
            <a href="inventario.php" class="btn btn-secondary" type="button">Ingresar</a>
          </center>
        </div>
      </div> -->
    
      <!--<div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">
          <h2>Add borders</h2>
          <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
          <button class="btn btn-outline-secondary" type="button">Example button</button>
        </div>
      </div>-->

    </div>

    <footer class="pt-3 mt-4 text-muted border-top">
      Marco Gerardo Serrano Lopez SL182556
    </footer>
  </div>
</main>

  <?php
    include_once './View/Modales/VerProducto.php';
  ?>



<script>
    $(document).ready(function () {
        $('#tabla').DataTable();
    });
    
    function detalles(id){
        $.ajax({
            url:"<?=PATH?>/Productos/details/"+id,
            type:"GET",
            dataType:"JSON",
            success: function(datos){
                $('#nombre').text(datos.Nombre);
                $('#codigo').text(datos.ID_Producto);
                <?php
                foreach($categorias as $categoria){
                ?>
                if(datos.id_categoria == '<?=$categoria['ID_Categoria']?>'){
                  datos.id_categoria = '<?=$categoria['Categoria']?>';               
                }
                <?php      
                }
                ?>
                $('#categoria').text(datos.id_categoria);
                $('#precio').text(datos.Precio);
                if(datos.Existencias == 0){
                  datos.Existencias = "Producto no Disponible"
                }
                $('#existencias').text(datos.Existencias);
                $('#descripcion').text(datos.Descripcion);
                $('#modal').modal('show');
                $('.titulo-modal').text(datos.Nombre);
            }
        })
    }
</script>

  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>
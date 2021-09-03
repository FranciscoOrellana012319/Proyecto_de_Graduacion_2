<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-boxes fa-fw"></i> &nbsp; Productos del pedido
    </h3>
</div>

<div class="container-fluid">
    <?php
    include "./vistas/inc/".LANG."/btn_go_back.php";
    ?>
    <div class="full-box dashboard-container">
        <?php
            if(isset($_POST['productos'])){
                $busqueda = $_POST['productos'];
                $pagina[2] = "";
            }
            else{
                $busqueda = "";
            }

            require_once "./controladores/productoControlador.php";
            $ins_producto = new productoControlador();

            echo $ins_producto->pedidos_paginador_producto_controlador($busqueda);
        ?>
    </div>
</div>
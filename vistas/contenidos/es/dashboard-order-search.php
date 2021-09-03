<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-search fa-fw"></i> &nbsp; Buscar pedido
    </h3>
</div>


<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/order-list/" ><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de pedidos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo SERVERURL.DASHBOARD; ?>/order-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; Buscar pedido</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <?php
        if(!isset($_SESSION['fecha_inicio_pedido']) && !isset($_SESSION['fecha_final_pedido'])){
    ?>
    <form class="dashboard-container mb-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="default" data-lang="<?php echo LANG; ?>" method="POST" autocomplete="off" style="padding-top: 40px" id="buscar111" name="buscar111">
        <input type="hidden" name="modulo" value="pedido">
        <div class="container-fluid">
            <div class="row d-flex justify-content-left">
                <div class="col-12 col-md-6">
                    <div class="form-outline mb-4">
                        <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" maxlength="30">
                        <label for="fecha_inicio" class="form-label">Fecha de inicio. AAAA-MM-DD</label>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-left">
                <div class="col-12 col-md-6">
                    <div class="form-outline mb-4">
                    <input type="text" class="form-control" name="fecha_final" id="fecha_final" maxlength="30">
                        <label for="fecha_final" class="form-label">Fecha final. AAAA-MM-DD</label>
                    </div>
                </div>
            </div>

            <p class="text-center">
                        <button class="btn btn-primary"><i class="fas fa-search"></i> &nbsp; Buscar</button>
                    </p>
        </div>
    </form>
    
    <?php }else{ ?>
    <div class="dashboard-container mb-4">
        <form class="mb-4 FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" data-form="search" data-lang="<?php echo LANG; ?>" method="POST">
            <input type="hidden" name="modulo" value="pedido">
            <input type="hidden" name="eliminar_busqueda" value="eliminar">
            <p class="lead text-center roboto-condensed-regular">Resultados de la búsqueda <span class="font-weight-bold">“<?php echo "desde: ".$_SESSION['fecha_inicio_pedido']." Hasta: ".$_SESSION['fecha_final_pedido']; ?>”</span></p>
            <p class="text-center">
                <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> &nbsp; Eliminar búsqueda</button>
            </p>
        </form>

        <?php
            require_once "./controladores/pedidosControlador.php";
            $ins_cliente = new pedidosControlador();
            $array = array("inicio" => $_SESSION['fecha_inicio_pedido'], "final" => $_SESSION['fecha_final_pedido']);
            $fechas_array[] = $array;
            $fechas = serialize($fechas_array);
            $fechas = urlencode($fechas);

            $_SESSION['busqueda_pedido'] = $fechas;
            echo $ins_cliente->paginador_pedidos_controlador($pagina[2],15,$pagina[1],$_SESSION['busqueda_pedido']);
        ?>
    </div>
    <?php } ?>
</div>
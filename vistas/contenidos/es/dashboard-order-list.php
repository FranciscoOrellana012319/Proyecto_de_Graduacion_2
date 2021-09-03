<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de Pedidos
    </h3>
</div>


<div class="container-fluid">
    <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" href="<?php echo SERVERURL.DASHBOARD; ?>/order-list/" ><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; Lista de pedidos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" href="<?php echo SERVERURL.DASHBOARD; ?>/order-search/" ><i class="fas fa-search fa-fw"></i> &nbsp; Buscar pedido</a>
        </li>
    </ul>
</div>

<div class="container-fluid">
    <div class="dashboard-container">
        <?php
            require_once "./controladores/pedidosControlador.php";
            $ins_pedidos = new pedidosControlador();

            echo $ins_pedidos->paginador_pedidos_controlador($pagina[2],5,$pagina[1],"");
        ?>
    </div>
</div>
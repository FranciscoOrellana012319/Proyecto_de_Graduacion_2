<div class="full-box page-header">
    <h3 class="text-start roboto-condensed-regular text-uppercase">
        <i class="fas fa-sync-alt fa-fw"></i> &nbsp; Actualizar pedido
    </h3>
</div>

<div class="container-fluid">
    <?php
        include "./vistas/inc/".LANG."/btn_go_back.php";
        require_once './modelos/mainModel.php';
        $pedido = $_POST['pedido_id_up'];
        
        $datos_pedido=$ins_login->datos_tabla("Unico","pedidos","id",$pedido);
        $datos_pedido->rowCount();
        $campos=$datos_pedido->fetch();
    ?>
    <form class="" method="POST" action="" >
        <input type="hidden" name="actualizar" value="1">
        <input type="hidden" name="pedido_id_up" value="<?php echo $pedido; ?>">
        
        <fieldset class="mb-4">
            <legend><i class="fas fa-user-lock"></i> &nbsp; Datos del pedido</legend>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <span><strong>Seleccione el estado del envio</strong></span>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="envio_estado_up" value="Pendiente" id="envio_estado_pendiente" <?php if($campos['envio']=="Pendiente"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="envio_estado_pendiente">Pendiente</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="envio_estado_up" value="Enviado" id="envio_estado_enviado" <?php if($campos['envio']=="Enviado"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="envio_estado_enviado">Enviado</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="envio_estado_up" value="Entregado" id="envio_estado_entregado" <?php if($campos['envio']=="Entregado"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="envio_estado_entregado">Entregado</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="envio_estado_up" value="Incidente" id="envio_estado_incidente" <?php if($campos['envio']=="Incidente"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="envio_estado_incidente">Incidente</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-4">
                            <span><strong>Seleccione el estado del pago</strong></span>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="pago_estado_up" value="Pendiente" id="pago_estado_pendiente" <?php if($campos['pago']=="Pendiente"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="pago_estado_pendiente">Pendiente</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pago_estado_up" value="Pagado" id="pago_estado_pagado" <?php if($campos['pago']=="Pagado"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="pago_estado_pagado">Pagado</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pago_estado_up" value="Reembolso" id="pago_estado_reembolso" <?php if($campos['pago']=="Reembolso"){ echo "checked"; } ?> />
                                <label class="form-check-label" for="pago_estado_reembolso">Reembolso</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <p class="text-center" style="margin-top: 40px;">
            <button type="submit" class="btn btn-success"><i class="fas fa-sync-alt"></i> &nbsp; ACTUALIZAR</button>
        </p>
    </form>
</div>

<?php
require_once "./controladores/pedidosControlador.php";
$ins_carrito = new pedidosControlador();

if(isset($_POST['actualizar'])){
    echo $ins_carrito->actualizar_pedido_controlador();
}
?>
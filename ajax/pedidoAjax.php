<?php
	$peticion_ajax=true;
	require_once "../config/APP.php";
	include "../vistas/inc/session_start.php";

	if(isset($_POST['modulo_pedido'])){

		/*--------- Instancia al controlador  ---------*/
		require_once "../controladores/pedidosControlador.php";
        $ins_cliente = new pedidosControlador();

		/*--------- Eliminar cliente ---------*/
        if($_POST['modulo_pedido']=="eliminar"){
            echo $ins_cliente->eliminar_pedido_controlador();
		}

	}
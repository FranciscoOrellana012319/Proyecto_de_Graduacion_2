<?php
	$peticion_ajax=true;
	require_once "../config/APP.php";
	include "../vistas/inc/session_start.php";

	if(isset($_POST['modulo_producto'])){

		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/productoControlador.php";
        $ins_producto = new productoControlador();
        

        /*--------- Registrar producto ---------*/
        if($_POST['modulo_producto']=="registro"){
            echo $ins_producto->registrar_producto_controlador();
		}
		
		/*--------- Eliminar producto ---------*/
        if($_POST['modulo_producto']=="eliminar"){
            echo $ins_producto->eliminar_producto_controlador();
		}
		
		/*--------- Actualizar producto ---------*/
        if($_POST['modulo_producto']=="actualizar"){
            echo $ins_producto->actualizar_producto_controlador();
        }

		/*--------- Actualizar portada de producto ---------*/
        if($_POST['modulo_producto']=="portada_actualizar"){
			echo $ins_producto->actualizar_portada_producto_controlador();
		}

		/*--------- Eliminar portada de producto ---------*/
        if($_POST['modulo_producto']=="portada_eliminar"){
			echo $ins_producto->eliminar_portada_producto_controlador();
		}

		/*--------- Agregar imagen a galeria ---------*/
        if($_POST['modulo_producto']=="galeria_agregar"){
			echo $ins_producto->agregar_galeria_producto_controlador();
		}

		/*--------- Eliminar imagen de galeria ---------*/
        if($_POST['modulo_producto']=="galeria_eliminar"){
			echo $ins_producto->eliminar_galeria_producto_controlador();
		}

	}else{
		session_destroy();
		header("Location: ".SERVERURL."index/");
	}
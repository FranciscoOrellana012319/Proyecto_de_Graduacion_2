<?php
	$peticion_ajax=true;
	require_once "../config/APP.php";
	include "../vistas/inc/session_start.php";

	if(isset($_POST['modulo_login'])){

		/*--------- Instancia al controlador ---------*/
		require_once "../controladores/loginControlador.php";
        $ins_login = new loginControlador();
        

        /*--------- Cerrar sesion administrador ---------*/
        if($_POST['modulo_login']=="logout_administrador"){
            echo $ins_login->cerrar_sesion_administrador_controlador();
		}


	}else{
		session_destroy();
		header("Location: ".SERVERURL."index/");
	}
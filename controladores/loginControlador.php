<?php

	if($peticion_ajax){
		require_once "../modelos/mainModel.php";
	}else{
		require_once "./modelos/mainModel.php";
	}

	class loginControlador extends mainModel{

		/*----------  Controlador iniciar sesion administrador ----------*/
		public function iniciar_sesion_administrador_controlador(){

			$usuario=mainModel::limpiar_cadena($_POST['dashboard_usuario']);
			$clave=mainModel::limpiar_cadena($_POST['dashboard_clave']);

			/*-- Comprobando campos vacios --*/
			if($usuario=="" || $clave==""){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "No has llenado todos los campos que son requeridos.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}


			/*-- Verificando integridad datos -  --*/
			if(mainModel::verificar_datos("[a-zA-Z0-9]{4,30}",$usuario)){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "El nombre de usuario no coincide con el formato solicitado.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}
			if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "La contraseña no coincide con el formato solicitado.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}

			$clave=mainModel::encryption($clave);

			
			$datos_cuenta=mainModel::datos_tabla("Normal","usuario WHERE usuario_usuario='$usuario' AND 	usuario_clave='$clave' AND usuario_cuenta_estado='Activa'","*",0);

			if($datos_cuenta->rowCount()==1){

				$row=$datos_cuenta->fetch();

				$datos_cuenta->closeCursor();
			    $datos_cuenta=mainModel::desconectar($datos_cuenta);

				$_SESSION['id_sto']=$row['usuario_id'];
				$_SESSION['nombre_sto']=$row['usuario_nombre'];
				$_SESSION['apellido_sto']=$row['usuario_apellido'];
				$_SESSION['genero_sto']=$row['usuario_genero'];
				$_SESSION['usuario_sto']=$row['usuario_usuario'];
				$_SESSION['cargo_sto']=$row['usuario_cargo'];
				$_SESSION['foto_sto']=$row['usuario_foto'];
				$_SESSION['token_sto']=mainModel::encryption(uniqid(mt_rand(), true));

				if(headers_sent()){
					echo "<script> window.location.href='".SERVERURL.DASHBOARD."/home/'; </script>";
				}else{
					return header("Location: ".SERVERURL.DASHBOARD."/home/");
				}

			}else{
				echo'<script>
					Swal.fire({
					  title: "Datos incorrectos",
					  text: "El nombre de usuario o contraseña no son correctos.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
			}
		} 


		/*----------  Controlador iniciar sesion cliente -    ----------*/
		public function iniciar_sesion_cliente_controlador(){

			$email=mainModel::limpiar_cadena($_POST['login_email']);
			$clave=mainModel::limpiar_cadena($_POST['login_clave']);

			/*-- Comprobando campos vacios -  --*/
			if($email=="" || $clave==""){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "No has llenado todos los campos que son requeridos.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}

			if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
				echo'<script>
					Swal.fire({
					  title: "Ocurrió un error inesperado",
					  text: "La contraseña no coincide con el formato solicitado.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
				exit();
			}

			$clave=mainModel::encryption($clave);

			
			$datos_cuenta=mainModel::datos_tabla("Normal","cliente WHERE cliente_email='$email' AND cliente_clave='$clave' AND cliente_cuenta_estado='Activa'","*",0);

			if($datos_cuenta->rowCount()==1){

				$row=$datos_cuenta->fetch();

				$datos_cuenta->closeCursor();
			    $datos_cuenta=mainModel::desconectar($datos_cuenta);

				$_SESSION['cliente_id_sto']=$row['cliente_id'];
				$_SESSION['cliente_nombre_sto']=$row['cliente_nombre'];
				$_SESSION['cliente_apellido_sto']=$row['cliente_apellido'];
				$_SESSION['cliente_genero_sto']=$row['cliente_genero'];
				$_SESSION['cliente_telefono_sto']=$row['cliente_telefono'];
				$_SESSION['cliente_provincia_sto']=$row['cliente_provincia'];
				$_SESSION['cliente_ciudad_sto']=$row['cliente_ciudad'];
				$_SESSION['cliente_direccion_sto']=$row['cliente_direccion'];
				$_SESSION['cliente_email_sto']=$row['cliente_email'];
				$_SESSION['cliente_foto_sto']=$row['cliente_foto'];
				$_SESSION['cliente_token_sto']=mainModel::encryption(uniqid(mt_rand(), true));

				if(headers_sent()){
					echo'<script>
					Swal.fire({
					  title: "Bienvenido '.$_SESSION['cliente_nombre_sto'].'",
					  text: "Has ingresado correctamente a tu cuenta",
					  icon: "success",
					  confirmButtonText: "Aceptar"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href="'.SERVERURL.'"
						} 
					  });
				</script>';
				}else{
					echo'<script>
					Swal.fire({
					  title: "Bienvenido '.$_SESSION['cliente_nombre_sto'].'",
					  text: "Has ingresado correctamente a tu cuenta",
					  icon: "success",
					  confirmButtonText: "Aceptar"
					}).then((result) => {
						if (result.isConfirmed) {
							window.location.href="'.SERVERURL.'"
						} 
					  });
				</script>';
				}

			}else{
				echo'<script>
					Swal.fire({
					  title: "Datos incorrectos",
					  text: "El nombre de usuario o contraseña no son correctos.",
					  icon: "error",
					  confirmButtonText: "Aceptar"
					});
				</script>';
			}
		} 


		/*----------  Controlador forzar cierre de sesion -----*/
		public function forzar_cierre_sesion_controlador(){
			session_destroy();
			if(headers_sent()){
				echo "<script> window.location.href='".SERVERURL."index/'; </script>";
			}else{
				return header("Location: ".SERVERURL."index/");
			}
		} /*-- Fin controlador --*/


		/*----------  Controlador cierre de sesion administrador ----------*/
		public function cerrar_sesion_administrador_controlador(){
			$token=mainModel::decryption($_POST['token']);
			$usuario=mainModel::decryption($_POST['usuario']);

			if($token==$_SESSION['token_sto'] && $usuario==$_SESSION['usuario_sto']){
				unset($_SESSION['id_sto']);
				unset($_SESSION['nombre_sto']);
				unset($_SESSION['apellido_sto']);
				unset($_SESSION['genero_sto']);
				unset($_SESSION['usuario_sto']);
				unset($_SESSION['cargo_sto']);
				unset($_SESSION['foto_sto']);
				unset($_SESSION['token_sto']);
				$alerta=[
					"Alerta"=>"redireccionar",
					"URL"=>SERVERURL.DASHBOARD."/"
				];
			}else{
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Ocurrió un error inesperado",
					"Texto"=>"No se pudo cerrar la sesión",
					"Icon"=>"error",
					"TxtBtn"=>"Aceptar"
				];
			}
			echo json_encode($alerta);
		} /*-- Fin controlador --*/


		
		public function cerrar_sesion_cliente_controlador(){
			session_destroy();
			unset($_SESSION['cliente_id_sto']);
			unset($_SESSION['cliente_nombre_sto']);
			unset($_SESSION['cliente_apellido_sto']);
			unset($_SESSION['cliente_genero_sto']);
			unset($_SESSION['cliente_telefono_sto']);
			unset($_SESSION['cliente_provincia_sto']);
			unset($_SESSION['cliente_ciudad_sto']);
			unset($_SESSION['cliente_direccion_sto']);
			unset($_SESSION['cliente_email_sto']);
			unset($_SESSION['cliente_foto_sto']);
			unset($_SESSION['cliente_token_sto']);
			unset($_SESSION['bag']);
			echo'<script>
					Swal.fire({
					  title: "Sesión Cerrada",
					  text: "Has cerado tu sesión en este dispositivo!",
					  icon: "success",
					  confirmButtonText: "Aceptar"
					}).then((result) => {
                    	if (result.isConfirmed) {
                    		window.location.href="'.SERVERURL.'/signin/"
                        } 
                    });
				</script>';

		} 
	}
<?php

    if($peticion_ajax){
        require_once "../modelos/mainModel.php";
    }else{
        require_once "./modelos/mainModel.php";
    }

	class pedidosControlador extends mainModel{
        
        /*--------- Controlador paginador clientes ---------*/
        public function paginador_pedidos_controlador($pagina,$registros,$url,$busqueda){
            $pagina=mainModel::limpiar_cadena($pagina);
			$registros=mainModel::limpiar_cadena($registros);

			$url=mainModel::limpiar_cadena($url);
			$url=SERVERURL.DASHBOARD."/".$url."/";

            if(isset($busqueda) && $busqueda !=""){
                $busqueda = urldecode($busqueda);
                $busqueda = unserialize($busqueda);
                foreach($busqueda as $row){
                    $fecha_inicio = $row['inicio'];
                    $fecha_final = $row['final'];
                }
            }

            $id=1;
			$tabla="";

			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
            $inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;
            
            if(isset($busqueda) && $busqueda!=""){
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM pedidos WHERE fecha >= '$fecha_inicio' AND fecha <= '$fecha_final' ORDER BY id ASC LIMIT $inicio,$registros";
			}else{
				$consulta="SELECT SQL_CALC_FOUND_ROWS * FROM pedidos ORDER BY id ASC LIMIT $inicio,$registros";
			}

			$conexion = mainModel::conectar();

			$datos = $conexion->query($consulta);

			$datos = $datos->fetchAll();

			$total = $conexion->query("SELECT FOUND_ROWS()");
			$total = (int) $total->fetchColumn();

            $Npaginas =ceil($total/$registros);
            
            /*-- Encabezado de la tabla --*/
			$tabla.='
            <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr class="text-center font-weight-bold">
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Estado del envio</th>
                        <th>Estado del pago</th>
                        <th>Cliente</th>
                        <th>Actualizar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
            ';

            if($total>=1 && $pagina<=$Npaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
                    $productos = urlencode($rows['productos']);
					$tabla.='
						<tr class="text-center" >
							<td>'.$contador.'</td>
							<td>'.$rows['fecha'].'</td>
							<td>
                            <form action="'.SERVERURL.DASHBOARD.'/ordered-product" method="POST" >
                                <input type="hidden" name="productos" value="'.$productos.'">
                                <button type="submit" style="text-decoration:none; border:solid 1px #004e92; border-radius:5px; color:#004e92; font-weight:bold; background:transparent;">Ver productos</button>
                            </form>
                            </td>
                            <td>Q'.$rows['total'].'</td>
                            <td>'.$rows['envio'].'</td>
                            <td>'.$rows['pago'].'</td>
                            <td><a class="btn btn-link" href="'.SERVERURL.DASHBOARD.'/client-list/'.mainModel::encryption($rows['id_cliente']).'/" style="text-decoration:none; border:solid 1px #004e92; border-radius:5px; color:#004e92; font-weight:bold; background:transparent;">Ver Cliente</a></td>
                            <td>
                                <form action="'.SERVERURL.DASHBOARD.'/order-update" method="POST" >
                                    <input type="hidden" name="pedido_id_up" value="'.mainModel::encryption($rows['id']).'">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-sync-alt"></i></button>
                                </form>
                            </td>
                            <td>
                                <form class="FormularioAjax" action="'.SERVERURL.'ajax/pedidoAjax.php" method="POST" data-form="delete" data-lang="'.LANG.'" >
                                    <input type="hidden" name="modulo_pedido" value="eliminar">
                                    <input type="hidden" name="pedido_id_del" value="'.mainModel::encryption($rows['id']).'">
                                    <input type="hidden" name="eliminar" value="1">
                                    <button type="submit" class="btn btn-link text-danger"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								<a href="'.$url.'" class="btn btn-primary btn-sm">
									Haga clic acá para recargar el listado
								</a>
							</td>
						</tr>
					';
				}else{
					$tabla.='
						<tr class="text-center" >
							<td colspan="7">
								No hay registros en el sistema
							</td>
						</tr>
					';
				}
			}

            $tabla.='</tbody></table></div>';

			if($total>0 && $pagina<=$Npaginas){
				$tabla.='<p class="text-end">Mostrando pedidos <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';
			}

			/*--Paginacion - Pagination --*/
			if($total>=1 && $pagina<=$Npaginas){
				$tabla.=mainModel::paginador_tablas($pagina,$Npaginas,$url,7,LANG);
			}

			return $tabla;
        } /*-- Fin controlador --*/



        /*--------- Controlador eliminar pedidos  ---------*/
        public function eliminar_pedido_controlador(){

            /*-- Comprobando privilegios  --*/
			if($_SESSION['cargo_sto']!="Administrador" && $_SESSION['cargo_sto']!="Cajero"){
                $alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Acceso no permitido",
                    "Texto"=>"No tienes los permisos necesarios para realizar esta operación en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
				echo json_encode($alerta);
				exit();
			}

            /*-- Recuperando id del pedido --*/
			$id=mainModel::decryption($_POST['pedido_id_del']);
			$id=mainModel::limpiar_cadena($id);

            /*-- Comprobando pedido en la BD --*/
			$check_pedido=mainModel::ejecutar_consulta_simple("SELECT id FROM pedidos WHERE id='$id'");
			if($check_pedido->rowCount()<=0){
				$alerta=[
					"Alerta"=>"simple",
					"Titulo"=>"Pedido no encontrado",
					"Texto"=>"El pedido que intenta eliminar no existe en el sistema",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
				];
				echo json_encode($alerta);
				exit();
			}
			$check_pedido->closeCursor();
			$check_pedido=mainModel::desconectar($check_pedido);

            /*-- Eliminando pedido --*/
			$eliminar_pedido=mainModel::eliminar_registro("pedidos","id",$id);

			if($eliminar_pedido->rowCount()==1){
                $alerta=[
                    "Alerta"=>"recargar",
                    "Titulo"=>"¡Pedido eliminado!",
                    "Texto"=>"El pedido ha sido eliminado del sistema exitosamente",
                    "Icon"=>"success",
                    "TxtBtn"=>"Aceptar"
                ];
			}else{
				$alerta=[
                    "Alerta"=>"simple",
                    "Titulo"=>"Ocurrió un error inesperado",
                    "Texto"=>"No hemos podido eliminar el pedido del sistema, por favor intente nuevamente",
                    "Icon"=>"error",
                    "TxtBtn"=>"Aceptar"
                ];
			}

			$eliminar_pedido->closeCursor();
			$eliminar_pedido=mainModel::desconectar($eliminar_pedido);

			echo json_encode($alerta);
        }


        /*--------- Controlador actualizar cliente---------*/
		public function actualizar_pedido_controlador(){

            /*-- Recibiendo id del cliente --*/
			$id=mainModel::decryption($_POST['pedido_id_up']);

            /*-- Recibiendo datos del formulario --*/
            $envio=$_POST['envio_estado_up'];
            $pago=$_POST['pago_estado_up'];

            /*-- Preparando datos para enviarlos al modelo--*/
			$datos_pedido_up=[
				"envio"=>[
					"campo_marcador"=>":Envio",
					"campo_valor"=>$envio
				],
				"pago"=>[
					"campo_marcador"=>":Pago",
					"campo_valor"=>$pago
                ]
			];

            $condicion=[
				"condicion_campo"=>"id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

            if(mainModel::actualizar_datos("pedidos",$datos_pedido_up,$condicion)){
                echo'
            <script>
                Swal.fire({
                  title: "Datos actualizados",
                  text: "Los datos del pedido se han actualizado correctamente",
                  icon: "success",
                  confirmButtonText: "Aceptar"
                }).then((result) => {
                	if (result.isConfirmed) {
                		window.location.href="'.SERVERURL.DASHBOARD.'/order-list/"
                    } 
                });
            </script>';
			}
            
            else{
                echo'
            <script>
                Swal.fire({
                  title: "ERROR",
                  text: "Ha ocurrido un error inesperado, por favor intentalo de nuevo",
                  icon: "error",
                  confirmButtonText: "Aceptar"
                }).then((result) => {
                	if (result.isConfirmed) {
                		window.location.href="'.SERVERURL.DASHBOARD.'/order-list/"
                    } 
                });
            </script>';
			}
        } /*-- Fin controlador--*/
	}
<?php

    if($peticion_ajax){
        require_once "../modelos/mainModel.php";
    }else{
        require_once "./modelos/mainModel.php";
    }

	class carritoControlador extends mainModel{


        /*--------- Controlador mostrar carrito ---------*/
        public function mostrar_carrito_controlador(){
            $url = SERVERURL;

            if(isset($_SESSION['bag'])){    
                $carrito = $_SESSION['bag'];
                $envio = 10.00;
                $subtotal = 0;
                $mostrar = true;
                $total = 0;

                foreach ($carrito as $rows1) {
                    $producto = $rows1['producto'];
                    $cantidad = $rows1['cantidad'];

                    if($cantidad > 0){
		    	        $consulta="SELECT * FROM producto WHERE producto_id = '$producto'";
                        $conexion = mainModel::conectar();                
		    	        $datos = $conexion->query($consulta);
		    	        $datos = $datos->fetchAll();

                        /*-- Encabezado de la tabla --*/
                        $productos_carrito = "";

                        foreach($datos as $rows){
                            $precio = $rows['producto_precio_venta']*$cantidad;
                            $subtotal = $subtotal+$precio;
		    	            echo '
                            <div class="row">
                                <div class="col-12 col-md-7 col-lg-8">
                                    <div class="container-fluid">

                                        <h5 class="poppins-regular font-weight-bold full-box text-center">'.$rows['producto_nombre'].'</h5>
                                        <br>
                                        <div class="bag-item full-box">
                                            <figure class="fulbox">
                                                <img src="'.$url.'vistas/assets/product/cover/'.$rows['producto_portada'].'" class="img-fluid" alt="producto_nombre">
                                            </figure>
                                            <div class="full-box">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-6 text-center mb-4">
                                                            <div class="row justify-content-center">
                                                                <div class="col-auto">
                                                                    <div class="form-outline mb-4">
                                                                    <form action="" method="post" id="actualizar">
                                                                        <input type="hidden" name="actualizar" value="1">
                                                                        <input type="hidden" name="producto" value="'.$producto.'">
                                                                        <br>
                                                                        <input type="text" name="cantidad" value="'.$cantidad.'" class="form-control text-center" id="product_cant" pattern="[1-9]{1,10}" maxlength="10" style="max-width: 100px; border:solid 1px #757575; margin:5px;">
                                                                        <label for="product_cant" class="form-label">Cantidad</label>

                                                                    </div>
                                                                </div>

                                                                <div class="col-auto">
                                                                    <button type="submit" class="btn btn-success" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Actualizar cantidad" ><i class="fas fa-sync-alt fa-fw"></i></button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 col-lg-4 text-center mb-4">
                                                            <span class="poppins-regular font-weight-bold" >SUBTOTAL: '.$rows['producto_precio_venta']*$cantidad.'</span>
                                                        </div>

                                                        <div class="col-12 col-lg-2 text-center text-lg-end mb-4">
                                                            <form action="" method="post" id="eliminar">
                                                                <input type="hidden" name="eliminar" value="1">
                                                                <input type="hidden" name="producto" value="'.$producto.'">
                                                                <button type="submit" class="btn btn-danger" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Quitar del carrito" >
                                                                    <span aria-hidden="true"><i class="far fa-trash-alt"></i></span>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-justify">
                                                <small>
                                                    En caso de que no se posea el producto en almacén, los datos del mismo fueran incorrectos o existieran cambios o restricciones por parte de la tienda (precio, inventario, u otras condiciones para la venta) <strong><?php echo COMPANY; ?></strong> se reserva el derecho de cancelar el pedido.
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                </div> 
                            ';

                            if($mostrar == true){
                                echo '
                                <div class="col-12 col-md-5 col-lg-4">
                                    <div class="full-box div-bordered">
                                        <h5 class="text-center text-uppercase bg-success" style="color: #FFF; padding: 10px 0;">Resumen de la orden</h5>
                                        <ul class="list-group bag-details">
                                            <a class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Subtotal
                                                <span id="subtotal"></span>
                                            </a>

                                            <a class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Envio
                                                <span>Q'.$envio.'</span>
                                            </a>

                                            <a class="list-group-item d-flex justify-content-between align-items-center" style="border-bottom: 1px solid #E1E1E1;"></a>

                                            <a class="list-group-item d-flex justify-content-between align-items-center text-uppercase poppins-regular font-weight-bold">
                                                Total
                                                <span id="total"></span>
                                            </a>
                                        </ul>
                                        <p class="text-center">
                                        <center>
                                            <form action="" method="POST" id="confirmar">
                                                <input type="hidden" name="confirmar" value="1">
                                                <input type="hidden" id="confirmar_subtotal" name="subtotal" value="">
                                                <input type="hidden" id="confirmar_total" name="total" value="">
                                                <button type="submit" class="btn btn-primary">Confirmar pedido</button>
                                            </form>
                                        </center>    
                                        </p>
                                    </div>
                                </div>
                                </div>';
                                $mostrar = false;
                            }
                        }
                    }
                }
                echo'
                <script>
                    var subtotal = '.$subtotal.';
                    var total = subtotal+'.$envio.';

                    let subt = document.getElementById("subtotal");
                    let tot = document.getElementById("total");

                    subt.innerHTML = "Q"+subtotal;
                    tot.innerHTML = "Q"+total;
                    document.getElementById("confirmar_subtotal").value = subtotal;
                    document.getElementById("confirmar_total").value = total;
                </script>
                ';
            }
        } /*-- Fin controlador --*/


        /*--------- Controlador agregar carrito ---------*/
        public function agregar_carrito_controlador(){
            
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];
            $indice = count($_SESSION["bag"]);

            $productos = array("producto" => $producto, "cantidad" => $cantidad, "key" => $indice++);
            if (empty($_SESSION["bag"])) {
                $_SESSION["bag"][] = $productos;
            }

            else{
                $carrito = $_SESSION['bag'];
                foreach ($carrito as $value) {
                    if($value['producto'] == $producto){
                        $repetido = true;
                        $cantidad_guardada = $value['cantidad'];
                        $key = $value['key'];
                    }
                }

                if($repetido == true){
                    $_SESSION['bag'][$key]['cantidad'] = $cantidad_guardada+$cantidad;
                }

                else{
                    $i = count($_SESSION["bag"]);
                    $_SESSION["bag"][] = $productos;
                }
            }  

            echo'
            <script>
                Swal.fire({
                  title: "Agregado al carito",
                  text: "El producto se ha agregado correctamente al carrito",
                  icon: "success",
                  confirmButtonText: "Aceptar"
                }).then((result) => {
                	if (result.isConfirmed) {
                		window.location.href="'.SERVERURL.'/bag/"
                    } 
                });
            </script>';
        } /*-- Fin controlador --*/


        /*--------- Controlador actualizar carrito  ---------*/
        public function actualizar_carrito_controlador(){            
            $producto = $_POST['producto'];
            $cantidad = $_POST['cantidad'];

            if (empty($_SESSION["bag"])) {
                echo'
                <script>
                    Swal.fire({
                    title: "Error",
                    text: "Por favor, primero agrega el producto al carrtio",
                    icon: "error",
                    confirmButtonText: "Aceptar"
                    });
                </script>
                ';
            }

            else{
                $carrito = $_SESSION['bag'];
                foreach ($carrito as $value) {
                    if($value['producto'] == $producto){
                        $encontrado = true;
                        $key = $value['key'];
                    }
                }

                if($encontrado == true){
                    $_SESSION['bag'][$key]['cantidad'] = $cantidad;
                    echo'
                    <script>
                        Swal.fire({
                        title: "Carrito Actualizado",
                        text: "El carrito se ha actualizado correctamente",
                        icon: "success",
                        confirmButtonText: "Aceptar"
                        }).then((result) => {
                        	if (result.isConfirmed) {
                        		window.location.href="'.SERVERURL.'/bag/"
                            } 
                        });
                    </script>
                    ';
                }

                else{
                    echo'
                    <script>
                        Swal.fire({
                        title: "Error",
                        text: "Por favor, primero agrega el producto al carrtio",
                        icon: "error",
                        confirmButtonText: "Aceptar"
                        });
                    </script>
                    ';
                }
            }  
        } /*-- Fin controlador --*/


        /*--------- Controlador eliminar carrito ---------*/
        public function eliminar_carrito_controlador(){            
            $producto = $_POST['producto'];
            $carrito = $_SESSION['bag'];

            foreach ($carrito as $value) {
                if($value['producto'] == $producto){
                    $encontrado = true;
                    $key = $value['key'];
                }
            }

            if($encontrado == true){
                $_SESSION['bag'][$key]['cantidad'] = 0;
                echo'
                <script>
                    Swal.fire({
                    title: "Producto Eliminado",
                    text: "El producto se ha eliminado correctamente",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                    }).then((result) => {
                    	if (result.isConfirmed) {
                    		window.location.href="'.SERVERURL.'/bag/"
                        } 
                    });
                </script>
                ';
            }
        } /*-- Fin controlador --*/


        /*--------- Controlador confirmar carrito ---------*/
        public function confirmar_carrito_controlador(){ 
            
            date_default_timezone_set('UTC');
            $fecha = date("Y-m-d");
            $hora = date('h:i:s A');
            $subtotal = $_POST['subtotal'];
            $total = $_POST['total'];
            $productos_pedido = [];
            $indice = count($productos_pedido);
            $cliente = $_SESSION['cliente_id_sto'];

            foreach ($_SESSION['bag'] as $cont) { 
                if($cont['cantidad'] != 0){ 
                    $productos = array("producto" => $cont['producto'], "cantidad" => $cont['cantidad'], "key" => $indice++);
                    $productos_pedido[] = $productos; 
                }
            }
            
            $productos_pedido = serialize($productos_pedido);

            /*-- Preparando datos para enviarlos al modelo  --*/
			$datos_pedido=[
                "id"=>[
					"campo_marcador"=>":Id",
					"campo_valor"=>""
                ],
				"fecha"=>[
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
                ],
				"productos"=>[
					"campo_marcador"=>":Productos",
					"campo_valor"=>$productos_pedido
                ],
                "subtotal"=>[
					"campo_marcador"=>":Subtotal",
					"campo_valor"=>$subtotal
                ],
                "total"=>[
					"campo_marcador"=>":Total",
					"campo_valor"=>$total
				],
                "envio"=>[
					"campo_marcador"=>":Envio",
					"campo_valor"=>"Pendiente"
				],
				"pago"=>[
					"campo_marcador"=>":Pago",
					"campo_valor"=>"Pendiente"
				],
				"id_cliente"=>[
					"campo_marcador"=>":Clienteid",
					"campo_valor"=>$cliente
				]
			];

            /*-- Guardando datos del cliente --*/
			$registrar_pedido=mainModel::guardar_datos("pedidos",$datos_pedido);
            $registrar_pedido->closeCursor();
			$registrar_pedido=mainModel::desconectar($registrar_pedido);

            unset($_SESSION['bag']);

            echo'
                <script>
                    Swal.fire({
                    title: "Pedido enviado a revisión",
                    text: "El pedido se ha enviado a revisión. Nos contactaremos con usted para confirmar su pedido",
                    icon: "success",
                    confirmButtonText: "Aceptar"
                    }).then((result) => {
                    	if (result.isConfirmed) {
                    		window.location.href="'.SERVERURL.'"
                        } 
                    });
                </script>
                ';

        } /*-- Fin controlador --*/
    }
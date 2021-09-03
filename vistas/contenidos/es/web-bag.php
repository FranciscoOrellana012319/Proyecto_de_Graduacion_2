<section class="container-cart bg-white">
    <div class="container container-web-page">
        <h3 class="font-weight-bold poppins-regular text-uppercase">Carrito de compras</h3>
        <hr>
    </div>
    <?php 
    if(isset($_SESSION['bag'])){
        $count = 0;
        foreach($_SESSION['bag'] as $cont){ 
            if($cont['cantidad'] != 0){ 
                $count++; 
            }
        } 
        if($count <= 0){
            echo'
        <center>
            <h1 style="font-weight:bold; color:#FF0000;">Actualmente no hay productos en tu carrito</h1>
            <br>
            <a href="'.SERVERURL.'product/all/"">Ir a comprar</a>
        </center>';
        }
    } 
    else{
        echo'
        <center>
            <h1 style="font-weight:bold; color:#FF0000;">Actualmente no hay productos en tu carrito</h1>
            <br>
            <a href="'.SERVERURL.'product/all/"">Ir a comprar</a>
        </center>';
    } 
    ?>

    <div class="container" style="padding-top: 40px;">
        <?php
            require_once "./controladores/carritoControlador.php";
            $ins_carrito = new carritoControlador();

            echo $ins_carrito->mostrar_carrito_controlador();

            if(isset($_POST['actualizar'])){
                echo $ins_carrito->actualizar_carrito_controlador();
            }

            if(isset($_POST['eliminar'])){
                echo $ins_carrito->eliminar_carrito_controlador();
            }

            if(isset($_POST['confirmar'])){  
                echo $ins_carrito->confirmar_carrito_controlador();
            }
        ?>


        <div class="container-fluid">
            <div class="dashboard-container">
        
            </div>
        </div>
    </div>

    
    <!--<div class="container">
        <p class="text-center" ><i class="fas fa-shopping-bag fa-5x"></i></p>
        <h4 class="text-center poppins-regular font-weight-bold" >Carrito de compras vacío</h4>
    </div>-->
</section>
<section class="container-cart container-signin">
    <div class="login-content mb-4">
        
        <?php if(isset($_SESSION['cliente_nombre_sto'])){ ?>

        <figure class="full-box mb-4">
            <img src="<?php echo SERVERURL; ?>vistas/assets/avatar/<?php echo $_SESSION['cliente_foto_sto']; ?>" alt="" class="img-fluid login-icon">
        </figure>
        <center>
            <h1><?php echo $_SESSION['cliente_nombre_sto']; ?></h1>
        </center>

        <br>
        
        <form action="" method="POST">
            <input type="hidden" name="logout" value="1">
            <p class="text-center poppins-regular"><button type="submit" style="border:none; background:#1266f1; color:#fff; padding:10px; border-radius:10px;">Cerrar Sesión</button></p>
        </form>  

        <form action="<?php echo SERVERURL."profile"; ?>" method="POST" id="update">
            <input type="hidden" name="id_cliente" value=<?php echo mainModel::encryption($_SESSION['cliente_id_sto']); ?>>
        </form>

        <center>
            <button type="submit" form="update" class="text-center poppins-regular" style="border:none; background:#1266f1; color:#fff; padding:10px; border-radius:10px;">Editar Perfil</button>
        </center>

        <?php } else{ ?>
            
        <figure class="full-box mb-4">
            <img src="<?php echo SERVERURL; ?>vistas/assets/avatar/Avatar_default_male.png" alt="" class="img-fluid login-icon">
        </figure>
        <form action="" method="POST" autocomplete="off">
            <div class="form-outline mb-4">
                <input type="email" class="form-control" id="login_email" name="login_email" maxlength="50" required="" >
                <label for="login_email" class="form-label"><i class="fas fa-envelope-open-text"></i> &nbsp; Email</label>
            </div>
            <div class="form-outline mb-4">
                <input type="password" class="form-control" id="login_clave" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required="" >
                <label for="login_clave" class="form-label"><i class="fas fa-key"></i> &nbsp; Contraseña</label>
            </div>
            <button type="submit" class="btn btn-primary text-center mb-4 w-100">LOG IN</button>
        </form>
        
    </div>
    <p class="text-center poppins-regular">¿No tienes cuenta? <a href="<?php echo SERVERURL; ?>registration/" class="font-weight-bold">Regístrate aquí</a></p>
    <?php } ?>
</section>

<?php
    require_once "./controladores/loginControlador.php";
    $ins_login = new loginControlador();

    if(isset($_POST['login_email']) && isset($_POST['login_clave'])){
		
		$ins_login->iniciar_sesion_cliente_controlador(); 
	}
    
    if(isset($_POST['logout'])){
            $ins_login->cerrar_sesion_cliente_controlador(); 
    }
?>
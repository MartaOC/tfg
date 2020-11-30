<?php

include_once 'header.php';


if (isset($data['display_login'])) {
?>
    <div class="container-fluid fondo">
        <div class="container d-flex  flex-column justify-content-center h-100 ">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <form action="index.php?url=LoginController/login/" method="POST">
                        <h1 class="display-4">Iniciar sesión</h1> <hr>
                        <div class="form-group">
                            <label for="InputEmail">Correo electrónico</label>
                            <input type="text" name="email" class="form-control" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="InputPassword">Contraseña</label>
                            <input type="password" name="pass" class="form-control" />
                        </div>
                        <div class="etc-login-form">

                            <p>¿No tienes cuenta?<a href="index.php?url=UserController/display/"> Regístrate</a></p>
                        </div>
                        <td><button type="submit" name="action" class="btn btn-primary btn-block">Iniciar sesión</button></td>
                    </form>
                </div>

            </div>
        </div>
    </div>


<?php
}
?>

<?php

include_once 'footer.php';

?>
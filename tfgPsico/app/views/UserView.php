<?php

include_once 'header.php';

?>


<div class="row">
    <div class="col-12 mb-5">

        <?php
        if (isset($data['registry']) || isset($data['edit_profile'])) {

        ?>

            <div class="container-fluid fondo">
                <div class="container d-flex flex-column justify-content-center h-100 align-center">

                    <form id="formUser" action="index.php?url=UserController/<?php echo isset($data['registry']) ? 'registrer' : 'edit_profile'; ?>/" method="POST">

                        <?php
                        if (isset($data['edit_profile'])) {
                        ?>
                            <input type="hidden" name="id_user" value="<?php echo $data['info_user']['id']; ?>" />
                            <input type="hidden" name="rol" value="<?php echo $data['info_user']['rol']; ?>" />
                        <?php
                        }
                        ?>
                        <h1 class="font-weight-light">Formulario</h1>
                        <hr class="bg-info">
                        <p class="pb-0 mb-0">Rellena los siguientes campos para crear tu cuenta de usuario.</p>
                        <p class="text-danger small pt-0 mt-0">*Todos los campos son obligatorios.</p>
                        <p class="small pt-0 mt-0">Los datos del formulario serán almacenados en nuestra base de datos con total confidecialidad.</p>
                        <div class="row form-group">
                            <label for="nombre" class="col-form-label col-md-4">Nombre: </label>
                            <div class="col-md-8">
                                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="ej. Juan" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                            echo $data['info_user']['nombre'];
                                                                                                                                        } ?>"/>
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="apellidos" class="col-form-label col-md-4">Apellidos: </label>
                            <div class="col-md-8">
                                <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="ej. Cortés Sánchez" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['apellidos'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="direccion" class="col-form-label col-md-4">Dirección: </label>
                            <div class="col-md-8">
                                <input type="text" name="direccion" class="form-control" id="direccion" placeholder="ej. C/ Isla graciosa, 23" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['direccion'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="ciudad" class="col-form-label col-md-4">Ciudad: </label>
                            <div class="col-md-8">
                                <input type="text" name="ciudad" class="form-control" id="ciudad" placeholder="ej. Madrid" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['ciudad'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="cp" class="col-form-label col-md-4">Código Postal: </label>
                            <div class="col-md-8">
                                <input type="text" name="cp" class="form-control" id="cp" placeholder="ej. 21455" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['cp'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="control-label col-md-4" for="date">Fecha de nacimiento: </label>
                            <div class="col-md-8">
                                <input type="date" min="1910-01-01" id="date" name="date" class="form-control" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['fechanac'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="tel" class="col-form-label col-md-4">Teléfono de contacto: </label>
                            <div class="col-md-8">
                                <input type="text" name="tel" pattern="[0-9]{9}" class="form-control" id="tel" placeholder="ej. 690685745" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['tfno'];
                                                                                                                                                } ?>"/>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="email" class="col-form-label col-md-4">Correo electrónico: </label>
                            <div class="col-md-8">
                                <input type="email" name="email" class="form-control" id="email" placeholder="ej. Juan@gmail.com" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['email'];
                                                                                                                                             } ?>"/>
                            </div>
                        </div>

                        <?php
                        if (isset($data['registry'])) {
                        ?>

                            <div class="row form-group">
                                <label for="password" class="col-form-label col-md-4">Contraseña: </label>
                                <div class="col-md-8">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Mínimo 8 caracteres" required value="<?php if (isset($data['info_user'])) {
                                                                                                                                                    echo $data['info_user']['password'];
                                                                                                                                                } ?>"/>
                                    <small id="passwordHelp" class="form-text text-muted">Consejos: Introduzca una contraseña de al menos 10 caracteres e incluya caracteres especiales, mayúsculas y minúsculas.</small>
                                </div>
                            </div>
                       
                        <div class="row form-group">
                            <label for="motivo" class="col-form-label col-md-4">Motivo de consulta: </label>
                            <div class="col-md-8">
                                <textarea rows="3" type="motivo" name="motivo" class="form-control" id="motivo" placeholder="Escriba aquí todo lo pertinente a su motivo de consulta"><?php if (isset($data['info_user'])) { echo $data['info_user']['motivo'];} ?></textarea>
                                <small id="emailHelp" class="form-text text-muted">(Opcional)</small>
                            </div>
                        </div>

                        <?php
                        }
                        ?>
                        
                        <button type="submit" name="action" class="btn btn-primary btn-block"><?php echo isset($data['registry']) ? 'Registro' : 'Editar'; ?></button>
                    </form>


                </div>
            </div>


        <?php
        } else if (isset($data['profile'])) {
        ?>


            <div class="card card-message mb-3">
                <h2 class="card-header">Mis datos</h2>
                <div class="row no-gutters">

                    <div class="col-md-9">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Nombre</td>
                                                <td><?php echo $data['info_user']['nombre'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Apellidos</td>
                                                <td><?php echo $data['info_user']['apellidos'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $data['info_user']['email'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ciudad</td>
                                                <td><?php echo $data['info_user']['ciudad'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Direccion</td>
                                                <td><?php echo $data['info_user']['direccion'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Codigo postal</td>
                                                <td><?php echo $data['info_user']['cp'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Telefono</td>
                                                <td><?php echo $data['info_user']['tfno'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Fecha nacimiento</td>
                                                <td><?php echo $data['info_user']['fechanac'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-left">

                                    <?php
                                      if ($data['info_user']['rol'] == 1) {
                                    ?>
                                        <a class="btn btn-success btn-icon" href="index.php?url=CitasController/display_admin_citas/">
                                            <i class="fa fa-eye" aria-hidden="true"></i> Gestionar citas
                                        </a>
                                    <?php
                                      }
                                    ?>
                                
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/display_edit_profile/">
                                        <i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil
                                    </a>
                                    <a class="btn btn-success btn-icon" href="index.php?url=UserController/edit_password/">
                                        <i class="fa fa-key" aria-hidden="true"></i></i> Cambiar contraseña
                                    </a>
                                    <a class="btn btn-danger btn-icon" href="index.php?url=UserController/display_remove/">
                                        <i class="fa fa-user-times" aria-hidden="true"></i> Eliminar cuenta
                                    </a>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php
        } else if (isset($data['change_password'])) {

        ?>

            <form action="index.php?url=UserController/change_password/" method="POST">

                <?php
                if (isset($data['user_key'])) {
                ?>
                    <input type="hidden" name="user_key" value="<?php echo $data['user_key']; ?>">
                <?php
                }
                ?>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="pass">Nueva contraseña</label>
                        <input type="password" id="password" name="pass" class="form-control" maxlength="20" />

                    </div>

                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <label for="confirm-pass">Confirmar contraseña</label>
                        <input type="password" name="confirm-pass" class="form-control" id="confirm-pass" maxlength="20" />
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
                    </div>
                </div>

            </form>


        <?php

        } else if (isset($data['display_remove'])) {
        ?>

            <div class="row">
                <div class="col-12">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="font-weight-normal">¿Está seguro de que desea eliminar su cuenta? Si la elimina ya no podrá iniciar sesión con este usuario.</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-success btn-icon" href="index.php?url=UserController/remove/">
                                <i class="fa fa-check" aria-hidden="true"></i> Si
                            </a>
                            <a class="btn btn-danger btn-icon" href="index.php?url=UserController/no_remove/">
                                <i class="fa fa-times" aria-hidden="true"></i> No
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        <?php
        } 
        ?>

    </div>
</div>

<?php

include_once 'footer.php';

?>
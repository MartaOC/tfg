<?php
require_once 'header.php'
?>


<div class="col-md-10 col-12 p-4">

    <div class="row">
        <div class="col-12">
            <?php include_once 'show-info-message.php'; ?>
        </div>
    </div>

    <?php if (isset($data['display_admin_citas'])) {
    ?>

        <h1 class="font-weight-light">Gestionar citas</h1><hr><br>
        <div class="row">
            <div class="col-12">

                <?php
                if (count($data['citas']) > 0) {
                ?>

                    <table class="table table-responsive table-hover">

                        <tr>
                            <th>Nombre</th>
                            <th>Fecha propuesta</th>
                            <th>Teléfono de contacto</th>
                            <th>Correo electrónico</th>
                            <th></th>
                        </tr>
                        <?php

                        foreach ($data['citas'] as $key => $value) {

                        ?>
                            <tr>
                                <td><?php echo $value['nombre_paciente'] . ' ' . $value['apellidos_paciente']; ?></td>
                                <td><?php echo $value['fechahora']; ?></td>
                                <td><?php echo $value['tfno']; ?></td>
                                <td><?php echo $value['email_paciente']; ?></td>

                                <td>
                                    <a class="btn btn-success btn-icon" href="index.php?url=CitasController/confirm/<?php echo $value['id_cita'] ?>">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-icon" href="index.php?url=CitasController/deny/<?php echo $value['id_cita'] ?>">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </a>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php
                } else {
                ?>
                    <p>No hay citas pendientes de confirmar.</p>

                <?php
                }
                ?>

            </div>
        </div>

    <?php
    } else if (isset($data['display_citas_user'])) {
    ?>

        <div class="row">
            <div class="col-12">




                <?php if (isset($data['isAdmin']) && $data['isAdmin'] == TRUE) {
                ?>


                    <div class="row">
                        <div class="col-12">

                            <?php
                            if (count($data['citas']) > 0) {
                            ?>
                                <h1 class="font-weight-light">Mis citas</h1><br>
                                <table class="table table-responsive table-hover">

                                    <tr>
                                        <th>Nombre</th>
                                        <th>Próxima sesión</th>
                                        <th>Teléfono de contacto </th>
                                        <th>Correo electrónico</th>
                                        <th>Motivo</th>
                                    </tr>
                                    <?php

                                    foreach ($data['citas'] as $key => $value) {

                                    ?>
                                        <tr>
                                            <td><?php echo $value['nombre_paciente'] . ' ' . $value['apellidos_paciente']; ?></td>
                                            <td><?php echo $value['fechahora']; ?></td>
                                            <td><?php echo $value['tfno']; ?></td>
                                            <td><?php echo $value['email_paciente']; ?></td>
                                            <td><?php echo $value['motivo_paciente']; ?></td>

                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            <?php
                            } else {
                            ?>
                                <h4 class="font-weight-light">No hay citas programadas. </h4>

                            <?php
                            }
                            ?>

                        </div>
                    </div>

                <?php
                } else {
                ?>



                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (count($data['citas']) > 0) {
                            ?>
                                <h1 class="font-weight-light">Mis citas</h1><hr>

                                <table class="table table-responsive table-hover">

                                    <tr>
                                        <th>Próximas citas programadas</th>
                                    </tr>
                                    <?php

                                    foreach ($data['citas'] as $key => $value) {

                                    ?>
                                        <tr>
                                            <td><?php echo $value['fechahora']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    <p class="text-danger">Para la cancelación de la sesión envíe un correo a <a href="mailto:">alicia.oltra.camas@gmail.com</a></p>
                                </table>

                            <?php
                            } else {
                            ?>
                                <h1 class="font-weight-light">Mis citas</h1><hr>
                                <p>No hay citas confirmadas.<br><br> Si ya ha mandado su solicitud de cita, espere a que sea confirmada.</p>
                                <p class="text-danger">Si su cita no ha sido confirmada en 24h, significa que no ha sido aprobada por el psicólogo. Y deberá solicitar otra fecha, o ponerse en contacto con el psicólogo. </p>
                                <div class="row">

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                        <div class="col-12">
                            <a class="btn btn-primary btn-block" href="index.php?url=CitasController/display_citas_user_form">Solicitar cita</a>
                        </div>
                    </div>
                <?php
                } ?>




            </div>
        </div>


    <?php
    } else if (isset($data['display_citas_user_form'])) {
    ?>

        <div class="row">
            <div class="col-8">

                <form action="index.php?url=CitasController/aniadir_cita" method="POST">
                    <h1 class="font-weight-light">Solicitar cita</h1><hr>
                    <p>Seleccione el día y la hora que desee para su cita. Debe consultar los huecos libres en la agenda de la derecha.</p>
                    <p><b>Debe solicitar la cita entre las 9:00 - 14:00 o las 16:00 - 20:00</b>, de acuerdo a nuestro horario de trabajo.</p>
                    <p><b>Las citas para el mismo día no serán procesadas</b>, deberá programarla con un margen de 24h.</p>
                    <p class="text-danger small pt-0 mt-0">Recuerde que no trabajamos en días festivos.</p>
                    <div class="row form-group">

                        <label for="nombre" class="col-form-label col-md-4">Fecha: </label>
                        <div class="col-md-8">
                            <input type="datetime-local" name="fecha" class="form-control" id="cita" min="09:00" max="20:00" step="3600" />
                        </div>
                        <hr>
                        <div class="col-md-8">
                            <button type="submit " class="btn btn-primary">Solicitar <i class="fa fa-calendar"></i></button>
                        </div>

                    </div>
                </form>

            </div>

            <div class="col-4">
                <iframe src="https://calendar.google.com/calendar/embed?height=500&amp;wkst=1&amp;bgcolor=%23039BE5&amp;ctz=Europe%2FMadrid&amp;src=c2Rwb2F2bGExM2JxcnQ3ZHYxNTR1YnU4dDRAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&amp;color=%23616161&amp;showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;mode=WEEK" style="border:solid 1px #777" width="500" height="500" frameborder="0" scrolling="no"></iframe>
            </div>
        </div>




    <?php
    }
    ?>

</div>

<?php
require_once 'footer.php';
?>
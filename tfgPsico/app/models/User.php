<?php

class User
{

    function __construct()
    {
    }
    //comprobaciones cambio de contraseña
    function checkPass($params, &$errors)
    {

        if ($params['pass'] !== $params['confirm-pass']) {
            array_push($errors, "Las contraseñas no coinciden.");
        }
        if (empty($params['pass'])) {
            array_push($errors, "Por favor, introduzca una contraseña.");
        }
    }

    function get_all_info_user($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "SELECT id, nombre, apellidos, direccion, ciudad, cp, DATE_FORMAT(fechanac, '%d/%m/%Y') as fechanac, tfno, email, password, motivo, rol ";
            $sql .= "FROM usuarios ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['id_user']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/get_all_info_user", $sql);
                writeLog(INFO_LOG, "User/get_all_info_user", json_encode($paramsDB));
            }

            $data['info_user'] = $db->getDataSinglePrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/get_all_info_user", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function registry($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            $id_user = $db->getLastId("id", "usuarios");

            $sql = "INSERT INTO usuarios VALUES(?,?,?,?,?,?,?,?,?,?,?,0)";

            $paramsDB = array(
                $id_user,
                $params['nombre'],
                $params['apellidos'],
                $params['direccion'],
                $params['ciudad'],
                $params['cp'],
                $params['date'],
                $params['tel'],
                $params['email'],
                hash_hmac("sha512", $params['password'], "tfgPsico"),
                $params['motivo']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/registry", $sql);
                writeLog(INFO_LOG, "User/registry", json_encode($paramsDB));
            }

            $success = $db->executeInstructionPrepared($sql, $paramsDB);

            $data['success'] = $success;
            $data['text-center'] = true;

            if ($success) {
                $data['message'] = "Su registro se ha completado con éxito. Pulse <a href='/tfgPsico/'>aquí</a> para volver al inicio.";
            } else {
                $data['message'] = "Su registro no se ha realizado con éxito.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();
        return $data;
    }

    function edit_profile($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;

        $paramsDB = array();

        try {

            $sql = "UPDATE usuarios ";
            $sql .= "SET nombre = ?, ";
            $sql .= "apellidos = ?, ";
            $sql .= "ciudad = ?, ";
            $sql .= "email = ?, ";
            $sql .= "direccion = ?, ";
            $sql .= "cp = ?, ";
            $sql .= "tfno = ?, ";
            $sql .= "fechanac = ? ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['nombre'],
                $params['apellidos'],
                $params['ciudad'],
                $params['email'],
                $params['direccion'],
                $params['cp'],
                $params['tel'],
                $params['date'],
                $params['id_user']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/edit_profile", $sql);
                writeLog(INFO_LOG, "User/edit_profile", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            $data['text-center'] = true;
            if ($data['success']) {
                $data['message'] = "La edición se ha completado con éxito. Pulse <a href='/tfgPsico/'>aquí</a> para volver al inicio.";

                $data['user'] = array(
                    'id' => $params['id_user'],
                    'nombre' => $params['nombre'],
                    'rol' => $params['rol']
                );
                prepareDataLogin($data['user']);
            } else {
                $data['message'] = "La edición no se ha realizado con éxito. Contacte con el administrador.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }
//cambiar contraseña
    function change_password($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();



        try {


            $sql = "UPDATE usuarios ";
            $sql .= "SET password = ? ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                hash_hmac("sha512", $params['pass'], HASH_PASS_KEY),
                $params['id_user']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/change_password", $sql);
                writeLog(INFO_LOG, "User/change_password", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);


            $data['text-center'] = true;
            if ($data['success']) {
                $data['message'] = "Su contraseña ha sido cambiada con éxito. Pulse <a href='/tfgPsico/'>aquí</a> para volver al inicio.";
            } else {
                $data['message'] = "Su contraseña no ha podido ser cambiada.";
            }
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/change_password", $e->getMessage());
        }

        $db->close();
        return $data;
    }

//borrar perfil
    function remove($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "delete from usuarios WHERE id = ? ";

            $paramsDB = array(
                $params['id_user']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "User/remove", $sql);
                writeLog(INFO_LOG, "User/remove", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/remove", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}

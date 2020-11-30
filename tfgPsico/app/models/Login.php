<?php

class Login
{

    function __construct()
    {
    }

    function checkLogin($params)
    {

        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            if (empty($params['email']) && empty($params['pass'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Usuario/email y contraseña requeridos";
            } elseif (empty($params['email'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Usuario/email requerido";
            } elseif (empty($params['pass'])) {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = "Contraseña requerida";
            } else {

                $sql = "SELECT id, nombre, rol ";
                $sql .= "FROM usuarios ";
                $sql .= "WHERE email = ? AND ";
                $sql .= "password = ? ";

                $paramsDB = array(
                    strtolower($params['email']),
                    hash_hmac("sha512", $params['pass'], HASH_PASS_KEY)
                );

                if (isModeDebug()) {
                    writeLog(INFO_LOG, "Login/checkLogin", $sql);
                    writeLog(INFO_LOG, "Login/checkLogin", json_encode($paramsDB));
                }

                $data = $db->getDataSinglePrepared($sql, $paramsDB);

                if ($db->numRowsPrepared($sql, $paramsDB) > 0) {
                    $data['success'] = true;
                    $data['user'] = array('id' => $data['id'], 'nombre' => $data['nombre'], 'rol' => $data['rol']);
                } else {
                    $data['show_message_info'] = true;
                    $data['success'] = false;
                    $data['message'] = "Usuario/email o contraseña incorrectos";
                }
            }
        } catch (Exception $e) {
            $data['show_message_info'] = true;
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "Login/checkLogin", $e->getMessage());
        }

        $db->close();
        return $data;
    }
}

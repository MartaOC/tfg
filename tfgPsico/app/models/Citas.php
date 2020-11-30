<?php

class Citas
{

    function __construct()
    {
    }

    function citas_no_confirmadas()
    {


        $db = new PDODB();
        $data = array();
        $paramsDB = array();

        try {

            $sql = "SELECT c.id as id_cita, DATE_FORMAT(c.fechahora, '%d/%m/%Y %T') as fechahora, u.id as id_paciente, ";
            $sql .= "u.tfno, u.nombre as nombre_paciente, ";
            $sql .= "u.apellidos as apellidos_paciente, u.email as email_paciente ";
            $sql .= "FROM citas c, usuarios u ";
            $sql .= "WHERE c.id_user = u.id ";
            $sql .= "AND c.confirmado = 0 AND c.fechahora >= SYSDATE() ";
            $sql .= "ORDER BY c.fechahora ";

            $paramsDB = array();

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", $sql);
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", json_encode($paramsDB));
            }

            $data = $db->getDataPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }


    function citas_confirmadas($params)
    {


        $db = new PDODB();
        $data = array();

        $paramsDB = array();

        try {

            writeLog(INFO_LOG, "Citas/citas_no_confirmadas", json_encode($params));
            if($params["isAdmin"] == TRUE){
                 $sql = "SELECT c.id as id_cita, DATE_FORMAT(c.fechahora, '%d/%m/%Y %T') as fechahora, u.id as id_paciente, ";
                 $sql .= "u.tfno, u.nombre as nombre_paciente, ";
                 $sql .= "u.apellidos as apellidos_paciente, u.email as email_paciente, u.motivo as motivo_paciente ";
                 $sql .= "FROM citas c, usuarios u ";
                 $sql .= "WHERE c.id_user = u.id ";
                 $sql .= "AND c.confirmado = 1 AND c.fechahora >= SYSDATE() ";
                 $sql .= "ORDER BY c.fechahora ";

                $paramsDB = array();

            }else{

                $sql = "SELECT c.id as id_cita, DATE_FORMAT(c.fechahora, '%d/%m/%Y %T') as fechahora ";
                $sql .= "FROM citas c, usuarios u ";
                $sql .= "WHERE c.id_user = u.id ";
                $sql .= "AND u.id = ? ";
                $sql .= "AND c.confirmado = 1 ";
                $sql .= "AND c.fechahora >= SYSDATE() ";
                $sql .= "ORDER BY c.fechahora ";

                $paramsDB = array(
                    $params["id_user"]
                );

            }
           
            if (isModeDebug()) {
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", $sql);
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", json_encode($paramsDB));
            }

            $data = $db->getDataPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function confirm($params)
    {

        $db = new PDODB();
        $data = array();

        $paramsDB = array();

        try {

            $sql = "UPDATE citas SET ";
            $sql .= "confirmado = 1 ";
            $sql .= "WHERE id = ? ";

            $paramsDB = array(
                $params['id_cita']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", $sql);
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function deny($params)
    {

        $db = new PDODB();
        $data = array();

        $paramsDB = array();

        try {

            $sql = "DELETE FROM citas WHERE id = ? ";

            $paramsDB = array(
                $params['id_cita']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", $sql);
                writeLog(INFO_LOG, "Citas/citas_no_confirmadas", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);
        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }

    function aniadir_cita($params)
    {

        $db = new PDODB();
        $data = array();
        $data['show_message_info'] = true;
        $paramsDB = array();

        try {

            $id_cita_new = $db->getLastId("id", "citas");

            $sql = "INSERT INTO citas VALUES (?, ?, ?, 0) ";

            $paramsDB = array(
                $id_cita_new,
                $params['id_user'],
                $params['fecha']
            );

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Citas/aniadir_cita", $sql);
                writeLog(INFO_LOG, "Citas/aniadir_cita", json_encode($paramsDB));
            }

            $data['success'] = $db->executeInstructionPrepared($sql, $paramsDB);

            if($data['success']){
                $url=PAGE_URL.'index.php?url=CitasController/display_citas_user/';
                $data['message'] = "La solicitud de su cita ha sido enviada con éxito, una vez aprobada aparecerá en su tablón de citas. Pincha <a href='$url'>aquí</a> para volver a sus citas";
            }else{
                $data['message'] = "La solicitud de su cita no ha sido tramitada. Vuelva a intentarlo en otro momento..";
            }

        } catch (Exception $e) {
            $data['success'] = false;
            $data['message'] = ERROR_GENERAL;
            writeLog(ERROR_LOG, "User/registry", $e->getMessage());
        }

        $db->close();

        return $data;
    }
}

<?php

class UserController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("User");
    }

    function display()
    {
        $data['registry'] = true;

        $this->view("UserView", $data);
    }
//datos usuario
    function display_profile()
    {

        isLogged();

        $data = array();

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->get_all_info_user($params);

        $data['profile'] = true;

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/display_profile", json_encode($data));
        }

        $this->view("UserView", $data);
    }
//formulario modificar datos
    function display_edit_profile()
    {

        isLogged();

        $data = array();

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->get_all_info_user($params);

        $data['edit_profile'] = true;

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/display_edit_profile", json_encode($data));
        }

        $this->view("UserView", $data);
    }
//modificar datos
    function edit_profile()
    {

        isLogged();

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'direccion' => $_POST['direccion'],
                'ciudad' => $_POST['ciudad'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'cp' => $_POST['cp'],
                'date' => $_POST['date'],
                'tel' => $_POST['tel'],
                'motivo' => $_POST['motivo'],
                'id_user' => $_POST['id_user']
            );

            $data = $this->model->edit_profile($params);


            if (isModeDebug()) {
                writeLog(INFO_LOG, "UserController/edit_profile", json_encode($data));
            }

            $this->view("UserView", $data);
        }
    }
//vista cambiar contraseña
    function edit_password($userKey = null)
    {

        if (!isset($userKey)) {
            isLogged();
        }

        $data = array(
            'user_key' => $userKey
        );

        $data['change_password'] = true;

        $this->view("UserView", $data);
    }
//registro
    function registrer()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'nombre' => $_POST['nombre'],
                'apellidos' => $_POST['apellidos'],
                'direccion' => $_POST['direccion'],
                'ciudad' => $_POST['ciudad'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'cp' => $_POST['cp'],
                'date' => $_POST['date'],
                'tel' => $_POST['tel'],
                'motivo' => $_POST['motivo']
            );

            $data = $this->model->registry($params);

            if (isModeDebug()) {
                writeLog(INFO_LOG, "UserController/registrer", json_encode($data));
            }

            $this->view("UserView", $data);
        }
    }
//cambiar contraseña
    function change_password()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'pass' => $_POST['pass'],
                'confirm-pass' => $_POST['confirm-pass']
            );

            $errors = array();

            $this->model->checkPass($params, $errors);

            // Si no hay errores, muestro el mensaje
            if (count($errors) === 0) {

                $session = new Session();


                $params = array(
                    'id_user' => $session->getAttribute(SESSION_ID_USER),
                    'pass' => $_POST['pass']
                );


                $data = $this->model->change_password($params);
            } else {
                $data['show_message_info'] = true;
                $data['success'] = false;
                $data['message'] = $errors;
                $data['change_password'] = true;
            }

            if (isModeDebug()) {
                writeLog(INFO_LOG, "UserController/change_password", json_encode($data));
            }

            $this->view("UserView", $data);
        }
    }
// cerrar sesion
    function logout()
    {
        $session = new Session();
        $session->destroySession();
        redirect_to_url(BASE_URL);
    }
//eliminar cuenta vista
    function display_remove()
    {
        $data = array();
        $data['display_remove'] = true;
        $this->view("UserView", $data);
    }
//eliminar
    function remove()
    {

        isLogged();

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER)
        );

        $data = $this->model->remove($params);

        if (isModeDebug()) {
            writeLog(INFO_LOG, "UserController/remove", json_encode($data));
        }

        if ($data['success']) {
            $session->destroySession();
            redirect_to_url(BASE_URL);
        }
    }

    //no eliminar

    function no_remove()
    {
        header("Location: index.php?url=UserController/display_profile/");
    }
}

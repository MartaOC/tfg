<?php

class LoginController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Login");
    }
//vista login
    function display()
    {
        $data = array();

        $data['display_login'] = true;

        $this->view("LoginView", $data);
    }
//login
    function login()
    {

        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $data = array();

            $params = array(
                'email' => $_POST['email'],
                'pass' => $_POST['pass']
            );

            $data = $this->model->checkLogin($params);

            if (isModeDebug()) {
                writeLog(INFO_LOG, "Login/login", json_encode($data));
            }

            if ($data['success']) {
                if ($data['user']) {
                    prepareDataLogin($data['user']);
                }
                redirect_to_url(BASE_URL);
            } else {
                $this->view("LoginView", $data);
            }
        }
    }
}

<?php


class CitasController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Citas");
    }
//citas admin sin confirmar
    function display_admin_citas()
    {
        $data = array();

        $data['display_admin_citas'] = true;

        $data['citas'] = $this->model->citas_no_confirmadas();

        $this->view("CitasView", $data);
    }
//citas confirmadas
    function display_citas_user()
    {
        $data = array();

        $data['display_citas_user'] = true;

        $session = new Session();

        $params = array(
            'id_user' => $session->getAttribute(SESSION_ID_USER),
            'isAdmin' => $session->getAttribute('isAdmin')
        );

        $data['citas'] = $this->model->citas_confirmadas($params);

        $data['isAdmin'] = $params['isAdmin'];

        $this->view("CitasView", $data);
    }
//vista pedir cita
    function display_citas_user_form()
    {
        $data = array();

        $data['display_citas_user_form'] = true;

        $this->view("CitasView", $data);
    }
//confirmar cita admin
    function confirm($id_cita)
    {

        $data = array();

        $data['display_admin_citas'] = true;

        $params = array(
            'id_cita' => $id_cita
        );

        $this->model->confirm($params);

        $this->display_admin_citas();
    }
//denegar cita admin
    function deny($id_cita)
    {

        $data = array();

        $data['display_admin_citas'] = true;

        $params = array(
            'id_cita' => $id_cita
        );

        $this->model->deny($params);

        $this->display_admin_citas();
    }
//solicitar cita usuario
    function aniadir_cita()
    {


        if (isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $session = new Session();
            $params = array(
                'id_user' => $session->getAttribute(SESSION_ID_USER),
                'fecha' => $_POST['fecha']
            );

            $data = $this->model->aniadir_cita($params);

            $this->view("CitasView", $data);
        }
    }
}

<?php

class HomeController extends Controller
{

    private $model;

    function __construct()
    {
        $this->model = $this->model("Home");
    }
//vista home
    function display()
    {
        $data = array();


        $this->view("HomeView", $data);
    }

}

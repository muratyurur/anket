<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "dashboard_v";
        $this->load->model("dashboard_model");

        if (!get_active_user())
            redirect(base_url("login"));
    }

    public function index()
    {
        $viewData = new stdClass();

        $this->session->unset_userdata("where");

        $user = $this->session->userdata("user");

        $viewData->counts = $this->dashboard_model->get_towncount();
        $viewData->durums = $this->dashboard_model->get_durumcount();
        $viewData->mdurums = $this->dashboard_model->get_mdurumcount();
        $viewData->topdurums = $this->dashboard_model->get_topdurumcount();
        $viewData->tuzlakarts = $this->dashboard_model->get_tuzlakartcount();
        $viewData->mtuzlakarts = $this->dashboard_model->get_mtuzlakartcount();
        $viewData->toptuzlakarts = $this->dashboard_model->get_toptuzlakartcount();
        $viewData->memnuniyets = $this->dashboard_model->get_memnuniyetcount();
        $viewData->mmemnuniyets = $this->dashboard_model->get_mmemnuniyetcount();
        $viewData->topmemnuniyets = $this->dashboard_model->get_topmemnuniyetcount();
        $viewData->mudurluktaleps = $this->dashboard_model->get_mudurluktalepcount();
        $viewData->mahalletaleps = $this->dashboard_model->get_mahalletalepcount();
        $viewData->tasks = $this->dashboard_model->get_tasks(
            array(
                "tarih" => date("Y-m-d"),
                "ekip" => $user->ekip_id
            )
        );

        $datetime = new DateTime('tomorrow');

        $viewData->tomorrow = new DateTime('tomorrow');

        $viewData->tomorrow_tasks = $this->dashboard_model->get_tasks(
            array(
                "tarih" => $datetime->format('Y-m-d'),
                "ekip" => $user->ekip_id
            )
        );

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }
}

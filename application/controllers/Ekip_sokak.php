<?php

class Ekip_sokak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "ekip_sokak_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("ekip_sokak_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
        $this->load->model("ekip_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER']))
        {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "ekip_sokak");

            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();

        $var = $this->input->post("tarih");

        $get_tarih = str_replace('/', '-', $var);

        $tarih = date('Y-m-d', strtotime($get_tarih));

        if ($this->input->post('tarih')) {
            $where['tarih'] = $tarih;
            $viewData->set_tarih = $this->input->post("tarih");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sokak')) {
            $where['sokak'] = $this->input->post("sokak");
            $viewData->set_sokak = $this->input->post("sokak");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('ekip')) {
            $where['ekip'] = $this->input->post("ekip");
            $viewData->set_ekip = $this->input->post("ekip");
            $this->session->set_userdata("where", $where);
        }

        $condition = $this->session->userdata("where");

        $this->load->library("pagination");

        $config["base_url"] = base_url("ekip_sokak/index");
        $config["total_rows"] = $this->ekip_sokak_model->get_count($condition ? $condition : "1=1");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";


        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->ekip_sokak_model->get_records(
            $condition ? $condition : "1=1",
            $config["per_page"],
            $page,
            "tarih, ekip, sokak"
        );


        $viewData->count = $config["total_rows"];

        /** Taking all streets in town */
        $viewData->towns = $this->mahalle_model->get_all();

        /** Taking all streets in town */
        $viewData->streets = $this->sokak_model->get_all();

        /** Taking all departments */
        $viewData->teams = $this->ekip_model->get_all();

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function clear_session()
    {
        $this->session->unset_userdata("where");
        redirect(base_url("ekip-gorev"));
    }

    public function new_form()
    {
        $viewData = new stdClass();

        $this->load->model("user_role_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
        $this->load->model("ekip_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** Taking all towns */
        $viewData->towns = $this->mahalle_model->get_all();

        /** Taking all streets in town */
        $viewData->streets = $this->sokak_model->get_all();

        /** Taking all departments */
        $viewData->teams = $this->ekip_model->get_all();

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save()
    {
        $user = $this->session->userdata("user");

        /** Load Form Validation Library */
        $this->load->library("form_validation");

        /** Validation Rules */
        $this->form_validation->set_rules("tarih", "Tarih", "trim|required");
        $this->form_validation->set_rules("ekip", "Ekip", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");

        /** Translate Validation Messages */
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> alanı boş bırakılamaz..."
            )
        );

        /** Run Form Validation */
        $validate = $this->form_validation->run();

        /** If Validation Successful */
        if ($validate) {
            /** Start Insert Statement */

            $var = $this->input->post("tarih");

            $get_tarih = str_replace('/', '-', $var);

            $tarih = date('Y-m-d', strtotime($get_tarih));

            $insert = $this->ekip_sokak_model->add(
                array(
                    "tarih" => $tarih,
                    "ekip" => $this->input->post("ekip"),
                    "mahalle" => $this->input->post("mahalle"),
                    "sokak" => $this->input->post("sokak"),
                    "createdAt" => date("Y-m-d H:i:s"),
                    "createdBy" => $user->id
                )
            );

            /** If Insert Statement Succesful */
            if ($insert) {

                /** Set the notification is Success */
                $alert = array(
                    "type" => "success",
                    "title" => "İşlem Başarılı",
                    "text" => "Görevlendirme kaydı başarılı bir şekilde eklendi.."
                );

                $this->session->set_flashdata("alert", $alert);

                /** Redirect to Module's Add New Page */
                redirect(base_url("ekip_sokak"));

                die();

                /** If Insert Statement Unsuccessful */
            } else {

                /** Set the notification is Error */
                $alert = array(
                    "type" => "error",
                    "title" => "İşlem Başarısız",
                    "text" => "Görevlendirme kayıt işlemi esnasında bir sorun oluştu.."
                );

                $this->session->set_flashdata("alert", $alert);

                /** Reload View and Show Error Messages Below the Inputs */
                $viewData = new stdClass();

                /** Taking all towns */
                $viewData->towns = $this->mahalle_model->get_all();

                /** Taking all streets in town */
                $viewData->streets = $this->sokak_model->get_all();

                /** Taking all departments */
                $viewData->teams = $this->ekip_model->get_all();

                /** Defining data to be sent to view */
                $viewData->viewFolder = $this->viewFolder;
                $viewData->subViewFolder = "add";
                $viewData->form_error = true;

                /** Reload View */
                $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

                die();

            }

            /** Reload View and Show Error Messages Below the Inputs */
            $viewData = new stdClass();

            /** Taking all towns */
            $viewData->towns = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->streets = $this->sokak_model->get_all();

            /** Taking all teams */
            $viewData->teams = $this->ekip_model->get_all();

            /** Defining data to be sent to view */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            /** Reload View */
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

            die();

            /** If Validation Unsuccessful */
        } else {
            /** Reload View and Show Error Messages Below the Inputs */
            $viewData = new stdClass();

            /** Taking all towns */
            $viewData->towns = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->streets = $this->sokak_model->get_all();

            /** Taking all departments */
            $viewData->teams = $this->ekip_model->get_all();

            /** Defining data to be sent to view */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;

            /** Reload View */
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

    }

    public function update_form($id)
    {
        $viewData = new stdClass();

        $this->load->model("user_role_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
        $this->load->model("ekip_model");
        $this->load->model("ekip_sokak_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $item = $this->ekip_sokak_model->get(
            array(
                "id"    => $id
            )
        );

        /** Taking all towns */
        $viewData->towns = $this->mahalle_model->get_all();

        /** Taking all streets in town */
        $viewData->streets = $this->sokak_model->get_all();

        /** Taking all departments */
        $viewData->teams = $this->ekip_model->get_all();

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item= $item;

        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $user = $this->session->userdata("user");

        /** Load Form Validation Library */
        $this->load->library("form_validation");

        /** Validation Rules */
        $this->form_validation->set_rules("tarih", "Tarih", "trim|required");
        $this->form_validation->set_rules("ekip", "Ekip", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");

        /** Translate Validation Messages */
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> alanı boş bırakılamaz..."
            )
        );

        /** Run Form Validation */
        $validate = $this->form_validation->run();

        /** If Validation Successful */
        if ($validate) {

            $viewData = new stdClass();

            $this->load->model("user_role_model");

            $viewData->roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** Start Update Statement */
            $var = $this->input->post("tarih");

            $get_tarih = str_replace('/', '-', $var);

            $tarih = date('Y-m-d', strtotime($get_tarih));

            $data = array(
                "tarih" => $tarih,
                "ekip" => $this->input->post("ekip"),
                "mahalle" => $this->input->post("mahalle"),
                "sokak" => $this->input->post("sokak"),
                "updatedAt" => date("Y-m-d H:i:s"),
                "updatedBy" => $user->id
            );

            $update = $this->ekip_sokak_model->update(array("id" => $id), $data);

            $item = $this->ekip_sokak_model->get(
                array(
                    "id" => $id
                )
            );

            /** Defining data to be sent to view */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;

            /** If Update Statement Succesful */
            if ($update) {

                /** Set the notification is Success */
                $alert = array(
                    "type" => "success",
                    "title" => "İşlem Başarılı",
                    "text" => "Kayıt başarılı bir şekilde güncellendi.."
                );

                /** If Update Statement Unsuccessful */
            } else {

                /** Set the notification is Error */
                $alert = array(
                    "type" => "error",
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt güncelleme işlemi esnasında bir sorun oluştu.."
                );

            }

            $this->session->set_flashdata("alert", $alert);

            /** Taking all towns */
            $viewData->towns = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->streets = $this->sokak_model->get_all();

            /** Taking all teams */
            $viewData->teams = $this->ekip_model->get_all();


            /** Taking the specific row's data from the table */
            $viewData->item = $this->ekip_sokak_model->get(
                array(
                    "id" => $id
                )
            );

            /** Reload View */
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

            /** If Validation Unsuccessful */

        } else {
            /** Reload View and Show Error Messages Below the Inputs */
            $viewData = new stdClass();

            $this->load->model("user_role_model");

            $viewData->roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** Taking all towns */
            $viewData->towns = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->streets = $this->sokak_model->get_all();

            /** Taking all teams */
            $viewData->teams = $this->ekip_model->get_all();


            /** Taking the specific row's data from the table */
            $item = $this->ekip_sokak_model->get(
                array(
                    "id" => $id
                )
            );

            /** Defining data to be sent to view */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;

            /** Reload View */
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        /** Taking the specific row's data from user_roless table */
        $item = $this->ekip_sokak_model->get(
            array(
                "id" => $id
            )
        );
        /** Starting Delete Statement */
        $delete = $this->ekip_sokak_model->delete(
            array(
                "id" => $id
            )
        );

        /** If Delete Statement is Succesful */
        if ($delete) {

            /** Set the notification is Success */
            $alert = array(
                "type" => "success",
                "title" => "İşlem Başarılı",
                "text" => "Kayıt başarılı bir şekilde silindi.."
            );

            /** If Delete Statement is Unsuccessful */
        } else {

            /** Set the notification is Error */
            $alert = array(
                "type" => "error",
                "title" => "İşlem Başarısız",
                "text" => "Kayıt silme işlemi esnasında bir sorun oluştu.."
            );

        }

        $this->session->set_flashdata("alert", $alert);

        /** Redirect to Module's List Page */
        redirect(base_url("ekip_sokak"));
    }
}
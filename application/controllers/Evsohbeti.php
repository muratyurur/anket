<?php

class Evsohbeti extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "evsohbeti_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("evsohbeti_model");
        $this->load->model("sokak_model");
        $this->load->model("mahalle_model");
        $this->load->model("hatip_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "evsohbeti");
            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();

        if ($this->input->post('ilktarih')) {
            $var = $this->input->post("ilktarih");

            $ilktar = str_replace('/', '-', $var);

            $ilktarih = date('Y-m-d', strtotime($ilktar));

            $where['tarih >='] = $ilktarih;
            $viewData->set_ilktarih = $this->input->post("ilktarih");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sontarih')) {
            $var = $this->input->post("sontarih");

            $sontar = str_replace('/', '-', $var);

            $sontarih = date('Y-m-d', strtotime($sontar));

            $where['tarih <='] = $sontarih;
            $viewData->set_sontarih = $this->input->post("sontarih");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sokak')) {
            $where['sokak'] = $this->input->post("sokak");
            $viewData->set_sokak = $this->input->post("sokak");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('hatip')) {
            $where['hatip'] = $this->input->post("hatip");
            $viewData->set_hatip = $this->input->post("hatip");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where", $where);
        }

        $condition = $this->session->userdata("where");


        $this->load->library("pagination");

        $config["base_url"] = base_url("evsohbeti/index");
        $config["total_rows"] = $this->evsohbeti_model->get_count($condition ? $condition : "1=1");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";

        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->evsohbeti_model->get_records(
            $condition ? $condition : "1=1",
            $config["per_page"],
            $page,
            "tarih DESC"
        );

        $viewData->count = $config["total_rows"];

        if ($this->input->post("mahalle")) {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(
                array(
                    "mahalle_id" => $this->input->post("mahalle")
                ), "tanim ASC");
        } else {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");
        }

        /** Taking all towns in the place */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all town */
        $viewData->mahalle = $this->mahalle_model->get_all();

        /** Taking all speakers */
        $viewData->hatips = $this->hatip_model->get_all(array(), "adisoyadi ASC");

        /** Taking all streets in town */
        if ($this->input->post("mahalle")) {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(
                array(
                    "mahalle_id" => $this->input->post("mahalle")
                ), "tanim ASC");
        } else {
            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");
        }

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
        redirect(base_url("evsohbeti"));
    }

    public function new_form()
    {
        $viewData = new stdClass();

        $this->load->model("user_role_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** Taking all towns */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all streets in town */
        $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

        /** Taking all speakers */
        $viewData->hatips = $this->hatip_model->get_all(array(), "adisoyadi ASC");

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
        $this->form_validation->set_rules("evsahibi", "Ev Sahibi", "trim|required");
        $this->form_validation->set_rules("evsahibitel", "Ev Sahibi Telefon", "trim|required");
        $this->form_validation->set_rules("hatip", "Hatip", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");
        $this->form_validation->set_rules("kapi", "Kapı No.", "trim|required");
        $this->form_validation->set_rules("tarih", "Tarih", "trim|required");
        $this->form_validation->set_rules("katilimcisayisi", "Katılımcı Sayısı", "trim|required");

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

            $toptar = str_replace('/', '-', $var);

            $toplantitarihi = date('Y-m-d', strtotime($toptar));

            $insert = $this->evsohbeti_model->add(
                array(
                    "evsahibi" => $this->input->post("evsahibi"),
                    "evsahibitel" => $this->input->post("evsahibitel"),
                    "hatip" => $this->input->post("hatip"),
                    "mahalle" => $this->input->post("mahalle"),
                    "sokak" => $this->input->post("sokak"),
                    "kapi" => $this->input->post("kapi"),
                    "daire" => $this->input->post("daire"),
                    "tarih" => $toplantitarihi,
                    "katilimcisayisi" => $this->input->post("katilimcisayisi"),
                    "kanaat" => $this->input->post("kanaatoptions"),
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
                    "text" => "Ev Sohbeti kaydı başarılı bir şekilde eklendi.."
                );

                /** If Insert Statement Unsuccessful */
            } else {

                /** Set the notification is Error */
                $alert = array(
                    "type" => "error",
                    "title" => "İşlem Başarısız",
                    "text" => "Kayıt işlemi esnasında bir sorun oluştu.."
                );

                $this->session->set_flashdata("alert", $alert);

                /** Redirect to Module's Add New Page */
                redirect(base_url("evsohbeti/new_form"));

                die();

            }

            $this->session->set_flashdata("alert", $alert);

            /** Redirect to Module's List Page */
            redirect(base_url("evsohbeti"));

            die();

            /** If Validation Unsuccessful */
        } else {
            /** Reload View and Show Error Messages Below the Inputs */
            $viewData = new stdClass();

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

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** Taking all towns */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all streets in town */
        $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

        /** Taking all speakers */
        $viewData->hatips = $this->hatip_model->get_all(array(), "adisoyadi ASC");

        /** Taking the specific row's data from the table */
        $item = $this->evsohbeti_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->evhalki = $this->evsohbeti_model->get_all(
            array(
                "sokak" => $item->sokak,
                "kapi" => $item->kapi,
                "daire" => $item->daire,
                "id!=" => $item->id
            )
        );

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $user = $this->session->userdata("user");

        /** Load Form Validation Library */
        $this->load->library("form_validation");

        /** Validation Rules */
        $this->form_validation->set_rules("evsahibi", "Ev Sahibi", "trim|required");
        $this->form_validation->set_rules("evsahibitel", "Ev Sahibi Telefon", "trim|required");
        $this->form_validation->set_rules("hatip", "Hatip", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");
        $this->form_validation->set_rules("kapi", "Kapı No.", "trim|required");
        $this->form_validation->set_rules("tarih", "Tarih", "trim|required");
        $this->form_validation->set_rules("katilimcisayisi", "Katılımcı Sayısı", "trim|required");

        /** Translate Validation Messages */
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> alanı boş bırakılamaz...",
            )
        );

        /** Run Form Validation */
        $validate = $this->form_validation->run();

        /** If Validation Successful */
        if ($validate) {

            $viewData = new stdClass();

            /** Start Update Statement */

            $this->load->model("user_role_model");
            $this->load->model("mahalle_model");
            $this->load->model("sokak_model");

            $viewData->roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** Taking all towns */
            $viewData->mahalle = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

            /** Taking the specific row's data from the table */
            $item = $this->evsohbeti_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData->evhalki = $this->evsohbeti_model->get_all(
                array(
                    "sokak" => $item->sokak,
                    "kapi" => $item->kapi,
                    "daire" => $item->daire,
                    "id!=" => $item->id
                )
            );

            $var = $this->input->post("tarih");

            $toptar = str_replace('/', '-', $var);

            $toplantitarihi = date('Y-m-d', strtotime($toptar));

            $data = array(
                "evsahibi" => $this->input->post("evsahibi"),
                "evsahibitel" => $this->input->post("evsahibitel"),
                "hatip" => $this->input->post("hatip"),
                "mahalle" => $this->input->post("mahalle"),
                "sokak" => $this->input->post("sokak"),
                "kapi" => $this->input->post("kapi"),
                "daire" => $this->input->post("daire"),
                "tarih" => $toplantitarihi,
                "katilimcisayisi" => $this->input->post("katilimcisayisi"),
                "kanaat" => $this->input->post("kanaatoptions"),
                "updatedAt" => date("Y-m-d H:i:s"),
                "updatedBy" => $user->id
            );

            $update = $this->evsohbeti_model->update(array("id" => $id), $data);

            /** Taking the specific row's data from the table */
            $item = $this->evsohbeti_model->get(
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

            /** Reload View */
            redirect(base_url("evsohbeti/update_form/$id"));
            /** If Validation Unsuccessful */

        } else {
            /** Reload View and Show Error Messages Below the Inputs */
            $viewData = new stdClass();

            $this->load->model("user_role_model");
            $this->load->model("mahalle_model");
            $this->load->model("sokak_model");

            $viewData->roles = $this->user_role_model->get_all(
                array(
                    "isActive" => 1
                )
            );

            /** Taking all towns */
            $viewData->mahalle = $this->mahalle_model->get_all();

            /** Taking all streets in town */
            $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");


            /** Taking the specific row's data from the table */
            $item = $this->evsohbeti_model->get(
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
}
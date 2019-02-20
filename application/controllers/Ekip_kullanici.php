<?php

class Ekip_kullanici extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "ekip_kullanici_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("ekip_kullanici_model");
        $this->load->model("ekip_model");
        $this->load->model("user_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        /** Taking all data from the table */
        $users = $this->ekip_kullanici_model->get_all(
            array(
                "user_role_id" => 4,
                "title !=" => "misafir"
            ), "ekip_id ASC"
        );

        $teams = $this->ekip_model->get_all();

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->users = $users;
        $viewData->teams = $teams;

        /** Load View */
        $this->load->view("{$viewData->viewFolder}/index", $viewData);
    }

    public function clear_session()
    {
        $this->session->unset_userdata("where");
        redirect(base_url("ekip-anketor"));
    }

    public function update($id)
    {
        $user = $this->session->userdata("user");

        $viewData = new stdClass();

        /** Start Update Statement */

        $this->load->model("user_role_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $data = array(
            "ekip_id" => $this->input->post("ekip_id"),
            "updatedAt" => date("Y-m-d H:i:s"),
            "updatedBy" => $user->id
        );

        $update = $this->ekip_kullanici_model->update(array("id" => $id), $data);

        /** Taking all data from the table */
        $users = $this->ekip_kullanici_model->get_all(
            array(
                "ekip_id >" => 0
            )
        );

        $teams = $this->ekip_model->get_all();

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->users = $users;
        $viewData->teams = $teams;

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
        $this->load->view("{$viewData->viewFolder}/index", $viewData);
    }

//    public function delete($id)
//    {
//        /** Starting Delete Statement */
//        $delete = $this->ekip_kullanici_model->delete(
//            array(
//                "id" => $id
//            )
//        );
//
//        /** If Delete Statement is Succesful */
//        if ($delete) {
//
//            /** Set the notification is Success */
//            $alert = array(
//                "type" => "success",
//                "title" => "İşlem Başarılı",
//                "text" => "Kayıt başarılı bir şekilde silindi.."
//            );
//
//            /** If Delete Statement is Unsuccessful */
//        } else {
//
//            /** Set the notification is Error */
//            $alert = array(
//                "type" => "error",
//                "title" => "İşlem Başarısız",
//                "text" => "Kayıt silme işlemi esnasında bir sorun oluştu.."
//            );
//
//        }
//
//        $this->session->set_flashdata("alert", $alert);
//
//        /** Redirect to Module's List Page */
//        redirect(base_url("ekip"));
//
//    }

    public function ekipSetter($id)
    {
        $ekip_id = $this->input->post("data");

        /** Update the isActive column with isActive varible's value */
        $this->user_model->update(
            array(
                "id" => $id
            ),
            array(
                "ekip_id" => $ekip_id
            )
        );
    }

    public function clear()
    {
        $user = $this->session->userdata("user");

        $viewData = new stdClass();

        $this->load->model("user_role_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        $data = array(
            "ekip_id" => $this->input->post("ekip_id"),
            "updatedAt" => date("Y-m-d H:i:s"),
            "updatedBy" => $user->id
        );

        $update = $this->ekip_kullanici_model->update(array(""), $data);

        if ($update) {
            /** Set the notification is Success */
            $alert = array(
                "type" => "success",
                "title" => "İşlem Başarılı",
                "text" => "Listedeki tüm görevlendirmeler iptal edildi."
            );

        } else {

            /** Set the notification is Error */
            $alert = array(
                "type" => "error",
                "title" => "İşlem Başarısız",
                "text" => "Görevler iptal edilemedi."
            );

        }

        $this->session->set_flashdata("alert", $alert);

        redirect(base_url("ekip-anketor"));
    }

}
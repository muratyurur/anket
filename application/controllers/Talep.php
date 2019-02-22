<?php

class Talep extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "talep_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("talep_model");
        $this->load->model("secmen_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
        $this->load->model("talep_durumu_model");
        $this->load->model("user_role_model");
        $this->load->model("mudurluk_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "talep");

            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        } elseif (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom2 = strpos($_SERVER['HTTP_REFERER'], "secmen_ekle");

            if ($comefrom2 == false) {
                $this->session->unset_userdata("where");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('mudurluk')) {
            $where['mudurluk'] = $this->input->post("mudurluk");
            $viewData->set_mudurluk = $this->input->post("mudurluk");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('ilktarih')) {
            $var = $this->input->post("ilktarih");

            $ilktar = str_replace('/', '-', $var);

            $ilktarih = date('Y-m-d', strtotime($ilktar));

            $where['talepTarihi >='] = $ilktarih;
            $viewData->set_ilktarih = $this->input->post("ilktarih");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sontarih')) {
            $var = $this->input->post("sontarih");

            $sontar = str_replace('/', '-', $var);

            $sontarih = date('Y-m-d', strtotime($sontar));

            $where['talepTarihi <='] = $sontarih;
            $viewData->set_sontarih = $this->input->post("sontarih");
            $this->session->set_userdata("where", $where);
        }

        $condition = $this->session->userdata("where");

        $this->load->library("pagination");

        $config["base_url"] = base_url("talep/index");
        $config["total_rows"] = $this->talep_model->get_count($condition ? $condition : "1=1");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";


        $this->pagination->initialize($config);

        $towns = $this->mahalle_model->get_all(array(), "tanim ASC");

        $departments = $this->mudurluk_model->get_all();

        /** Taking all data from the table */
        $items = $this->talep_model->get_records(
            $condition ? $condition : "1=1",
            $config["per_page"],
            $page
        );

        $viewData->count = $config["total_rows"];

        $viewData->percount = $config["per_page"];

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;
        $viewData->towns = $towns;
        $viewData->query = $this->db->last_query();
        $viewData->departments = $departments;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function clear_session()
    {
        $this->session->unset_userdata("where");
        redirect(base_url("talep"));
    }

    public function new_form()
    {
        $viewData = new stdClass();

        $this->load->model("user_role_model");
        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");
        $this->load->model("talep_kaynak_model");
        $this->load->model("mudurluk_model");
        $this->load->model("talep_durumu_model");

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        if ($this->uri->segment(3)) {
            $viewData->secmen = $this->secmen_model->get(
                array(
                    "id" => $this->uri->segment(3)
                )
            );
        }

        /** Taking all towns */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all streets in town */
        $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

        /** Taking all request sources */
        $viewData->kaynaks = $this->talep_kaynak_model->get_all(array(), "title ASC");

        /** Taking all requests statements */
        $viewData->statements = $this->talep_durumu_model->get_all(array(), "title ASC");

        /** Taking all departments */
        $viewData->departments = $this->mudurluk_model->get_all(array(), "tanim ASC");

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
        $this->form_validation->set_rules("talepeden", "Talep Eden", "trim|required");
        $this->form_validation->set_rules("irtibat", "İrtibat No.", "trim|required");
        $this->form_validation->set_rules("talepTarihi", "Talep Tarihi", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");
        $this->form_validation->set_rules("daire", "Daire No.", "trim|required");
        $this->form_validation->set_rules("kapi", "Kapı No.", "trim|required");
        $this->form_validation->set_rules("istek", "Talep", "trim|required");

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
            /** Start Insert Statement */

            $var = $this->input->post("sonucTarihi");
            $sontar = str_replace('/', '-', $var);
            $sonucTarihi = date('Y-m-d', strtotime($sontar));

            $var = $this->input->post("talepTarihi");
            $taleptar = str_replace('/', '-', $var);
            $talepTarihi = date('Y-m-d', strtotime($taleptar));

            if ($this->input->post("sonucTarihi"))
            {
                $insert = $this->talep_model->add(
                    array(
                        "secmen" => $this->input->post("secmen"),
                        "talepeden" => $this->input->post("talepeden"),
                        "irtibat" => $this->input->post("irtibat"),
                        "talepTarihi" => $talepTarihi,
                        "kaynak" => $this->input->post("kaynak"),
                        "mahalle" => $this->input->post("mahalle"),
                        "sokak" => $this->input->post("sokak"),
                        "kapi" => $this->input->post("kapi"),
                        "daire" => $this->input->post("daire"),
                        "istek" => $this->input->post("istek"),
                        "mudurluk" => $this->input->post("mudurluk"),
                        "sonucDurumu" => $this->input->post("sonucDurumu"),
                        "sonucAciklama" => $this->input->post("sonucAciklama"),
                        "sonucTarihi" => $sonucTarihi,
                        "createdAt" => date("Y-m-d H:i:s"),
                        "createdBy" => $user->id
                    )
                );
            } else {
                $insert = $this->talep_model->add(
                    array(
                        "secmen" => $this->input->post("secmen"),
                        "talepeden" => $this->input->post("talepeden"),
                        "irtibat" => $this->input->post("irtibat"),
                        "talepTarihi" => $talepTarihi,
                        "kaynak" => $this->input->post("kaynak"),
                        "mahalle" => $this->input->post("mahalle"),
                        "sokak" => $this->input->post("sokak"),
                        "kapi" => $this->input->post("kapi"),
                        "daire" => $this->input->post("daire"),
                        "istek" => $this->input->post("istek"),
                        "mudurluk" => $this->input->post("mudurluk"),
                        "sonucDurumu" => $this->input->post("sonucDurumu"),
                        "sonucAciklama" => $this->input->post("sonucAciklama"),
                        "createdAt" => date("Y-m-d H:i:s"),
                        "createdBy" => $user->id
                    )
                );
            }

            /** If Insert Statement Succesful */
            if ($insert) {

                /** Set the notification is Success */
                $alert = array(
                    "type" => "success",
                    "title" => "İşlem Başarılı",
                    "text" => "Seçmen kaydı başarılı bir şekilde eklendi.."
                );

                /** If Insert Statement Unsuccessful */
            } else {

                /** Set the notification is Error */
                $alert = array(
                    "type" => "error",
                    "title" => "İşlem Başarısız",
                    "text" => "Seçmen kayıt işlemi esnasında bir sorun oluştu.."
                );

                $this->session->set_flashdata("alert", $alert);

                /** Redirect to Module's Add New Page */
                redirect(base_url("talep/new_form"));

                die();

            }

            $this->session->set_flashdata("alert", $alert);

            /** Redirect to Module's List Page */
            redirect(base_url("talep"));

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

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** Taking the specific row's data from the table */
        $item = $this->talep_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item = $item;

        /** Taking all towns */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all requests statements */
        $viewData->statements = $this->talep_durumu_model->get_all(array(), "title ASC");

        /** Taking all departments */
        $viewData->departments = $this->mudurluk_model->get_all(array(), "tanim ASC");

        /** Taking all streets in town */
        $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

        /** Taking person informations */
        $viewData->talepeden = $this->secmen_model->get(
            array(
                "id" => $item->secmen
            )
        );

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";

        /** Load View */
        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $user = $this->session->userdata("user");

        $viewData = new stdClass();

        $viewData->roles = $this->user_role_model->get_all(
            array(
                "isActive" => 1
            )
        );

        /** Taking the specific row's data from the table */
        $item = $this->talep_model->get(
            array(
                "talep.id" => $id
            )
        );

        $viewData->item = $item;

        /** Taking all towns */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

        /** Taking all requests statements */
        $viewData->statements = $this->talep_durumu_model->get_all(array(), "title ASC");

        /** Taking all departments */
        $viewData->departments = $this->mudurluk_model->get_all(array(), "tanim ASC");

        /** Taking all streets in town */
        $viewData->sokak = $this->sokak_model->get_all(array(), "tanim ASC");

        /** Taking person informations */
        $viewData->talepeden = $this->secmen_model->get(
            array(
                "id" => $item->secmen
            )
        );

        if ($this->input->post("sonucTarihi")) {
            $var = $this->input->post("sonucTarihi");

            $sontar = str_replace('/', '-', $var);

            $sonucTarihi = date('Y-m-d', strtotime($sontar));

            $data = array(
                "secmen" => $this->input->post("secmen"),
                "talepeden" => $this->input->post("talepeden"),
                "irtibat" => $this->input->post("irtibat"),
                "talepTarihi" => $this->input->post("talepTarihi"),
                "kaynak" => $this->input->post("kaynak"),
                "mahalle" => $this->input->post("mahalle"),
                "sokak" => $this->input->post("sokak"),
                "kapi" => $this->input->post("kapi"),
                "daire" => $this->input->post("daire"),
                "daire" => $this->input->post("daire"),
                "mudurluk" => $this->input->post("mudurluk"),
                "sonucDurumu" => $this->input->post("sonucDurumu"),
                "sonucAciklama" => $this->input->post("sonucAciklama"),
                "sonucTarihi" => $sonucTarihi,
                "updatedAt" => date("Y-m-d H:i:s"),
                "updatedBy" => $user->id
            );
        } else {
            $data = array(
                "secmen" => $this->input->post("secmen"),
                "talepeden" => $this->input->post("talepeden"),
                "irtibat" => $this->input->post("irtibat"),
                "talepTarihi" => $this->input->post("talepTarihi"),
                "kaynak" => $this->input->post("kaynak"),
                "mahalle" => $this->input->post("mahalle"),
                "sokak" => $this->input->post("sokak"),
                "kapi" => $this->input->post("kapi"),
                "daire" => $this->input->post("daire"),
                "daire" => $this->input->post("daire"),
                "mudurluk" => $this->input->post("mudurluk"),
                "sonucDurumu" => $this->input->post("sonucDurumu"),
                "sonucAciklama" => $this->input->post("sonucAciklama"),
                "updatedAt" => date("Y-m-d H:i:s"),
                "updatedBy" => $user->id
            );
        }


        $update = $this->talep_model->update(array("id" => $id), $data);

        /** Defining data to be sent to view */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";

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
        redirect(base_url("talep/update_form/$id"));
    }

    public function secmen_form()
    {

        $this->load->model("anket_model");

        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "secmen_form");
            if ($comefrom == false) {
                $this->session->unset_userdata("where1");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();

        if ($this->input->post('adi')) {
            $where['adi'] = $this->input->post("adi");
            $viewData->set_adi = $this->input->post("adi");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('soyadi')) {
            $where['soyadi'] = $this->input->post("soyadi");
            $viewData->set_soyadi = $this->input->post("soyadi");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('tckimlikno')) {
            $where['tckimlikno'] = $this->input->post("tckimlikno");
            $viewData->set_tckimlikno = $this->input->post("tckimlikno");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('sokak')) {
            $where['sokak'] = $this->input->post("sokak");
            $viewData->set_sokak = $this->input->post("sokak");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('kapi')) {
            $where['kapi'] = $this->input->post("kapi");
            $viewData->set_kapi = $this->input->post("kapi");
            $this->session->set_userdata("where1", $where);
        }

        if ($this->input->post('daire')) {
            $where['daire'] = $this->input->post("daire");
            $viewData->set_daire = $this->input->post("daire");
            $this->session->set_userdata("where1", $where);
        }

        $condition = $this->session->userdata("where1");


        $this->load->library("pagination");

        $config["base_url"] = base_url("talep/secmen_form/index");
        $config["total_rows"] = $this->anket_model->get_count($condition ? $condition : "1=1");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";

        $viewData->bina = $this->anket_model->get_bina($condition ? $condition : "1=1");
        $viewData->hane = $this->anket_model->get_hane($condition ? $condition : "1=1");


        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->anket_model->get_records(
            $condition ? $condition : "1=1",
            $config["per_page"],
            $page,
            "mahalle, sokak, ABS(kapi), daire, soyadi, adi"
        );

        $viewData->count = $config["total_rows"];

        /** Taking all towns in the place */
        $viewData->mahalle = $this->mahalle_model->get_all(array(), "tanim ASC");

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
        $viewData->items = $items;
        $viewData->links = $this->pagination->create_links();


        /** Load View */
        $this->load->view("{$viewData->viewFolder}/secmen_ekle/index", $viewData);
    }

    public function clear_secmen_session()
    {
        $this->session->unset_userdata("where1");
        redirect(base_url("talep/secmen_form"));
    }

    public function cancel_secmen_session()
    {
        $this->session->unset_userdata("where1");
        redirect(base_url("talep/new_form"));
    }

    public function secmen()
    {
        $user = $this->session->userdata("user");

        /** Load Form Validation Library */
        $this->load->library("form_validation");

        /** Validation Rules */
        $this->form_validation->set_rules("adi", "Adı", "trim|required");
        $this->form_validation->set_rules("soyadi", "Soyadı", "trim|required");
        $this->form_validation->set_rules("dogumtarihi", "Doğum Tarihi", "trim|required");
        $this->form_validation->set_rules("anaadi", "Anne Adı", "trim|required");
        $this->form_validation->set_rules("babaadi", "Baba Adı", "trim|required");
        $this->form_validation->set_rules("cinsiyeti", "Cinsiyeti", "trim|required");
        $this->form_validation->set_rules("dogumyeri", "Doğum Yeri", "trim|required");
        $this->form_validation->set_rules("engellimi", "Engelli mi?", "trim|required");
        $this->form_validation->set_rules("mahalle", "Mahalle", "trim|required");
        $this->form_validation->set_rules("sokak", "Sokak", "trim|required");
        $this->form_validation->set_rules("daire", "Daire No.", "trim|required");
        $this->form_validation->set_rules("kapi", "Kapı No.", "trim|required");
        $this->form_validation->set_rules("tckimlikno", "Vatandaşlık No.", "trim|required|is_unique[secmen.tckimlikno]");

        /** Translate Validation Messages */
        $this->form_validation->set_message(
            array(
                "required" => "<b>{field}</b> alanı boş bırakılamaz...",
                "is_unique" => "Bu T.C. Kimlik No. sistemde kayıtlıdır."
            )
        );

        /** Run Form Validation */
        $validate = $this->form_validation->run();

        /** If Validation Successful */
        if ($validate) {
            /** Start Insert Statement */

            $var = $this->input->post("dogumtarihi");

            $dogtar = str_replace('/', '-', $var);

            $dogumtarihi = date('Y-m-d', strtotime($dogtar));

            $insert = $this->talep_model->add(
                array(
                    "adi" => $this->input->post("adi"),
                    "soyadi" => $this->input->post("soyadi"),
                    "tckimlikno" => $this->input->post("tckimlikno"),
                    "dogumtarihi" => $dogumtarihi,
                    "mahalle" => $this->input->post("mahalle"),
                    "sokak" => $this->input->post("sokak"),
                    "kapi" => $this->input->post("kapi"),
                    "daire" => $this->input->post("daire"),
                    "anaadi" => $this->input->post("anaadi"),
                    "babaadi" => $this->input->post("babaadi"),
                    "cinsiyeti" => $this->input->post("cinsiyeti"),
                    "dogumyeri" => $this->input->post("dogumyeri"),
                    "engellimi" => $this->input->post("engellimi"),
                    "tuzlakart" => $this->input->post("tuzlakartoptions"),
                    "memnuniyet" => $this->input->post("memnuniyetoptions"),
                    "durum" => $this->input->post("durumoptions"),
                    "gorus" => $this->input->post("gorus"),
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
                    "text" => "Seçmen kaydı başarılı bir şekilde eklendi.."
                );

                /** If Insert Statement Unsuccessful */
            } else {

                /** Set the notification is Error */
                $alert = array(
                    "type" => "error",
                    "title" => "İşlem Başarısız",
                    "text" => "Seçmen kayıt işlemi esnasında bir sorun oluştu.."
                );

                $this->session->set_flashdata("alert", $alert);

                /** Redirect to Module's Add New Page */
                redirect(base_url("talep/new_form"));

                die();

            }

            $this->session->set_flashdata("alert", $alert);

            /** Redirect to Module's List Page */
            redirect(base_url("talep"));

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
}

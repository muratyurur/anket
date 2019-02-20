<?php

class Tuzlakart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "tuzlakart_v";

        if (!get_active_user())
            redirect(base_url("login"));

        /** Load Models */
        $this->load->model("secmen_model");
        $this->load->model("sokak_model");
        $this->load->model("mahalle_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        if (isset($_SERVER['HTTP_REFERER'])) {
            $comefrom = strpos($_SERVER['HTTP_REFERER'], "tuzlakart");
            if ($comefrom == false) {
                $this->session->unset_userdata("where");
            }
        }

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $where = array();

        if ($this->input->post('adi')) {
            $where['adi'] = $this->input->post("adi");
            $where['tuzlakart'] = 'V';
            $viewData->set_adi = $this->input->post("adi");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('soyadi')) {
            $where['soyadi'] = $this->input->post("soyadi");
            $where['tuzlakart'] = 'V';
            $viewData->set_soyadi = $this->input->post("soyadi");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('tckimlikno')) {
            $where['tckimlikno'] = $this->input->post("tckimlikno");
            $where['tuzlakart'] = 'V';
            $viewData->set_tckimlikno = $this->input->post("tckimlikno");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('sokak')) {
            $where['sokak'] = $this->input->post("sokak");
            $where['tuzlakart'] = 'V';
            $viewData->set_sokak = $this->input->post("sokak");
            $this->session->set_userdata("where", $where);
        }

        if ($this->input->post('mahalle')) {
            $where['mahalle'] = $this->input->post("mahalle");
            $where['tuzlakart'] = 'V';
            $viewData->set_mahalle = $this->input->post("mahalle");
            $this->session->set_userdata("where", $where);
        }

        $condition = $this->session->userdata("where");


        $this->load->library("pagination");

        $config["base_url"] = base_url("tuzlakart/index");
        $config["total_rows"] = $this->secmen_model->get_count($condition ? $condition : "tuzlakart = 'V'");
        $config["uri_segment)"] = 3;
        $config["per_page"] = 50;
        $config["num_links"] = 3;
        $config["last_link"] = "Son Sayfa";
        $config["first_link"] = "İlk Sayfa";

        $viewData->bina = $this->secmen_model->get_bina($condition ? $condition : "tuzlakart = 'V'");
        $viewData->hane = $this->secmen_model->get_hane($condition ? $condition : "tuzlakart = 'V'");



        $this->pagination->initialize($config);


        /** Taking all data from the table */
        $items = $this->secmen_model->get_records(
            $condition ? $condition : "tuzlakart = 'V'",
            $config["per_page"],
            $page,
            "mahalle, sokak, ABS(kapi), daire, soyadi, adi"
        );

        $viewData->count = $config["total_rows"];

        if ($this->input->post("mahalle"))
        {
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

        $this->load->model("mahalle_model");
        $this->load->model("sokak_model");

        /** Taking all town */
        $viewData->mahalle = $this->mahalle_model->get_all();

        /** Taking all streets in town */
        if ($this->input->post("mahalle"))
        {
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
        redirect(base_url("tuzlakart"));
    }

    public function excel()
    {
        $this->load->model("adres_model");

        $where = $this->session->userdata('where');

        /** Taking all data from the table */
        $items = $this->adres_model->get_all(
            array(
                "s.mahalle" => $where['mahalle'],
                "s.sokak" => $where['sokak']
            )
        );


        $sokak = $this->sokak_model->get(
            array(
                "id" => $where['sokak']
            )
        );

        require APPPATH . "third_party/PHPExcel-1.8/Classes/PHPExcel.php";
        require APPPATH . "third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php";

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getProperties()->setCreator("");
        $objPHPExcel->getProperties()->setLastModifiedBy("");
        $objPHPExcel->getProperties()->setTitle("");
        $objPHPExcel->getProperties()->setSubject("");
        $objPHPExcel->getProperties()->setDescription("");

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.5);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0);
        $objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.4);

        foreach(range('A','F') as $columnID) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }


        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
        $objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'ADI');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'SOYADI');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'MAHALLE');
        $objPHPExcel->getActiveSheet()->setCellValue('D1', 'SOKAK');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'KAPI NO.');
        $objPHPExcel->getActiveSheet()->setCellValue('F1', 'DAİRE NO.');

        $row = 2;

        foreach ($items as $item)
        {
            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$item->adi);
            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$item->soyadi);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,$item->mahalle);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.$row,$item->sokak);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.$row,$item->kapi);
            $objPHPExcel->getActiveSheet()->setCellValue('F'.$row,$item->daire);
            $row++;
        }

        $fileName = "tuzlakart.xlsx";

        $objPHPExcel->getActiveSheet()->setTitle($sokak->tanim);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save('php://output');
        exit;
    }
}